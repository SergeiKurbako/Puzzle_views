<?php

namespace Modules\Socket\Tests\Unit\Services\Socket;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\Socket\PullerSocket;

class CreatePullerSocketTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePullerSocket()
    {
        $this->assertInstanceOf(PullerSocket::class, new PullerSocket);
    }
}
