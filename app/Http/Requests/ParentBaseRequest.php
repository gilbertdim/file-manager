<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ParentBaseRequest extends FormRequest
{
    public ?File $parent = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->parent = File::find($this->input('parent_id'));

        if ($this->parent && !$this->parent->isOwnedBy(Auth::id())) {
            return false;
        }

        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                Rule::exists(File::class, 'id')
                    ->where(fn ($query) => $query->whereIsFolder(1)->whereCreatedBy(Auth::id()))
            ]
        ];
    }
}
