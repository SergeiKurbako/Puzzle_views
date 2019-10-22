<?php

namespace Modules\GameFrame\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GameFrame\Entities\GameFrame;
use Modules\LidSystem\Entities\Lid;
use Modules\LidSystem\Entities\Complaint;
use Auth;
use Webpatser\Uuid\Uuid;
use Modules\Games\Entities\V2GameRule;
use App\Models\User;
use Mail;


class GameFrameController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('gameframe::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('gameframe::create');
    }

    public function storeUserFrame(Request $request)
    {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }

        $url = $request->input('url');

        // определение является ли url
        $checkIsUrl = filter_var($url, FILTER_VALIDATE_URL);
        if ($checkIsUrl === false) {
            return view('userdashboard::create-frame', [
                'error' => 'Введите url',
                'balance' => Auth::user()->balance,
                'email' => Auth::user()->email
                ]);
        }

        // проверка наличия фрейма для данного сайта
        $frame = GameFrame::where('url', $url)->first();
        if ($frame !== null) {
            return view('userdashboard::create-frame', [
                'error' => 'Фрейм с таким url уже есть',
                'balance' => Auth::user()->balance,
                'email' => Auth::user()->email
                ]);
        }

        // определение ip
        if (strpos($url, 'http') !== false) {
            $url_array = parse_url($url); // разбиваем URL на части
            $url = $url_array['host'];
        }
        if (strpos($url, 'https') !== false) {
            $url_array = parse_url($url); // разбиваем URL на части
            $url = $url_array['host'];
        }
        $ip = gethostbyname($url); // получаем IP по доменному имени
        if ($ip == $url) { // получили ли мы IP
           $ip = 0;
        }

        // определение id пользователя
        if ($request->input('user_id') !== null) {
            if (Auth::user()->role === 'admin') {
                $userId = $request->input('user_id');
            } else {
                return view('userdashboard::create-frame', ['error' => 'Bad request']);
            }
        } else {
            $userId = Auth::user()->id;
        }

        $rule = new V2GameRule();
        $rule->frame_id = 9999;
        $rule->rules = '{"stateData":{"botSpeed":64,"cellX":0,"cellY":0,"health":3,"time":34,"speed":500},"logicData":{"decreaseTime":5,"cameraWidth":18,"cameraHeight":18,"mazeWidth":24,"mazeHeight":24,"countOfSpeedBonus":5,"countOfHealthBonus":5,"countOfTimeBonus":5,"speedBonusValue":100,"healthBonusValue":1,"timeBonusValue":5}}';
        $rule->save();

        $gameFrame = new GameFrame;
        $gameFrame->url = $request->input('url');
        $gameFrame->ip = $ip;
        $gameFrame->user_id = $userId;
        $gameFrame->game_rule_id = $rule->id;
        $gameFrame->game_id = 1;
        $gameFrame->code = Uuid::generate()->string;
        $gameFrame->save();

        $rule->frame_id = $gameFrame->id;
        $rule->save();

        return \redirect('/login');
    }

    public function storeAdminFrame(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/login');
        }
        $countOfComplaints = Complaint::where('status', '=', 'moderation')->get()->count();
        $countOfRequests = GameFrame::where('frame_status', '=', 'off')->get()->count();


        $url = $request->input('url');

        // определение является ли url
        $checkIsUrl = filter_var($url, FILTER_VALIDATE_URL);
        if ($checkIsUrl === false) {
            return view('admindashboard::create-frame', [
                'error' => 'Введите url',
                'userId' => $request->input('user_id'),
                'email' => Auth::user()->email,
                'countOfComplaints' => $countOfComplaints,
                'countOfRequests' => $countOfRequests
            ]);
        }

        $user = User::find($request->input('user_id'));

        // проверка наличия фрейма для данного сайта
        $frame = GameFrame::where('url', $url)->first();
        if ($frame !== null) {
            return view('admindashboard::create-frame', [
                'error' => 'Фрейм с таким url уже есть',
                'userId' => $request->input('user_id'),
                'email' => $user->email,
                'countOfComplaints' => $countOfComplaints,
                'countOfRequests' => $countOfRequests
            ]);
        }

        // определение ip
        if (strpos($url, 'http') !== false) {
            $url_array = parse_url($url); // разбиваем URL на части
            $url = $url_array['host'];
        }
        if (strpos($url, 'https') !== false) {
            $url_array = parse_url($url); // разбиваем URL на части
            $url = $url_array['host'];
        }
        $ip = gethostbyname($url); // получаем IP по доменному имени
        if ($ip == $url) { // получили ли мы IP
           $ip = 0;
        }

        // определение id пользователя
        if ($request->input('user_id') !== null) {
            if (Auth::user()->role === 'admin') {
                $userId = $request->input('user_id');
            } else {
                return view('admindashboard::create-frame', [
                    'error' => 'Bad request',
                    'userId' => $request->input('user_id'),
                    'countOfComplaints' => $countOfComplaints,
                    'countOfRequests' => $countOfRequests
                ]);
            }
        } else {
            $userId = Auth::user()->id;
        }

        $rule = new V2GameRule();
        $rule->frame_id = 9999;
        $rule->rules = '{"stateData":{"botSpeed":64,"cellX":0,"cellY":0,"health":3,"time":34,"speed":500},"logicData":{"decreaseTime":5,"cameraWidth":18,"cameraHeight":18,"mazeWidth":24,"mazeHeight":24,"countOfSpeedBonus":5,"countOfHealthBonus":5,"countOfTimeBonus":5,"speedBonusValue":100,"healthBonusValue":1,"timeBonusValue":5}}';
        $rule->save();

        $gameFrame = new GameFrame;
        $gameFrame->url = $request->input('url');
        $gameFrame->ip = $ip;
        $gameFrame->user_id = $userId;
        $gameFrame->game_rule_id = $rule->id;
        $gameFrame->game_id = 1;
        $gameFrame->code = Uuid::generate()->string;
        $gameFrame->save();

        $rule->frame_id = $gameFrame->id;
        $rule->save();

        return \redirect('/login');
    }

    /**
     * Выводит фрейм с игрой по id фрейма
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $frame = GameFrame::find($id);
        $lid = Lid::where('frame_id', $frame->id)->first();

        $code = $request->input('code');
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Bad HTTP_REFERER';
        }
        if ($frame->code !== $code) {
            return 'Bad frame code: ' . $code;
        }

        return view('gameframe::gameframe', ['lid' => $lid]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('gameframe::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateGameStatus(Request $request, $id)
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'user') {
            $frame = GameFrame::find($id);
            $frame->status = $request->input('status');
            $frame->save();
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    public function updateFrameStatus(Request $request, $id)
    {
        if (Auth::user()->role === 'admin') {
            $frame = GameFrame::find($id);
            $frame->frame_status = $request->input('frame_status');
            $frame->save();
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function setPrice(Request $request, $id)
    {
        if (Auth::user()->role === 'admin') {

            $frame = GameFrame::find($id);
            $message = 'Измнена цена с ' . $frame->price . 'р на ' . $request->input('price') . 'р у фрейма № ' . $frame->id .' с игрой uilson maze';
            $frame->price = $request->input('price');
            $frame->status = 'off';
            $frame->save();

            $user = User::find($frame->user_id);
            $this->email = $user->email;
            Mail::send('admindashboard::notifier', ['messages' => $message], function ($m) {
                $m->subject('Измнена цена на фрейм');
                $m->from('partylivea@gmail.com', 'Puzzles');
                $m->to($this->email, $this->email);
            });
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    public function deleteFrame(Request $request, $id)
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'user') {
            $frame = GameFrame::find($id);
            $frame->delete();
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    public function updateSmsConfirmStatus(Request $request, $id)
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'user') {
            $frame = GameFrame::find($id);
            $frame->sms_confirm = $request->input('status');
            $frame->save();
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    public function updateEmailConfirmStatus(Request $request, $id)
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'user') {
            $frame = GameFrame::find($id);
            $frame->email_confirm = $request->input('status');
            $frame->save();
        } else {
            return 'Bad request';
        }

        return redirect()->back();
    }

    public function checkNeedSmsConfirm(Request $request)
    {
        header('Access-Control-Allow-Origin: ' . $_SERVER['REQUEST_SCHEME'] . '//:' . $_SERVER['HTTP_HOST']);
        header('Access-Control-Allow-Credentials: true');

        $frame_id = $request->input('frame_id');

        $result = 'false';
        $gameFrame = GameFrame::find($frame_id);
        if ($gameFrame !== null) {
            if ($gameFrame->sms_confirm === 'on') {
                $result = 'true';
            }
        }

        return $result;
    }

    public function checkNeedEmailConfirm(Request $request)
    {
        header('Access-Control-Allow-Origin: ' . $_SERVER['REQUEST_SCHEME'] . '//:' . $_SERVER['HTTP_HOST']);
        header('Access-Control-Allow-Credentials: true');

        $frame_id = $request->input('frame_id');

        $result = 'false';
        $gameFrame = GameFrame::find($frame_id);
        if ($gameFrame !== null) {
            if ($gameFrame->email_confirm === 'on') {
                $result = 'true';
            }
        }

        return $result;
    }
}
