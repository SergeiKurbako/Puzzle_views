<?php

namespace Modules\Socket\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;

use Modules\Socket\Services\Socket\PusherSocket;

use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;

use React\EventLoop\Factory;
use React\ZMQ\Context;
use ZMQ;

class PushSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push_socket_server:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start SocketServer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start server');

        $loop = ReactLoop::create();

        $pusher = new PusherSocket;

        $context = new ReactContext($loop);

        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:5555');
        $pull->on('message', [$pusher, 'broadcast']);

        $webSock = new ReactServer('127.0.0.1:8082', $loop);
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

        $loop->run();
    }
}
