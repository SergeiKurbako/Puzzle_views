<?php

namespace Modules\Socket\Tests\Unit\Services\SocketMessages\Executors;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Socket\Services\SocketMessages\Executors\ExecutorFactory;
use Modules\Socket\Services\SocketMessages\Executors\Base\IFactory;

class CreateExecutorFactoryTest extends TestCase
{
    public function testCreateExecutorFactory()
    {
        $this->assertInstanceOf(IFactory::class, new ExecutorFactory);
    }
}
