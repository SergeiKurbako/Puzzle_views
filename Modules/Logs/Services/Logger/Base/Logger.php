<?php

namespace Modules\Logs\Services\Logger\Base;

/**
 *
 */
interface ILogger
{
    public static function makeLog(string $message): bool;
}
