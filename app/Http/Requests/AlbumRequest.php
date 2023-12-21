<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'photo' => 'required|file|mimes:jpeg,jpg,png,webp',
            'price' => 'required|integer',
            'description' => 'required',
            'group_id'=>'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Поле обязательно для ввода',
            'name.min' => 'Поле имя должно быть больше 2 символов',
            'name.max' => 'Поле имя должно быть меньше 255 символов',
            '*.file' => 'Загрузите файл',
            '*.mimes'=>'Неподходящий формат файлов',
            '*.integer'=>'Поле должно быть числовым'
        ];
    }
}
