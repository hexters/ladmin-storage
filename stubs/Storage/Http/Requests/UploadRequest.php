<?php

namespace Modules\Storage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Storage\Services\LadminStorageManager;

class UploadRequest extends FormRequest
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
            'files' => ['required', 'array'],
            'files.*' => ['file']
        ];
    }

    public function uploadFile()
    {
        $messages = [];
        $warnings = [];
        foreach ($this->files as $files) {
            foreach ($files as $file) {
                $fullPath = $this->path . DIRECTORY_SEPARATOR . $file->getClientOriginalName();

                if (LadminStorageManager::exists($fullPath)) {
                    $warnings[] = $file->getClientOriginalName() . ' File already exists!';
                } else {
                    if (!LadminStorageManager::storeAs($this->path, $file, $file->getClientOriginalName())) {
                        $warnings[] = $file->getClientOriginalName() . ' File upload not successful!';
                    } else {
                        $messages[] = $file->getClientOriginalName() . ' has been uploaded successfully';
                    }
                }

            }
        }

        session()->flash('warning', $warnings);
        session()->flash('success', $messages);
        return redirect()->back();
    }
}
