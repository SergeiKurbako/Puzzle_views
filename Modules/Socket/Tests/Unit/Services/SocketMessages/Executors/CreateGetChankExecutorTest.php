<?php

namespace Modules\Socket\Tests\Unit\Services\SocketMessages\Executors;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\SocketMessages\Executors\ActionExecutor;
use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;

class CreateGetChunkExecutorTest extends TestCase
{
    public function testCreateExecutorFactory()
    {
        $this->assertInstanceOf(IExecutor::class, new ActionExecutor);
    }
}
