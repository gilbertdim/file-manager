<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateFolderRequest extends ParentBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique(File::class, 'name')
                    ->where('created_by', Auth::id())
                    ->where('parent_id', $this->parent_d)
                    ->whereNull('deleted_at')
            ],
        ]);
    }

    public function messages()
    {
        return [
            'name.unique' => 'Folder already exists',
        ];
    }
}
