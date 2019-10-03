<?php

namespace Modules\Socket\Services\SocketMessages\Routers;

use Modules\Socket\Services\SocketMessages\Routers\Base\ISocketRouter;
use Modules\Logs\Services\Logger\EchoLogger;
use Modules\Socket\Services\SocketMessages\Executors\ExecutorFactory;
use Ratchet\ConnectionInterface;

/**
 * Класс выбирающий кто будет обрабатывать сообщение полученное от сокетов
 */
class SocketMessageRouter implements ISocketRouter
{
    /**
     * Выполенение дейтсвих в соответсвии с полученным типом события
     *
     * @return [type] [description]
     */
    public static function route(string $messageType, ConnectionInterface $from, string $msg): string
    {
        // создание исполнителя
        $executor = ExecutorFactory::factory($messageType);

        // выполнение действия и получение ответа
        $response = \json_encode($executor->execute($msg, $from->resourceId));

        return $response;
    }
}
