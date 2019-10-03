<?php

namespace Modules\Socket\Services\SocketMessages\Executors;

use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;
use Modules\Games\Http\Controllers\SocketGameController;

/**
 *
 */
class ActionExecutor implements IExecutor
{
    public function execute(string $msg, int $resourceId): string
    {
        $requestArray = (array) json_decode($msg);

        $socketGameController = new SocketGameController;
        $response = $socketGameController->action($requestArray);

        return $response;
    }
}
