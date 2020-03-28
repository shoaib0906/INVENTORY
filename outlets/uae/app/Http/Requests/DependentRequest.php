<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Config;

class DependentRequest extends Request
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
		/*$dep_id = $_POST['dep_id'];
        return [
                'name' => 'required',
				'relation' => 'required',
				'visa' => 'required',
                'issue_date' => 'required|date',
				'expiry_date' => 'required|date',
                'file' => ($dep_id?'':'required|').'mimes:'.Config::get('config.allowed_upload_file')
            ];*/
			
		switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $rules = [
                    'name' => 'required',
					'relation' => 'required',
					'visa' => 'required',
					'issue_date' => 'required|date',
					'expiry_date' => 'required|date',
					'file' => 'required|mimes:'.Config::get('config.allowed_upload_file')
                ];
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
					'relation' => 'required',
					'visa' => 'required',
					'issue_date' => 'required|date',
					'expiry_date' => 'required|date',
					'file' => 'mimes:'.Config::get('config.allowed_upload_file')
                ];
            }
            default:break;
        }	
    }
}
