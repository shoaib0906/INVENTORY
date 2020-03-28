<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'alias_id' => 'required',                    
                    'password' => 'required|confirmed|min:4',
                    'email' => 'required|email|max:255|unique:users',                    
                    'rent_amount'=> 'required',
                    'telephone'=> 'required',
                    'cell_no'=> 'required',
                    'username' => 'required|max:255|unique:users',
                    'password_confirmation' => 'required|same:password'
                ];
    }
}
