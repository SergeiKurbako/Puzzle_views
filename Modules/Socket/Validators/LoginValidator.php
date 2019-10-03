<?php

namespace Modules\Socket\Validators;

use Illuminate\Support\Facades\Validator;
use Ratchet\WebSocket\WsConnection;

class LoginValidator
{
    public static function valid(string $msg, int $resourceId): array
    {
        $data = \json_decode($msg);

        $dataArray = [
            'resourceId' => $resourceId,
            'name' => $data->name,
            'messageType' => $data->messageType
        ];

        $validator = Validator::make($dataArray, [
            'resourceId' => 'required|max:10000000|integer',
            'name' => 'required|max:155|string',
            'messageType' => 'required|max:155|string'
        ]);

        if ($validator->fails()) {
            echo "not valid data from message with messageType setData \n";

            return [];
        }

        $validData = $validator->valid();

        return $validData;
    }
}
