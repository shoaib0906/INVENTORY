<?php



namespace App\Http\Requests;



use App\Http\Requests\Request;



class ProductoutRequest extends Request

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
            
            'challan_no' => 'required|numeric',
            'category_out' => 'required',
            'product_code' => 'required', 
            'quantity'  => 'required|numeric',
            'date'=>'required',
            'price'=>'numeric'
            ];
    }
}

