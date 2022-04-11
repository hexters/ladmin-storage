<div class="col-lg-2 col-md-3 col-sm-6 col mb-3"
    title="{{ \Modules\Storage\Services\LadminStorageManager::getName($file) }}">
    <x-ladmin-card>
        <x-slot name="body">
            <div class="text-center position-relative">
                <div class="mb-3">
                    <a
                        href="{{ route('ladmin.storage.details', ladmin()->back(['path' => urlencode($file), 'base_path' => urlencode($path)])) }}">
                        <i
                            class="{{ \Modules\Storage\Services\LadminStorageManager::getIcon($file) }} text-muted fa-4x"></i>
                    </a>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <div>
                            {{ Str::of(\Modules\Storage\Services\LadminStorageManager::getName($file))->limit(10) }}
                        </div>
                    </div>
                    @canany(['storage.download.file', 'storage.delete.file'])
                        <div class="dropdown">
                            <a href="" id="{{ Str::slug($file) }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="{{ Str::slug($file) }}">
                                @can(['storage.download.file'])
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('ladmin.storage.download',ladmin()->back(['path' => urlencode(\Modules\Storage\Services\LadminStorageManager::fullPath($file))])) }}">
                                            Download</a>
                                    </li>
                                @endcan
                                @can(['storage.delete.file'])
                                    <li><a data-bs-toggle="modal"
                                            data-bs-target="#modal-delete-file-{{ Str::of($file)->slug() }}"
                                            class="dropdown-item text-danger" href="#"> Delete</a></li>
                                @endcan
                            </ul>
                        </div>
                    @endcanany
                </div>
            </div>
        </x-slot>
    </x-ladmin-card>
</div>
