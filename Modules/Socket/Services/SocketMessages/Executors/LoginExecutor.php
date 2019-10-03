<?php

namespace Modules\Socket\Services\SocketMessages\Executors;

use Modules\Socket\Services\SocketMessages\Executors\Base\IExecutor;
use Modules\Socket\Validators\LoginValidator;
use Modules\Socket\Repositories\UserRepository;

/**
 *
 */
class LoginExecutor implements IExecutor
{
    public function execute(string $msg, int $resourceId): string
    {
        $validData = LoginValidator::valid($msg, $resourceId);

        $userRepository = new UserRepository;
        $userRepository->setName($resourceId, $validData['name']);

        return json_encode(['status' => true]);
    }
}
