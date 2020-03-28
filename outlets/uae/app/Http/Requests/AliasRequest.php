<?php



namespace App\Http\Requests;



use App\Http\Requests\Request;



class AliasRequest extends Request

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

                    'alias_name' => 'required|unique:alias,alias_name'

                ];

            }

            case 'PUT':

            case 'PATCH':

            {

                return [

                    'alias_name' => 'required|unique:alias,alias_name'.($this->route('alias')->id ? ",".$this->route('alias')->id : '')

                ];

            }

            default:break;

        }

    }

}