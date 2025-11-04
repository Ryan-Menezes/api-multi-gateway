<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function index()
    {
        $users = $this->userService->findAllPaginate();

        return $this->json($users, wrapper: false);
    }

    public function show(int|string $id)
    {
        $user = $this->userService->findById($id);

        return $this->json($user);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        return $this->json($user);
    }

    public function update(int|string $id, UserUpdateRequest $request)
    {
        $data = $request->validated();

        $this->userService->update($id, $data);

        return $this->success('User updated sucessfully');
    }

    public function delete(int|string $id)
    {
        $this->userService->delete($id);

        return $this->success('User deleted sucessfully');
    }
}
