<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AssetRequest extends Request
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
                    'asset_code' => 'required|unique:assets,asset_code',
					'asset_name' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
				$asset = $this->route('asset');
                return [
                    'asset_code' => 'required|unique:assets,asset_code'.($asset->id ? ",".$asset->id : ''),
					'asset_name' => 'required'
                ];
            }
            default:break;
        }
    }
}
