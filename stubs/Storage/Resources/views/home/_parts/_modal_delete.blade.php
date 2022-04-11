@can(['storage.delete.file'])
    <div class="modal fade" id="modal-delete-file-{{ Str::of($file)->slug() }}" tabindex="-1"
        aria-labelledby="modal-file-details-{{ Str::of($file)->slug() }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="modal-file-details-{{ Str::of($file)->slug() }}Label">
                        Delete File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this file?
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('ladmin.storage.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="path"
                            value="{{ \Modules\Storage\Services\LadminStorageManager::fullPath($file) }}">
                        <input type="hidden" name="redirect"
                            value="{{ isset($redirect) ? urldecode($redirect) : null }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn text-white btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan
