<?php

namespace Modules\Socket\Services\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Modules\Socket\Validators\SocketMessageValidator;
use Modules\Socket\Repositories\UserRepository;
use Modules\Socket\Services\SocketMessages\Routers\SocketMessageRouter;

class PullerSocket implements MessageComponentInterface
{
    /**
     * Хранилеще с пользовательскими соединениями
     * @var [type]
     */
    protected $clients;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * Создание соединения с фронтом
     * @param  ConnectionInterface $conn [description]
     * @return [type]                    [description]
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        // запись resourceId в БД
        (new UserRepository)->create($conn->resourceId);

        echo "New connection! ({$conn->resourceId})\n";
    }

    /**
     * Получение данных с фронта
     * @param  ConnectionInterface $from [description]
     * @param  [type]              $msg  [description]
     * @return [type]                    [description]
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
        try {
            $validData = SocketMessageValidator::valid($msg);

            if (isset($validData['messageType'])) {
                $response = SocketMessageRouter::route($validData['messageType'], $from, $msg);

                $from->send($response);

                echo "$from->resourceId : $msg \n";
            }
        } catch (\Exception $e) {
            $from->send(json_encode(\json_encode(['error' => 'Bad data in message'])));
        }
    }

    /**
     * Действия при возникновении ошибки
     * @param  ConnectionInterface $conn [description]
     * @param  Exception           $e    [description]
     * @return [type]                    [description]
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();

        echo "An error has occurred: {$e->getMessage()}\n";
    }

    /**
     * Закрытие соединения
     * @param  ConnectionInterface $conn [description]
     * @return [type]                    [description]
     */
    public function onClose(ConnectionInterface $conn)
    {
        (new UserRepository)->delete($conn->resourceId);

        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconected \n";
    }

}
