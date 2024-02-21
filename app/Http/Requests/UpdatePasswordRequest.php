<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'current_password' => [
                'required',
                // field_name, $value , $response data
                function ($attribute, $value, $fail) { 
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect!.'); //responese data for fail message 
                    }
                },
            ],
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ];
    }
}
