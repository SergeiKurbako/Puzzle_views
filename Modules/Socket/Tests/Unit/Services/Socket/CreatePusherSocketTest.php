<?php

namespace Modules\Socket\Tests\Unit\Services\Socket;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\Socket\PusherSocket;

class CreatePusherSocketTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePusherSocket()
    {
        $this->assertInstanceOf(PusherSocket::class, new PusherSocket);
    }
}
