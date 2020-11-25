<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProductUpdateRequest extends FormRequest
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
            'nickname' => ['string', 'max:280'],
            'description' => ['string'],
            'make' => ['string'],
            'model' => ['string'],
            'sku' => ['string'],
            'serial_number' => ['string'],
            'category' => ['string'],
            'location' => ['string'],
            'created_by' => [''],
            'updated_by' => [''],
        ];
    }
}
