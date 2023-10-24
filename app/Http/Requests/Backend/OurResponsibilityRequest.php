<?php

namespace App\Http\Requests\Backend;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OurResponsibilityRequest extends FormRequest
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
        $rules = [];
        $rules = [
            'title' => ['required', 'min:10', 'unique:ourresponsibilities,title'],
            'description' => ['required', 'min:10'],
            'section_id' => ['required'],
            'image' => ['required'],
        ];
        // dd(Request::route()->getName());
        if (Request::route()->getName() == 'ourResponsibilitys.update') {
            $rules['title'] = ['required', 'min:10', Rule::unique('ourresponsibilities', 'title')->ignore($this->ourResponsibility->id)];
        }

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors(),
            ]),
        );
    }
}
