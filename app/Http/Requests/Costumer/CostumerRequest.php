<?php

namespace App\Http\Requests\Costumer;

use Illuminate\Foundation\Http\FormRequest;

class CostumerRequest extends FormRequest
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
            "nama_costumer" => ["required"],
            "alamat_costumer" => ["required"],
            "targer_harga_costumer" => ["required"]
        ];
    }
}
