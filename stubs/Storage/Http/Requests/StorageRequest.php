<?php

namespace Modules\Storage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Storage\Services\LadminStorageManager;

class StorageRequest extends FormRequest
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
            'name' => ['required'],
        ];
    }

    public function createFolder()
    {

        if (LadminStorageManager::makeDirectory($this->path, $this->name)) {
            session()->flash('success', 'Folder created successfully!');
            return redirect()->back();
        }

        session()->flash('warning', 'Folder cannot be created!');
        return redirect()->back();
    }
}
