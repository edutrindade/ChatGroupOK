<?php

namespace CodeShopping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatGroupUpdateRequest extends ChatGroupCreateRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $rules = parent::rules();
        $this->removeRulesRequiredFromPhoto($rules);
        return $rules;
    }
    private function removeRulesRequiredFromPhoto(array &$rules){
        $rules['photo'] = str_replace('required|', '', $rules['photo']);
    }
}