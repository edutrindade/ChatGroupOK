<?php

namespace CodeShopping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPhotoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->route('photo') ? $this->rulesCreate(): $this->rulesUpdate();
    }

    public function rulesCreate()
    {
        return [
            'photos' => 'required|array',
            'photos.*' => 'required|image|max:' . (3 * 1024)
        ];
    }

    public function rulesUpdate()
    {
        return [
            'photo' => 'required|image|max:' . (3 * 1024)
        ];
    }
}
