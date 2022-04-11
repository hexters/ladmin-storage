<x-ladmin-auth-layout>
    <x-slot name="title">Details</x-slot>
    
    <x-slot name="button">
        <div class="text-end">
            @can(['storage.download.file'])
                <a class="btn btn-sm btn-primary"
                    href="{{ route('ladmin.storage.download',ladmin()->back(['path' => urlencode(\Modules\Storage\Services\LadminStorageManager::fullPath($file))])) }}">
                    Download</a>
            @endcan
        </div>
    </x-slot>

    <div class="row align-items-center mb-3">
        <div class="col-lg-3 text-center">
            <i class="{{ \Modules\Storage\Services\LadminStorageManager::getIcon($file) }} text-muted fa-5x"></i>
        </div>
        <div class="col-lg-9">
            <table class="table">
                <tr>
                    <th width="25%">Name</th>
                    <td> {{ \Modules\Storage\Services\LadminStorageManager::getName($file) }}</td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td> {{ \Modules\Storage\Services\LadminStorageManager::getFileSize($file) }}</td>
                </tr>
                <tr>
                    <th>Path</th>
                    <td class="text-break">
                        {{ Str::of(\Modules\Storage\Services\LadminStorageManager::fullPath($file))->rtrim(\Modules\Storage\Services\LadminStorageManager::getName($file))->rtrim('/') }}
                    </td>
                </tr>
                <tr>
                    <th>Modified</th>
                    <td> {{ \Modules\Storage\Services\LadminStorageManager::getModifiedDate($file) }}
                    </td>
                </tr>
                <tr>
                    <th>Accessed</th>
                    <td> {{ \Modules\Storage\Services\LadminStorageManager::getLastAccessDate($file) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @include('storage::home._parts._pro')
</x-ladmin-auth-layout>
