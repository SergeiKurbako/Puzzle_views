<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Workers;

use Avior\GameCore\Workers\Worker;
use Avior\GameCore\Base\IToolsPool;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Events\GameEvents\StartFeatureGameEvent;
use Avior\GameCore\Events\GameEvents\EndFeatureGameEvent;

class StateWorker extends Worker
{
    protected function sendNotifies(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        return $dataPool;
    }
}
