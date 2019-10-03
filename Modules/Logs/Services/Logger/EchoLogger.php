<?php

namespace Modules\Logs\Services\Logger;

use Modules\Logs\Services\Logger\Base\ILogger;

class EchoLogger implements Logger
{
    public static function makeLog(string $message): bool
    {
        echo $message;

        return true;
    }
}
