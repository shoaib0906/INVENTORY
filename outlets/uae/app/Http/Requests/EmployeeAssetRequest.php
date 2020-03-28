<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\EmployeeAsset;

class EmployeeAssetRequest extends Request
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
        $employeeasset = $this->route('employeeasset');
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'employee_id' => 'required',
					'asset_id' => 'required',
					'issue_date' => 'required',
					'comments' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
					'employee_id' => 'required',
					'asset_id' => 'required',
                    'issue_date' => 'required',
					'comments' => 'required'
                ];
            }
            default:break;
        }
    }
}
