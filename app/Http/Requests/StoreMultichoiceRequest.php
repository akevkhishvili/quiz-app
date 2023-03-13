<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMultichoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'question_mode_id' => ['required', 'numeric', 'min:2', 'max:2'],
            'question' => ['required'],
            'answer_one' => ['required'],
            'answer_two' => ['required'],
            'answer_tree' => ['required'],
            'is_correct' => ['required'],
        ];
    }
}
