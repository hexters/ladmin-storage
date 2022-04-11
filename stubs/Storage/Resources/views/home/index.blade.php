<x-ladmin-auth-layout>
    <x-slot name="title">Storage</x-slot>

    @include('storage::home._parts._breadcrumb')

    <h3 class="mb-3">Directories</h3>

    <div class="row mb-3">
        @can('storage.create.folder')
            <div class="col-lg-2 col-md-3 col-sm-6 col mb-3 text-center text-primary">
                <x-ladmin-card>
                    <x-slot name="body">
                        <div class="mb-3">
                            <a href="" class="text-muted text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#modal-create-folder">
                                <i class="fa-solid fa-folder-plus text-primary fa-4x"></i>
                            </a>
                        </div>
                        Create Folder
                    </x-slot>
                </x-ladmin-card>
            </div>
        @endcan
        @foreach ($directories as $dir)
            @if (!in_array($dir, \Modules\Storage\Services\LadminStorageManager::dirIgnores($path)))
                @include('storage::home._parts._folder')
            @endif
        @endforeach
    </div>

    <h3 class="mb-3">Files</h3>
    <div class="row">
        @can('storage.upload.file')
            <div class="col-lg-2 col-md-3 col-sm-6 col mb-3 text-center text-primary">
                <x-ladmin-card>
                    <x-slot name="body">
                        <div class="mb-3">
                            <a href="" class="text-muted text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#modal-upload-file">
                                <i class="fa-solid fa-file-arrow-up text-primary fa-4x"></i>
                            </a>
                        </div>
                        Upload File
                    </x-slot>
                </x-ladmin-card>
            </div>
        @endcan
        @foreach ($files as $file)
            @if (!in_array($file, \Modules\Storage\Services\LadminStorageManager::fileIgnores($path)))
                @include('storage::home._parts._file')
            @endif
        @endforeach
    </div>


    @include('storage::home._parts._modal')

    <x-slot name="scripts">
        @foreach ($files as $file)
            @include('storage::home._parts._modal_delete')
        @endforeach

        <script>
            document.querySelector('#form-input-file')
                .addEventListener('change', function(e) {
                    document.querySelector('#display-file-name')
                        .innerHTML = e.target.files.length + ' files ready to be uploaded.';
                });
        </script>
    </x-slot>

</x-ladmin-auth-layout>
