<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateResponseToOrder extends FormRequest
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
            'city' => 'required',
            'deadline' => 'required|date_format:d.m.Y|before:client_deadline',
            'comment' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'city.required' => 'Значение поля "Город" обязательно для заполнения',
            'deadline.required' => 'Значение поля "Срок сдачи" обязательно для заполнения',
            'deadline.date_format' => 'Значение поля "Срок сдачи" должно быть датой в форма d.m.Y',
            'deadline.before' => 'Значение поля "Срок сдачи" не может быть больше крайнего срока заказа',
            'comment.required' => 'Значение поля "Комментарий" обязательно для заполнения',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
