<?php

namespace Modules\Socket\Tests\Unit\Services\SocketMessages\Routers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\SocketMessages\Routers\Base\ISocketRouter;
use Modules\Socket\Services\SocketMessages\Routers\SocketMessageRouter;

class CreateMessageRouterTest extends TestCase
{
    public function testCreateMessageRouter()
    {
        $this->assertInstanceOf(ISocketRouter::class, new SocketMessageRouter([]));
    }
}
