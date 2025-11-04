<?php

namespace App\Http\Requests\User;

use App\Utils\UserRoleUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:191', Rule::unique('users')->ignore($this->id)],
            'password' => ['required', 'min:6', 'max:191'],
            'role' => ['required', 'string', Rule::in(UserRoleUtil::getAllRoles())],
        ];
    }
}
