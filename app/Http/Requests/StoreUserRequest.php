<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

use App\Rules\PhoneNumber;


class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_role_id' => 'required|not_in:-- Choose User Role --',
            'designation_id' => 'required|not_in:-- Choose designation --',
            'department_id' => 'required|not_in:-- Choose department --',
            'country_id'  =>'required|max:200',
            'name' => 'required', 'string', 'max:255',
            'email' => 'required|unique:users',
            //'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'mobile_no' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',

        ];
    }
}
