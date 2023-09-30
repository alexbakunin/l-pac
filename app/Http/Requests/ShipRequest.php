<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipRequest extends FormRequest
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
            'spec' => 'array|required',
            'spec.*.name' => 'required',
            'spec.*.value' => 'required',
            'description' => 'required',
            'ordering' => 'numeric',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название лайнера не заполнено',
            'spec.array' => 'Не массив',
            'spec.required' => 'Спецификация не заполнена',
            'spec.*.name' => 'Спецификация - name не заполнено',
            'spec.*.value' => 'Спецификация - value не заполнено',
            'description.required' => 'Описание не заполнено',
            'ordering' => 'Номер заказа - должно быть число',
        ];
    }


}
