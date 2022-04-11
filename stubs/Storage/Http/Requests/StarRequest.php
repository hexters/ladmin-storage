<?php

namespace Modules\Storage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Storage\Models\Mark;

class StarRequest extends FormRequest
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
            'base_path' => ['nullable','string'],
            'file_path' => ['required']
        ];
    }

    public function star()
    {
        $star = Mark::where('user_id', auth()->id())->where('type', 'star')->where('base_path', $this->base_path)->where('file_path', $this->file_path)->first();
        if ($star) {
            $star->delete();
        } else {
            Mark::create([
                'user_id' => auth()->id(),
                'base_path' => $this->base_path,
                'file_path' => $this->file_path,
                'type' => 'star'
            ]);
        }

        return redirect()->back();
    }
}
