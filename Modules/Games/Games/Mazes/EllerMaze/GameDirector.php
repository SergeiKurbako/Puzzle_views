<?php

namespace Modules\Games\Games\Mazes\EllerMaze;

use Illuminate\Http\Request;
use Avior\GameCore\Base\IGameDirector;
use Avior\GameCore\Base\IGame;

/**
 * Класс подбирает команду(командир, рабочие, данные) для выполнения запроса
 * учитывая режим в катором запущеная игра
 */
class GameDirector implements IGameDirector
{
    protected $dataPool;

    protected $requestDataSetPool;

    protected $workersPool;

    protected $toolsPool;

    protected $actionsPool;

    protected $instructionsPool;

    public $game;

    public function __construct()
    {
        // сбор данных
        $this->dataPool = new \Avior\GameCore\Data\DataPool();
        //$this->dataPool->addData('sessionData', new \Avior\GameCore\Data\SessionData);
        //$this->dataPool->addData('stateData', new \Avior\GameCore\Data\StateData);
        //$this->dataPool->addData('balanceData', new \Avior\GameCore\Data\BalanceData);
        $this->dataPool->addData('logicData', new \Modules\Games\Games\Mazes\EllerMaze\Data\LogicData);
        $this->dataPool->addData('requestData', new \Modules\Games\Games\Mazes\EllerMaze\Data\RequestData);
        //$this->dataPool->addData('userStatisticsData', new \Avior\GameCore\Data\StatisticsData);
        //$this->dataPool->addData('gameStatisticsData', new \Avior\GameCore\Data\StatisticsData);
        //$this->dataPool->addData('longData', new \Avior\GameCore\Data\LongData);
        $this->dataPool->addData('systemData', new \Modules\Games\Games\Mazes\EllerMaze\Data\SystemData);

        // сбор набора данных, который будет обрабатываться при соответсвующих запросах
        $this->requestDataSetPool = new \Avior\GameCore\RequestDataSets\RequestDataSets;
        $this->requestDataSetPool->addRequestData('open_game', new \Modules\Games\Games\Mazes\EllerMaze\RequestDataSets\OpenGameRequestData);

        // сбор воркеров
        $this->workersPool = new \Avior\GameCore\Workers\WorkersPool;
        //$this->workersPool->addWorker('sessionWorker', new \Avior\GameCore\Workers\SessionWorker);
        //$this->workersPool->addWorker('stateWorker', new \Avior\GameCore\Workers\StateWorker);
        //$this->workersPool->addWorker('balanceWorker', new \Avior\GameCore\Workers\BalanceWorker);
        $this->workersPool->addWorker('logicWorker', new \Avior\GameCore\Workers\LogicWorker);
        $this->workersPool->addWorker('requestWorker', new \Avior\GameCore\Workers\RequestWorker);
        $this->workersPool->addWorker('responseWorker', new \Modules\Games\Games\Mazes\EllerMaze\Workers\ResponseWorker);
        //$this->workersPool->addWorker('recoveryWorker', new \Avior\GameCore\Workers\RecoveryWorker);
        //$this->workersPool->addWorker('statisticsWorker', new \Avior\GameCore\Workers\StatisticsWorker);
        //$this->workersPool->addWorker('verifierWorker', new \Avior\GameCore\Workers\VerifierWorker);

        // сбор инструкций
        $this->instructionsPool = new \Avior\GameCore\Instructions\InstructionsPool;
        $this->instructionsPool->addInstruction('logicWorkerInstructions', 'loadData', new \Modules\Games\Games\Mazes\EllerMaze\Instructions\WorkersInstructions\LogicWorkerInstructions\LogicWorkerLoadDataInstruction);

        // сбор инструменов
        $this->toolsPool = new \Avior\GameCore\Tools\ToolsPool;
        $this->toolsPool->addTool('dataTools', 'requestDataTool', new \Avior\GameCore\Tools\DataTools\RequestDataTool);
        $this->toolsPool->addTool('logicTools', 'firstMazeStringTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\FirstMazeStringTool);
        $this->toolsPool->addTool('logicTools', 'otherMazeStringTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\OtherMazeStringTool);
        $this->toolsPool->addTool('logicTools', 'lastMazeStringTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\LastMazeStringTool);
        $this->toolsPool->addTool('logicTools', 'unionMazeStringsTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\UnionMazeStringsTool);
        $this->toolsPool->addTool('logicTools', 'mazeStringTranscoderTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\MazeStringTranscoderTool);
        $this->toolsPool->addTool('logicTools', 'generatorTool', new \Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools\GeneratorTool);

        // сбор действий
        $this->actionsPool = new \Avior\GameCore\Actions\ActionsPool;
        $this->actionsPool->addAction('open_game', new \Modules\Games\Games\Mazes\EllerMaze\Actions\ActionOpenGame);
    }

    /**
     * Метод занимающийся сборкой игры
     *
     * @param  string $mode [description]
     *
     * @return IGame        [description]
     */
    public function build(string $mode): IGame
    {
        // дополнительная преконфигурация настроек
        $this->updateConfig($mode);

        // создание игры
        $this->game = new \Avior\GameCore\Game;
        $this->game->setActionsPool($this->actionsPool);
        $this->game->setRequestDataSets($this->requestDataSetPool);
        $this->game->setDataPool($this->dataPool);
        $this->game->setWorkersPool($this->workersPool);
        $this->game->setToolsPool($this->toolsPool);
        $this->game->setInstructionsPool($this->instructionsPool);

        return $this->game;
    }

    /**
     * Метод который нужно использовать для дополнительной конфигурации игры
     *
     * @return bool
     */
    protected function updateConfig(string $mode): bool
    {
        return true;
    }
}
