<?php

namespace App\Http\Requests\Product;

use App\Utils\UserRoleUtil;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return UserRoleUtil::checkRoles(config('roles.products'));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191', 'unique:products'],
            'amount' => ['required', 'integer'],
        ];
    }
}
