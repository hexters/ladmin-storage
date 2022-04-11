<?php

namespace Modules\Storage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Storage\Jobs\BroadcastCommentedJob;
use Modules\Storage\Models\Mark;

class CommentRequest extends FormRequest
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
            'message' => ['required', 'max:200'],
            'base_path' => ['nullable','string'],
            'file_path' => ['required'],
            'parent' => ['nullable', 'numeric'],
        ];
    }

    public function comment()
    {
        $comment = Mark::create([
            'parent_id' => $this->parent,
            'user_id' => auth()->id(),
            'base_path' => $this->base_path,
            'file_path' => $this->file_path,
            'type' => 'comment',
            'body' => $this->message,
        ]);

        session()->flash('success', 'File has been commented');

        dispatch(new BroadcastCommentedJob($comment));

        return redirect()->back();
    }
}
