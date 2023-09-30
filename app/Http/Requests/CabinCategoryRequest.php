<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CabinCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'vendor_code' => 'required',
            'type' => Rule::in(['Inside', 'Ocean view', 'Balcony', 'Suite']),
            'description' => 'required',
            'ordering' => 'numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название не заполнено',
            'vendor_code' => 'Код ???',
            'type' => 'Тип каюты - несоответствие имеющимся типам кают',
            'description.required' => 'Описание не заполнена',
            'ordering' => 'Номер заказа - должно быть число',
        ];
    }


}
