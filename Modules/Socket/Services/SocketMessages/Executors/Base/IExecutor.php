<?php

namespace Modules\Socket\Services\SocketMessages\Executors\Base;

interface IExecutor
{
    public function execute(string $validData, int $resourceId): string;
}
