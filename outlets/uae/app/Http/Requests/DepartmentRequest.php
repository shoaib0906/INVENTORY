<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Department;

class DepartmentRequest extends Request
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
        $department = $this->route('department');
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
                    'department_name' => 'required|unique:departments,department_name',
                    'street'          => 'required',
                    'city'            => 'required',
                    'state'           => 'required',
                    'ZIP'             => 'required',
                ];
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'department_name' => 'required|unique:departments,department_name,'.$department->id,
                    'street'          => 'required',
                    'city'            => 'required',
                    'state'           => 'required',
                    'ZIP'             => 'required',
                ];
            }
            default:break;
        }
    }
}
