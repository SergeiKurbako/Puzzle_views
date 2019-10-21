<?php

namespace Modules\UserDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\LidSystem\Entities\Lid;
use Modules\Games\Entities\V2GameRule;
use Auth;
use Modules\GameFrame\Entities\GameFrame;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Modules\LidSystem\Exports\LidsExport;
use Modules\Billing\Entities\Payment;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $frames = GameFrame::where('user_id', Auth::user()->id)->paginate($itemCount);

        return view('userdashboard::index', [
            'frames' => $frames,
            'balance' => Auth::user()->balance,
            'email' => Auth::user()->email,
            'itemCount' => $itemCount
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function showFrame(Request $request, $id)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        $frame = GameFrame::find($id);
        $lids = Lid::where('frame_id', $id)->where('status', 'on');

        if ($request->input('from_date') !== null) {
            $lids->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if ($request->input('to_date') !== null) {
            $lids->whereDate('created_at', '<=', $request->input('to_date'));
        }

        if ($request->input('gender') !== null) {
            $lids->where('gender', '=', $request->input('gender'));
        }

        if ($request->input('result_game') !== null) {
            $lids->where('game_result', '=', $request->input('result_game'));
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

        return view('userdashboard::frame', [
            'lids' => $lids,
            'lidCount' => count($lids),
            'lidSum' => $lids->sum('price'),
            'frameId' => $id,
            'balance' => Auth::user()->balance,
            'email' => Auth::user()->email,
            'itemCount' => $itemCount
        ]);
    }

    public function createFrame(Request $request)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        return view('userdashboard::create-frame', [
            'error' => '',
            'balance' => Auth::user()->balance,
            'email' => Auth::user()->email
        ]);
    }

    public function showFrameRules(Request $request, $frameId)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        $rule = \json_decode(V2GameRule::where('frame_id', $frameId)->first()->rules);

        return view('userdashboard::frame-rules',[
            'frameId' => $frameId,
            'mazeWidth' => $rule->logicData->mazeWidth,
            'mazeHeight' => $rule->logicData->mazeHeight,
            'cameraWidth' => $rule->logicData->cameraWidth,
            'cameraHeight' => $rule->logicData->cameraHeight,
            'countOfTimeBonus' => $rule->logicData->countOfTimeBonus,
            'countOfHealthBonus' => $rule->logicData->countOfHealthBonus,
            'decreaseTime' => $rule->logicData->decreaseTime,
            'speed' => $rule->stateData->speed,
            'health' => $rule->stateData->health,
            'time' => $rule->stateData->time,
            'botSpeed' => $rule->stateData->botSpeed,
            'balance' => Auth::user()->balance,
            'email' => Auth::user()->email
        ]);
    }

    public function updateFrameRules(Request $request, $frameId)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        $ruleDB = V2GameRule::where('frame_id', $frameId)->first();

        $rule = \json_decode($ruleDB->rules);

        $rule->logicData->mazeWidth = $request->input('mazeWidth');
        $rule->logicData->mazeHeight = $request->input('mazeHeight');
        $rule->logicData->cameraWidth = $request->input('cameraWidth');
        $rule->logicData->cameraHeight = $request->input('cameraHeight');
        $rule->logicData->countOfTimeBonus = $request->input('countOfTimeBonus');
        $rule->logicData->countOfHealthBonus = $request->input('countOfHealthBonus');
        $rule->logicData->decreaseTime = $request->input('decreaseTime');
        $rule->stateData->speed = $request->input('speed');
        $rule->stateData->health = $request->input('health');
        $rule->stateData->time = $request->input('time');
        $rule->stateData->botSpeed = $request->input('botSpeed');

        $ruleDB->rules = \json_encode($rule);
        $ruleDB->save();

        return \redirect()->back();
    }

    public function showWallet(Request $request)
    {
        if (Auth::user()->role === 'wait_confirm') {
            return redirect('/wait-confirm');
        }
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        if (Auth::user()->status !== 'on') {
            return view('userdashboard::wait-access');
        }

        $balance = Auth::user()->balance;

        return view('userdashboard::wallet', [
            'balance' => $balance,
            'email' => Auth::user()->email
        ]);
    }

    public function updateFrame(Request $request, int $frameId)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        $frame = GameFrame::find($frameId);

        return view('admindashboard::update-frame',[
            'frame' => $frame,
            'email' => Auth::user()->email
        ]);
    }

    public function storeFrame(Request $request, int $frameId)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        $frame = GameFrame::find($frameId);
        $frame->url = $request->input('url');
        $frame->code = $request->input('code');
        $frame->save();

        return \redirect()->back();
    }

    public function showBilling(Request $request)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        $payments = Payment::where('id', '>', 0);

        if ($request->input('from_date') !== null) {
            $payments->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if ($request->input('to_date') !== null) {
            $payments->whereDate('created_at', '<=', $request->input('to_date'));
        }

        $itemCount = 10;
        if ($request->input('item_count') !== null) {
            $itemCount = $request->input('item_count');
        }

        $payments = $payments->paginate($itemCount);

        // if ($request->input('exel') !== null) {
        //     $lidExport = new LidsExport($lids);
        //     return Excel::download($lidExport, 'lids.xlsx');
        // }

        return view('userdashboard::billing', [
            'payments' => $payments,
            'itemCount' => $itemCount,
            'balance' => Auth::user()->balance,
            'email' => Auth::user()->email
        ]);

    }
}
