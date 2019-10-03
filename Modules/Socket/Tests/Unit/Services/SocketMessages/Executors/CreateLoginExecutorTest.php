<?php

namespace Modules\Socket\Tests\Unit\Services\SocketMessages\Executors;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\SocketMessages\Executors\LoginExecutor;
use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;
use Modules\Socket\Repositories\UserRepository;

class CreateLoginExecutorTest extends TestCase
{
    public function testCreateExecutorFactory()
    {
        $this->assertInstanceOf(IExecutor::class, new LoginExecutor());
    }
}
