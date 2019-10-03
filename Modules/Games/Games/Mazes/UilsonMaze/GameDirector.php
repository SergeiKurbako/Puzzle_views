<?php

namespace Modules\Games\Games\Mazes\UilsonMaze;

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
        $this->dataPool->addData('sessionData', new \Modules\Games\Games\Mazes\UilsonMaze\Data\SessionData);
        $this->dataPool->addData('stateData', new \Modules\Games\Games\Mazes\UilsonMaze\Data\StateData);
        //$this->dataPool->addData('balanceData', new \Avior\GameCore\Data\BalanceData);
        $this->dataPool->addData('logicData', new \Modules\Games\Games\Mazes\UilsonMaze\Data\LogicData);
        $this->dataPool->addData('requestData', new \Modules\Games\Games\Mazes\UilsonMaze\Data\RequestData);
        //$this->dataPool->addData('userStatisticsData', new \Avior\GameCore\Data\StatisticsData);
        //$this->dataPool->addData('gameStatisticsData', new \Avior\GameCore\Data\StatisticsData);
        $this->dataPool->addData('systemData', new \Modules\Games\Games\Mazes\UilsonMaze\Data\SystemData);

        // сбор набора данных, который будет обрабатываться при соответсвующих запросах
        $this->requestDataSetPool = new \Avior\GameCore\RequestDataSets\RequestDataSets;
        $this->requestDataSetPool->addRequestData('open_game', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\OpenGameRequestData);
        $this->requestDataSetPool->addRequestData('move', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\MoveRequestData);
        $this->requestDataSetPool->addRequestData('get_chunk', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\GetChunkRequestData);
        $this->requestDataSetPool->addRequestData('end_game', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\EndGameRequestData);
        $this->requestDataSetPool->addRequestData('show_maze', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\ShowMazeRequestData);
        $this->requestDataSetPool->addRequestData('up_health', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\UpHealthRequestData);
        $this->requestDataSetPool->addRequestData('up_speed', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\UpSpeedRequestData);
        $this->requestDataSetPool->addRequestData('up_time', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\UpTimeRequestData);
        $this->requestDataSetPool->addRequestData('down_health', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\DownHealthRequestData);
        $this->requestDataSetPool->addRequestData('down_speed', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\DownSpeedRequestData);
        $this->requestDataSetPool->addRequestData('down_time', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\DownTimeRequestData);
        $this->requestDataSetPool->addRequestData('save_bot_position', new \Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets\SaveBotPositionRequestData);

        // сбор воркеров
        $this->workersPool = new \Avior\GameCore\Workers\WorkersPool;
        $this->workersPool->addWorker('sessionWorker', new \Modules\Games\Games\Mazes\UilsonMaze\Workers\SessionWorker);
        $this->workersPool->addWorker('stateWorker', new \Modules\Games\Games\Mazes\UilsonMaze\Workers\StateWorker);
        //$this->workersPool->addWorker('balanceWorker', new \Avior\GameCore\Workers\BalanceWorker);
        $this->workersPool->addWorker('logicWorker', new \Avior\GameCore\Workers\LogicWorker);
        $this->workersPool->addWorker('requestWorker', new \Avior\GameCore\Workers\RequestWorker);
        $this->workersPool->addWorker('responseWorker', new \Modules\Games\Games\Mazes\UilsonMaze\Workers\ResponseWorker);
        $this->workersPool->addWorker('recoveryWorker', new \Modules\Games\Games\Mazes\UilsonMaze\Workers\RecoveryWorker);
        //$this->workersPool->addWorker('statisticsWorker', new \Avior\GameCore\Workers\StatisticsWorker);
        //$this->workersPool->addWorker('verifierWorker', new \Avior\GameCore\Workers\VerifierWorker);

        // сбор инструкций
        $this->instructionsPool = new \Avior\GameCore\Instructions\InstructionsPool;
        $this->instructionsPool->addInstruction('logicWorkerInstructions', 'loadData', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\LogicWorkerInstructions\LogicWorkerLoadDataInstruction);
        $this->instructionsPool->addInstruction('logicWorkerInstructions', 'getChunk', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\LogicWorkerInstructions\LogicWorkerGetChunkInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'endGame', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerEndGameInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'move', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerMoveInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'loadData', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerLoadDataInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'upHealth', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerUpHealthInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'upSpeed', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerUpSpeedInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'upTime', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerUpTimeInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'downHealth', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerDownHealthInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'downSpeed', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerDownSpeedInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'downTime', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerDownTimeInstruction);
        $this->instructionsPool->addInstruction('stateWorkerInstructions', 'saveBotPosition', new \Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions\StateWorkerSaveBotPositionInstruction);

        // сбор инструменов
        $this->toolsPool = new \Avior\GameCore\Tools\ToolsPool;
        $this->toolsPool->addTool('dataTools', 'requestDataTool', new \Avior\GameCore\Tools\DataTools\RequestDataTool);
        $this->toolsPool->addTool('dataTools', 'sessionDataTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\DataTools\SessionDataTool);
        $this->toolsPool->addTool('dataTools', 'recoveryDataTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\DataTools\RecoveryDataTool);
        $this->toolsPool->addTool('logicTools', 'mazeGenerationTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeGenerationTool);
        $this->toolsPool->addTool('logicTools', 'mazeTranscoderTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeTranscoderTool);
        $this->toolsPool->addTool('logicTools', 'mazeViewerTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeViewerTool);
        $this->toolsPool->addTool('logicTools', 'mazeStartAndEndCellsTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeStartAndEndCellsTool);
        $this->toolsPool->addTool('logicTools', 'mazeChunkTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeChunkTool);
        $this->toolsPool->addTool('logicTools', 'mazeMoveTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeMoveTool);
        $this->toolsPool->addTool('logicTools', 'mazeBonusTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools\MazeBonusTool);
        $this->toolsPool->addTool('sessionTools', 'lidTool', new \Modules\Games\Games\Mazes\UilsonMaze\Tools\SessionTools\LidTool);

        // сбор действий
        $this->actionsPool = new \Avior\GameCore\Actions\ActionsPool;
        $this->actionsPool->addAction('open_game', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionOpenGame);
        $this->actionsPool->addAction('move', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionMove);
        $this->actionsPool->addAction('get_chunk', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionGetChunk);
        $this->actionsPool->addAction('end_game', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionEndGame);
        $this->actionsPool->addAction('show_maze', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionShowMaze);
        $this->actionsPool->addAction('up_health', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionUpHealth);
        $this->actionsPool->addAction('up_speed', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionUpSpeed);
        $this->actionsPool->addAction('up_time', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionUpTime);
        $this->actionsPool->addAction('down_health', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionDownHealth);
        $this->actionsPool->addAction('down_speed', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionDownSpeed);
        $this->actionsPool->addAction('down_time', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionDownTime);
        $this->actionsPool->addAction('save_bot_position', new \Modules\Games\Games\Mazes\UilsonMaze\Actions\ActionSaveBotPosition);
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
