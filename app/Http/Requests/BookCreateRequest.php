<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
        $id = $this->route('book');
        return [
            'title' => "required|max:255|unique:books,title,$id",
            'subtitle' => "required|max:255",
            'price' => "required|numeric",
        ];
    }
}
