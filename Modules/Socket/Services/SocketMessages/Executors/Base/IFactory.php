<?php

namespace Modules\Socket\Services\SocketMessages\Executors\Base;

use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;

interface IFactory
{
    public static function factory(string $messageType): IExecutor;
}
