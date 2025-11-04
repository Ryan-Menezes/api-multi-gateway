<?php

namespace App\Http\Requests\User;

use App\Utils\UserRoleUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return UserRoleUtil::checkRoles(config('roles.users'));
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'min:6', 'max:191'],
            'role' => ['required', 'string', Rule::in(UserRoleUtil::getAllRoles())],
        ];
    }
}
