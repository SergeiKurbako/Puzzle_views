<?php

namespace Modules\LidSystem\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\LidSystem\Entities\Complaint;
use Modules\LidSystem\Entities\Lid;
use Auth;
use Mail;
use App\Models\User;

class ComplaintController extends Controller
{
    protected $email;

    public function createComplaint(Request $request, int $lidId)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        return view('lidsystem::create-complaint', [
            'lidId' => $lidId
        ]);
    }

    public function storeComplaint(Request $request, int $lidId)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        $lid = Lid::find($lidId);
        $lid->have_complaint = 'yes';
        $lid->save();

        $message = $request->input('message');

        $complaint = new Complaint;
        $complaint->user_id = Auth::user()->id;
        $complaint->lid_id = $lidId;
        $complaint->message = $message;
        $complaint->save();

        // Отправка сообщения на почту админу
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $key => $admin) {
            $this->email = $admin->email;
            Mail::send('admindashboard::notifier', ['messages' => 'Поступила жалоба на лид'], function ($m) {
                $m->subject('Поступила жалоба на лид');
                $m->from('partylivea@gmail.com', 'Puzzles');
                $m->to($this->email, $this->email);
            });
        }

        return view('lidsystem::access-complaint');
    }

    public function updateComplaint(Request $request, int $complaintId)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $complaint = Complaint::find($complaintId);
        $complaint->status = $request->input('status');
        $complaint->save();

        $lid = Lid::find($complaint->lid_id);
        $lid->moderation_status = 'rejected';
        $lid->price = 0;

        $message = 'Жалоба отклонена администратором. Лид корректный.';
        $user = User::find($complaint->user_id);
        if ($request->input('status') === 'accept') {
            $user->balance += $complaint->lid->price;
            $message = 'Жалоба одобрена администратором. Лид некорректный. Средства возвращены Вам на счет';
            $user->save();
            $lid->moderation_status = 'accept';
        }
        $lid->save();

        $this->email = $user->email;
        Mail::send('admindashboard::notifier', ['messages' => $message], function ($m) {
            $m->subject('Жалоба одобрена');
            $m->from('partylivea@gmail.com', 'Puzzles');
            $m->to($this->email, $this->email);
        });

        return redirect()->back();
    }
}
