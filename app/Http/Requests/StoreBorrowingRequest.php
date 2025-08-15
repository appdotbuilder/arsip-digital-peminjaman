<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->role === 'employee';
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'borrowing_number' => \App\Models\Borrowing::generateBorrowingNumber(),
            'borrower_id' => auth()->id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'borrowing_number' => 'required|string|unique:borrowings,borrowing_number',
            'borrower_id' => 'required|exists:users,id',
            'borrower_name' => 'required|string|max:255',
            'borrower_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable|string',
            'archive_ids' => 'required|array|min:1',
            'archive_ids.*' => 'exists:archives,id',
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
            'borrower_name.required' => 'Nama peminjam wajib diisi.',
            'district_id.required' => 'Kecamatan wajib dipilih.',
            'village_id.required' => 'Desa wajib dipilih.',
            'borrow_date.required' => 'Tanggal peminjaman wajib diisi.',
            'return_date.required' => 'Tanggal pengembalian wajib diisi.',
            'return_date.after' => 'Tanggal pengembalian harus setelah tanggal peminjaman.',
            'archive_ids.required' => 'Minimal satu arsip harus dipilih.',
            'archive_ids.min' => 'Minimal satu arsip harus dipilih.',
            'borrower_photo.image' => 'File harus berupa gambar.',
            'borrower_photo.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'borrower_photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}