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

class BroadcastDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $marks;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($marks)
    {
        $this->marks = $marks;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->marks as $mark) {
            $path = Str::of($mark['file_path'])->replace(LadminStorageManager::fullPath(''), '');
            $basePath = Str::of($path)->rtrim(LadminStorageManager::getName($path))->rtrim('/');
            ladmin()
                ->notification($mark['user'])
                ->setTitle('Delete File')
                ->setLink( route('ladmin.storage.index', ['path' => urlencode($basePath)]) )
                ->setDescription($mark['user']->name . ' deleted `' . LadminStorageManager::getName($path) . '` file.')
                ->send();
        }
    }
}
