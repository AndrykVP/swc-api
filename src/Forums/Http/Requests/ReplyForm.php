<?php

namespace AndrykVP\Rancor\Forums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReplyForm extends FormRequest
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
        $id = last($this->segments());

        return [
            'body' => 'required|string|min:6',
            'discussion_id' => 'required|integer|exists:forum_discussions,id',
            'author_id' => 'required|integer|exists:users,id',
        ];
    }
}
