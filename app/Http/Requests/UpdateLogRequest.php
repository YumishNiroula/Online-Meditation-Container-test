<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'duration' => 'required|integer',
            'date' => 'required|date',
            'note' => 'required|string',
            'status' => 'required|string',
            'mood' => 'required|string',
            'feeling' => 'required|string',
            'rating' => 'required|integer',
        ];
    }
}
