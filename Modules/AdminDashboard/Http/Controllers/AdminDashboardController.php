<?php

namespace Modules\AdminDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use App\Models\User;
use Route;
use Modules\LidSystem\Entities\Lid;
use Modules\LidSystem\Entities\Complaint;
use Modules\GameFrame\Entities\GameFrame;
use Mail;
use Modules\Games\Entities\V2GameRule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Modules\LidSystem\Exports\LidsExport;

class AdminDashboardController extends Controller
{
    protected $email;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $users = User::where('role', 'user')->paginate($itemCount);

        return view('admindashboard::index', [
            'users' => $users
        ]);
    }

    public function showRequests()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $frames = GameFrame::where('frame_status', 'off')->get();

        return view('admindashboard::requests', [
            'frames' => $frames
        ]);
    }

    public function showUser(Request $request, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $frames = GameFrame::where('user_id',$id)->paginate($itemCount);

        return view('admindashboard::user', [
            'frames' => $frames,
            'userId' => $id
        ]);
    }

    public function showFrame(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $frame = GameFrame::find($id);

        $lids = Lid::where('frame_id', $id)->where('status', 'on');

        if ($request->input('from_date') !== null) {
            $lids->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if ($request->input('to_date') !== null) {
            $lids->whereDate('created_at', '=<', $request->input('to_date'));
        }

        if ($request->input('gender') !== null) {
            $lids->where('gender', '=', $request->input('gender'));
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $lids = $lids->paginate($itemCount);

        return view('admindashboard::frame', [
            'lids' => $lids,
            'lidCount' => count($lids),
            'lidSum' => $lids->sum('price'),
            'frameId' => $id
        ]);
    }

    public function createFrame(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        return view('admindashboard::create-frame',[
            'userId' => $request->input('user_id'),
            'error' => ''
        ]);
    }

    public function onUser(Request $request, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::find($id);
        $user->status = 'on';
        $user->save();

        return \redirect()->back();
    }

    public function offUser(Request $request, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::find($id);
        $user->status = 'off';
        $user->save();

        $this->email = $user->email;

        Mail::send('admindashboard::notifier', ['messages' => 'Аккаунт остановлен'], function ($m) {
            $m->subject('Аккаунт остановлен');
            $m->from('partylivea@gmail.com', 'Puzzles');
            $m->to($this->email, $this->email);
        });

        return \redirect()->back();
    }

    public function deleteUser(Request $request, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        // удаление фреймов пользователя
        $frames = GameFrame::where('user_id', $id)->get();
        foreach ($frames as $key => $frame) {
            $gameRule = V2GameRule::where('frame_id', $frame->id)->first();
            $gameRule->delete();

            $frame->delete();
        }
        $user = User::find($id);
        $this->email = $user->email;
        $user->delete();

        Mail::send('admindashboard::notifier', ['messages' => 'Аккаунт удален'], function ($m) {
            $m->subject('Аккаунт удален');
            $m->from('partylivea@gmail.com', 'Puzzles');
            $m->to($this->email, $this->email);
        });

        return \redirect()->back();
    }

    public function showComplaints(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $lids = Lid::where('have_complaint', 'yes');

        if ($request->input('from_date') !== null) {
            $lids->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if ($request->input('to_date') !== null) {
            $lids->whereDate('created_at', '=<', $request->input('to_date'));
        }

        if ($request->input('gender') !== null) {
            $lids->where('gender', '=', $request->input('gender'));
        }

        if ($request->input('from_price') !== null) {
            $lids->where('price', '>=', $request->input('from_price'));
        }

        if ($request->input('to_price') !== null) {
            $lids->where('price', '=<', $request->input('to_price'));
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $lids = $lids->paginate($itemCount);

        if ($request->input('exel') !== null) {
            $lidExport = new LidsExport($lids);
            return Excel::download($lidExport, 'lids.xlsx');
        }

        return view('admindashboard::complaints',[
            'lids' => $lids
        ]);
    }

    public function showComplaint(int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $complaint = Complaint::find($id);

        return view('admindashboard::complaint',[
            'complaint' => $complaint
        ]);
    }

    public function updateFrame(Request $request, int $frameId)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $frame = GameFrame::find($frameId);

        return view('admindashboard::update-frame',[
            'frame' => $frame
        ]);
    }

    public function storeFrame(Request $request, int $frameId)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $frame = GameFrame::find($frameId);
        $frame->url = $request->input('url');
        $frame->code = $request->input('code');
        $frame->save();

        return \redirect()->back();
    }
}
