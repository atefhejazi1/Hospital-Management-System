<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'insurance_code' => 'required',
            'discount_percentage' =>'required|numeric',
            'Company_rate' =>'required|numeric',
            'name' => 'required|unique:insurance_translations,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'insurance_code.required' => trans('validation.required'),
            'discount_percentage.required' => trans('validation.required'),
            'discount_percentage.numeric' => trans('validation.numeric'),
            'Company_rate.required' => trans('validation.required'),
            'Company_rate.numeric' => trans('validation.numeric'),
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
        ];
    }
}
