<?php

namespace Modules\Socket\Repositories;

use Modules\Socket\Entities\SocketUser;

/**
 *
 */
class UserRepository
{
    public function create(string $resourceId): bool
    {
        $user = SocketUser::where('resource_id', $resourceId)->first();

        if ($user === null) {
            $user = new SocketUser;
            $user->resource_id = $resourceId;
            $user->save();

            return true;
        } else {
            return false;
        }

    }

    public function delete(string $resourceId): bool
    {
        $user = SocketUser::where('resource_id', $resourceId)->first();

        if ($user) {
            $user->delete();
        }

        return true;
    }

    public function setName(string $resourceId, string $name): bool
    {
        $user = SocketUser::where('resource_id', $resourceId)->first();
        $user->name = $name;
        $user->save();

        return true;
    }


}
