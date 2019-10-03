<?php

namespace Modules\Socket\Services\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use ZMQContext;

class PusherSocket implements WampServerInterface
{
    protected $subscribedTopics;

    public function getSubscribedTopics()
    {
        return $this->subscribedTopics;
    }

    public function addSubscribedTopic($topic)
    {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribedTopic($topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

    }

    public function onOpen(ConnectionInterface $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Connection ({$conn->resourceId}) has disconected\n";
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        $conn->callError($id, $topic, 'You are not allowed to make calls.')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    /**
     * Метод отправляет данные на socket-сервер
     *
     * @param  array  $data [description]
     *
     * @return [type]       [description]
     */
    static function sentDataToServer(array $data) {
        $context = new ZMQContext();

        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');

        $socket->connect('tcp://127.0.0.1:5555');

        $data = \json_encode($data);

        $socket->send($data);



        $json = ['name' => 'Joe Bloggs'];

        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'Push Notification');
        $socket->connect("tcp://localhost:5555");

        $socket->send(json_encode($json));
    }

    /**
     * Метод, который вызывается socket-сервером при получении данных
     *
     * @param  [type] $jsonDataToSend [description]
     *
     * @return [type]                 [description]
     */
    public function broadcast($jsonDataToSend) {
        $aDataToSend = \json_decode($jsonDataToSend, true);

        $subscribedTopics = $this->getSubscribedTopics();

        if (isset($subscribedTopics[$aDataToSend['topic_id']])) {
            $topic = $subscribedTopics[$aDataToSend['topic_id']];
            $topic->broadcast($aDataToSend);
        }
    }
}
