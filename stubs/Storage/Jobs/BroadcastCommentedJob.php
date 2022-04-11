<?php

namespace Modules\Storage\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Storage\Services\LadminStorageManager;
use Modules\Storage\Models\Mark;

class BroadcastCommentedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mark::where('file_path', $this->comment->file_path)
            ->where('type', 'star')
            ->whereNotIn('user_id', [$this->comment->user_id])
            ->chunk(100, function ($items) {
                $items->each(function ($item) {
                    $path = Str::of($item->file_path)->replace(LadminStorageManager::fullPath(''), '');
                    $basePath = Str::of($path)->rtrim( LadminStorageManager::getName($path) )->rtrim('/');
                    ladmin()
                        ->notification($item->user)
                        ->setTitle('Commented File')
                        ->setLink(route('ladmin.storage.details', ['path' => urlencode($path), 'base_path' => urlencode($basePath)]) . '#id-' . $this->comment->id)
                        ->setDescription($item->user->name . ' commented `' . LadminStorageManager::getName($path) . '` file.')
                        ->send();
                });
            });
    }
}
