<div class="col-lg-2 col-md-3 col-sm-6 col mb-3"
    title="{{ \Modules\Storage\Services\LadminStorageManager::getName($dir) }}">
    <x-ladmin-card>
        <x-slot name="body">
            <a href="?{{ http_build_query(ladmin()->back(['path' => $dir])) }}"
                class="text-decoration-none text-muted">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fa-solid text-muted fa-4x fa-folder"></i>
                    </div>
                    {{ Str::of(\Modules\Storage\Services\LadminStorageManager::getName($dir))->limit(15) }}
                </div>
            </a>
        </x-slot>
    </x-ladmin-card>
</div>
