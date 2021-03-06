<?php

namespace AndrykVP\Rancor\Scanner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadScan extends FormRequest
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
            'files.*' => 'required|file|mimes:xml|max:20000'
        ];
    }
}
