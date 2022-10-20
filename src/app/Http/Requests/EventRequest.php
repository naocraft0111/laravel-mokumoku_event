<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => ['required', 'max:50'],
            'category_id' => ['required'],
            'date' => ['required', 'after:yesterday'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'entry_fee' => ['required', 'numeric', 'integer', 'min:0'],
            'contents' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'end_time.after' => '終了時間は開始時間以降を選んでください。'
        ];
    }
}
