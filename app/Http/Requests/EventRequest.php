<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', 
            'description' => 'required',
            'date' => 'required|date|after:now',
            'location' => 'required',
            'category_id' => 'required',
            'capacity' => 'required|integer',
            'reservation_approval_mode' => 'required|in:automatic,manual',
        ];
    }
}
