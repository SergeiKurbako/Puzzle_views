<?php

namespace Modules\Socket\Services\SocketMessages\Executors;

use Modules\Socket\Services\SocketMessages\Executors\Base\IFactory;
use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;
use Modules\Socket\Services\SocketMessages\Executors\LoginExecutor;
use Modules\Socket\Services\SocketMessages\Executors\ActionExecutor;

class ExecutorFactory implements IFactory
{
    public static function factory(string $messageType): IExecutor
    {
        $executorClass = '\Modules\Socket\Services\SocketMessages\Executors\\' . ucfirst($messageType) . 'Executor';

        // TODO: сделать строгий выбор (безопаснее)
        switch ($messageType) {
            case 'login':
                return new LoginExecutor;
                break;

            case 'action':
                return new ActionExecutor;
                break;

            default:
                // code...
                break;
        }

        $executor = new $executorClass();

        return $executor;
    }
}
