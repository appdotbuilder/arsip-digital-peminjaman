<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchiveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && in_array(auth()->user()->role, ['admin', 'officer']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'archive_category_id' => 'required|exists:archive_categories,id',
            'title' => 'required|string|max:255',
            'archive_number' => 'required|string|max:255|unique:archives,archive_number',
            'archive_data' => 'required|array',
            'description' => 'nullable|string',
            'status' => 'in:available,borrowed',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'archive_category_id.required' => 'Kategori arsip wajib dipilih.',
            'archive_category_id.exists' => 'Kategori arsip tidak valid.',
            'title.required' => 'Judul arsip wajib diisi.',
            'archive_number.required' => 'Nomor arsip wajib diisi.',
            'archive_number.unique' => 'Nomor arsip sudah digunakan.',
            'archive_data.required' => 'Data arsip harus diisi sesuai kategori.',
        ];
    }
}