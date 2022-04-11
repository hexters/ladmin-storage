<div class="overflow-auto">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa-solid fa-lg fa-folder-open"></i> </li>
        <li class="breadcrumb-item">
            <a href="{{ route('ladmin.storage.index') }}" class="text-decoration-none">
                <strong>Storage</strong>
            </a>
        </li>
        @foreach (\Modules\Storage\Services\LadminStorageManager::breadcrumb($path) as $path => $name)
            @if ($loop->last)
                <li class="breadcrumb-item active">
                    <strong>{{ ucwords($name) }}</strong>
                </li>
            @else
                <li class="breadcrumb-item">
                    <a class="text-decoration-none"
                        href="{{ route('ladmin.storage.index', array_merge(request()->except(['path']), ['path' => $path])) }}">
                        <strong>{{ ucwords($name) }}</strong></a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
