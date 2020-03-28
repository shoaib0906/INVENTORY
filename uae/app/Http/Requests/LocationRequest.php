<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Location;

class LocationRequest extends Request
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
        $location = $this->route('location');
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
                    'location_name' => 'required|unique:locations,location_name'
                ];
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'location_name' => 'required|unique:locations,location_name,'.$location->id
                ];
            }
            default:break;
        }
    }
}
