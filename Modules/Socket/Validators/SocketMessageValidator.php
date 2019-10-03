<?php

namespace Modules\Socket\Validators;

use Illuminate\Support\Facades\Validator;

class SocketMessageValidator
{
    public static function valid(string $msg): array
    {
        $data = \json_decode($msg);

        $dataArray = [
            'messageType' => $data->messageType
        ];

        $validator = Validator::make($dataArray, [
            'messageType' => 'required|max:155|string'
        ]);

        if ($validator->fails()) {
            echo "not valid data messageType: $data->messageType  \n";

            return [];
        }

        $validData = $validator->valid();

        return $validData;
    }
}
