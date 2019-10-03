<?php

namespace Modules\Socket\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

use Modules\Socket\Services\Socket\PullerSocket;

class PullSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull_socket_server:open';

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

        $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new PullerSocket()
                    )
                ),
                8081
        );

        $server->run();
    }
}
