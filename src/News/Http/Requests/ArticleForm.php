<?php

namespace AndrykVP\Rancor\News\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleForm extends FormRequest
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
        $id = $this->segment(3);

        return [
            'title' => 'required|string',
            'content' => 'required|min:1',
            'is_published' => 'required|boolean'
        ];
    }
}
