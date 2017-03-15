<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateOrder extends FormRequest
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
            'type' => 'required|exists:order_types,name',
            'educational_institution' => 'exists:educational_institutions,name',
            'faculty' => 'required_with:educational_institution|exists:faculties,name',
            'specialty' => 'min:2|max:64',
            'pages_from' => 'integer',
            'pages_to' => 'integer',
            'deadline' => 'required|date_format:d.m.Y|after_or_equal:tomorrow',
            'files.*' => 'max:20000|mimes:doc,docx,xls,xlsx,rtf,txt,pdf,jpg,jpeg,png,bmp,zip,rar',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'type.exists' => 'Значение поля "Тип работы" не найдено',
            'type.required' => 'Значение поля "Тип работы" обязательно для заполнения',
            'educational_institution.exists' => 'Значение поля "Институт" не найдено',
            'faculty.required_with' => 'Значение поля Факультет не выбран',
            'faculty.exists' => 'Значение поля "Факультет" не найдено',
            'specialty.min' => 'Значение поля "Специальность" должно иметь более 2 символов',
            'specialty.max' => 'Значение поля "Специальность" превысило 64 допустимых символа',
            'pages_from.integer' => 'Значение поля "Количество страниц от" должно быть числом',
            'pages_to.integer' => 'Значение поля "Количество страниц до" должно быть числом',
            'deadline.required' => 'Значение поля "Срок сдачи" обязательно для заполнения',
            'deadline.date_format' => 'Значение поля "Срок сдачи" должно быть датой в форма d.m.Y',
            'deadline.after_or_equal' => 'Значение поля "Срок сдачи" должно быть больше текущей даты',
            'files.*.max' => 'Размер файла не может быть более 20 Мегабайт',
            'files.*.mimes' => 'Файлы могут иметь только следующие форматы: doc,docx,xls,xlsx,rtf,txt,pdf,jpg,jpeg,png,bmp,zip,rar',

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