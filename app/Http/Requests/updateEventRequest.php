<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'date' => 'required|date|after:start_date',
            'location' => 'required|max:255',
            'image' => 'nullable|image',
            'reservation_approval_mode' => 'required|in:automatic,manual',
            'capacity' => 'required|integer',
            'price' => 'required|integer|min:0',
            'category_id' => 'required|integer'

        ];
    }
}
