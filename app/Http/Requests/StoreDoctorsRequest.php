<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDoctorsRequest extends FormRequest
{
    /**
     * Only admins may create or update doctor records. Doctor management
     * (including assigning sections/appointments) is an administrative
     * action, not something a doctor or any other guard should self-serve.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => 'required|email|unique:doctors,email,' . $this->id,
            "password" => 'required|sometimes',
            "phone" => 'required|numeric|unique:doctors,phone,' . $this->id,
            "name" => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "appointments" => 'required',
            "section_id" => 'required',
            "photo" => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'phone.required' => trans('validation.required'),
            'phone.numeric' => trans('validation.numeric'),
            'phone.unique' => trans('validation.unique'),
            'name.required' => trans('validation.required'),
            'name.regex' => trans('validation.regex'),
            'section_id.required' => trans('validation.required'),
        ];
    }
}
