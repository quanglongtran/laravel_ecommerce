<?php

namespace App\Repositories\Admin\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function storeUser(Request $request);

    public function updateUser(Request $request, int $id);
}
