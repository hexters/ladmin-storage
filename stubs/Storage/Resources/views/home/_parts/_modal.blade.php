<form action="{{ route('ladmin.storage.upload') }}" method="POST" class="d-inline" enctype="multipart/form-data">
    @csrf
    <x-ladmin-modal id="modal-upload-file">
        <x-slot name="title">Upload File</x-slot>
        <x-slot name="body">
            <div class="rounded-lg position-relative d-flex justify-content-center align-items-center overflow-hidden w-100 bg-light border-4 border p-2"
                style="height: 250px;cursor:pointer;">
                <div class="text-dark text-center m-5">
                    <i class="fa-solid fa-cloud-arrow-up fa-5x mb-3"></i>
                    <h3>Upload File</h3>
                    <div class="text-muted">Click or drag file here!</div>
                    <small class="text-primary mt-3" id="display-file-name"></small>
                </div>
                <input type="file" multiple id="form-input-file" name="files[]" class="position-absolute opacity-0 top-0 start-0"
                    style="font-size: 200pt;cursor:pointer;">
            </div>
        </x-slot>
        <x-slot name="footer">
            <input type="hidden" name="path" value="{{ $path }}">
            <x-ladmin-button>Upload</x-ladmin-button>
        </x-slot>
    </x-ladmin-modal>
</form>

<form action="{{ route('ladmin.storage.store') }}" method="POST" class="d-inline">
    @csrf
    <x-ladmin-modal id="modal-create-folder">
        <x-slot name="title">Create New Folder</x-slot>
        <x-slot name="body">
            <div class="row d-flex align-items-center">
                <label for="" class="form-label col-4">Folder Name <span class="text-danger">*</span></label>
                <div class="col-8">
                    <x-ladmin-input required type="text" name="name" placeholder="Folder Name" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <input type="hidden" name="path" value="{{ $path }}">
            <x-ladmin-button>Create</x-ladmin-button>
        </x-slot>
    </x-ladmin-modal>
</form>
