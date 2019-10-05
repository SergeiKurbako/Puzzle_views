<?php

namespace Modules\UserDashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\LidSystem\Entities\Lid;
use Modules\Games\Entities\V2GameRule;
use Auth;
use Modules\GameFrame\Entities\GameFrame;

class UserDashboardController extends Controller
{
    public function index()
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
            'frames' => $frames
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

        return view('userdashboard::frame', [
            'lids' => $lids,
            'lidCount' => count($lids),
            'lidSum' => $lids->sum('price'),
            'frameId' => $id
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

        return view('userdashboard::create-frame', ['error' => '']);
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
            'botSpeed' => $rule->stateData->botSpeed
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
            'balance' => $balance
        ]);
    }
}
