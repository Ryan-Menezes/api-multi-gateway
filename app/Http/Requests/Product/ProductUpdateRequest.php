<?php

namespace App\Http\Requests\Product;

use App\Utils\UserRoleUtil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return UserRoleUtil::checkRoles(config('roles.products'));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191', Rule::unique('products')->ignore($this->id)],
            'amount' => ['required', 'integer'],
        ];
    }
}
