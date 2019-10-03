<?php

namespace Modules\Socket\Services\SocketMessages\Routers\Base;

use Ratchet\ConnectionInterface;

/**
 *
 */
interface ISocketRouter
{
    public static function route(
        string $messageType,
        ConnectionInterface $from,
        string $msg
    ): string;
}
