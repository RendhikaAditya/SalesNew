<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

class AddSalesRequest extends FormRequest
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
            "nama_sales" => ["required"],
            "alamat_sales" => ["required"],
            "umur_sales" => ["required"],
            "gender_sales" => ["required"],
            "username" => ["required", "unique:sales,username"],
            "password" => ["required"]
        ];
    }
}
