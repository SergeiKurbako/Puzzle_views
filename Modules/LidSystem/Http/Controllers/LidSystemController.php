<?php

namespace Modules\LidSystem\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GameFrame\Entities\GameFrame;
use Auth;
use Webpatser\Uuid\Uuid;
use Modules\LidSystem\Entities\Lid;
use App\Models\User;

class LidSystemController extends Controller
{
    /**
     * Проверка работы банера.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');

        $frame = GameFrame::find($frameId);

        if ($frame === null) {
            return 'Пустой фрейм';
        }

        // проверка баланса юзера на возможность создания лида
        $user = User::find($frame->user_id);
        if (($user->balance - $frame->price) < 0) {
            return 'Игра временно недоступна';
        }

        $ip = gethostbyname(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST));
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Нельзя открывать фрейм из данного места';
        }
        if ($frame->code !== $code) {
            return 'Не верный код фрейма';
        }
        if ($frame->ip !== $ip) {
            return 'Не верный ip у сайта';
        }

        if ($frame->frame_status !== 'on') {
            return 'Код работает. Ожидает подтверждения';
        }
        if ($frame->status !== 'on') {
            return 'Игра выключена';
        }

        return redirect('/lidsystem/step1?frame_id=' . $frameId . '&code=' . $code);
    }

    /**
     * Клиент должен ввести номер телефона
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step1(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');

        $frame = GameFrame::find($frameId);

        if ($frame->sms_confirm === 'on') {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                return 'Нельзя открывать фрейм из данного места';
            }
            if ($frame->code !== $code) {
                return 'Не верный код фрейма';
            }

            return view('lidsystem::step1',[
                'code' => $code,
                'frameId' => $frameId
            ]);
        } else {
            // создание лида
            $lid = new Lid;
            $lid->frame_id = $frameId;
            $lid->phone = 'отсутствует';
            $lid->sms_code = rand(1000, 9999);
            $lid->save();

            return redirect('/lidsystem/step2?frame_id=' . $frameId . '&code=' . $code .'&lid_id=' . $lid->id . '&sms_code=' . $lid->sms_code);
        }
    }

    /**
     * Создание нового лида и сохранение номера телефона
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step1Create(Request $request)
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Нельзя открывать фрейм из данного места';
        }

        $frameId = $request->input('frame_id');
        $code = $request->input('code');

        // проверка наличия пользователя c таким телефоном
        $lid = Lid::where('phone', '=', $request->input('phone'))->first();

        if ($lid === null) {
            $frame = GameFrame::find($frameId);

            if ($frame->code !== $code) {
                return 'Не верный код фрейма';
            }

            // создание лида
            $lid = new Lid;
            $lid->frame_id = $frameId;
            $lid->phone = 'отсутствует';
            $lid->sms_code = rand(1000, 9999);
            $lid->save();

            // отправка sms
            file_get_contents('https://smsc.ru/sys/send.php?login=webwidgets&psw=12345Qaz&phones=' . $lid->phone . '&mes=' . $lid->sms_code);

            return redirect('/lidsystem/step2?frame_id=' . $frameId . '&code=' . $code .'&lid_id=' . $lid->id . '&sms_code=' . $lid->sms_code . '&phone=' . $request->input('phone'));
        } else {
            return 'Пользователь с таким номером уже зарегистрирован';
        }

    }

    /**
     * Ввод кода, пришедшего по СМС на номер телефона (подтверждение)
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step2(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');
        $lidId = $request->input('lid_id');
        $phone = $request->input('phone');

        $frame = GameFrame::find($frameId);

        if ($frame->sms_confirm === 'on') {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                return 'Нельзя открывать фрейм из данного места';
            }
            if ($frame->code !== $code) {
                return 'Не верный код фрейма';
            }

            $lid = Lid::find($lidId);
            $lid->phone = $phone;
            $lid->save();

            return view('lidsystem::step2',[
                'code' => $code,
                'frameId' => $frameId,
                'lidId' => $lidId,
                'smsCode' => $request->input('sms_code')
            ]);
        } else {
            return redirect('/lidsystem/step3?frame_id=' . $frameId . '&code=' . $code . '&lid_id=' . $lidId);
        }
    }

    /**
     * Проверка кода, пришедшего по СМС на номер телефона (подтверждение)
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step2Create(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');
        $smsCode = $request->input('sms_code');
        $lidId = $request->input('lid_id');

        $frame = GameFrame::find($frameId);

        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Нельзя открывать фрейм из данного места';
        }

        // получение лида
        $lid = Lid::find($lidId);

        // проверка соответсвия sms-кода
        if ($lid->sms_code != $smsCode) {
            return 'Не правильный sms-код';
        }

        if ($lid === null) {
            return 'Не существующий лид';
        }

        return redirect('/lidsystem/step3?frame_id=' . $frameId . '&code=' . $code . '&lid_id=' . $lidId);
    }

    /**
     * Ввод личных данных + галочка на согласие их обработки
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step3(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');
        $lidId = $request->input('lid_id');

        $frame = GameFrame::find($frameId);

        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Нельзя открывать фрейм из данного места';
        }
        if ($frame->code !== $code) {
            return 'Не верный код фрейма';
        }

        return view('lidsystem::step3',[
            'code' => $code,
            'frameId' => $frameId,
            'lidId' => $lidId
        ]);
    }

    /**
     * Сохранение личных данных + галочка на согласие их обработки
     *
     * @param  Request $request [description]
     *
     * @return [type]           [description]
     */
    public function step3Create(Request $request)
    {
        $frameId = $request->input('frame_id');
        $code = $request->input('code');
        $lidId = $request->input('lid_id');

        $frame = GameFrame::find($frameId);

        if (!isset($_SERVER['HTTP_REFERER'])) {
            return 'Нельзя открывать фрейм из данного места';
        }
        if ($frame->code !== $code) {
            return 'Не верный код фрейма';
        }

        // проверка наличия лида с таким email
        if ($frame->email_confirm === 'on') {
            $oldLid = Lid::where('email', $request->input('email'))->first();
            if ($oldLid !== null) {
                return 'Уже есть пользователь с таким email';
            }
        }

        // получение лида
        $lid = Lid::find($lidId);

        if ($lid === null) {
            return 'Не правильный lid';
        }

        // снятие с юзера денег за лид
        $frame = GameFrame::find($frameId);
        $user = User::find($frame->user_id);
        $user->balance -= $frame->price;
        $user->save();

        // заполнения лида данными
        $lid->first_name = $request->input('first_name');
        $lid->second_name = $request->input('second_name');
        $lid->patronymic_name = $request->input('patronymic_name');
        $lid->gender = $request->input('gender');
        $lid->age = $request->input('age');
        $lid->email = $request->input('email');
        $lid->work_place = $request->input('work_place');
        $lid->status = 'on';
        $lid->price = $frame->price;
        $lid->save();

        return view('lidsystem::thanks',[
            'code' => $code,
            'frameId' => $frameId,
            'lidId' => $lid->id
        ]);
    }

    public function step5(Request $request)
    {
        $lidId = $request->input('lid_id');
        $lid = Lid::find($lidId);
        return view('lidsystem::step5',[
            'gameResult' => $lid->game_result
        ]);
    }
    public function saveGameResult(Request $request)
    {
        $lidId = $request->input('lid_id');
        $gameResult = $request->input('game_result');
        $lid = Lid::find($lidId);
        $lid->game_result = $gameResult;
        $lid->save();
        return true;
    }
    
}
