<li id="id-{{ $comment->id }}" class="mb-3">
    <x-ladmin-card>
        <x-slot name="header">
            @php
                $me = ($comment->user_id === auth()->id());
            @endphp
            <strong class="{{ $me ? 'text-primary' : '' }}"><i class="fa-solid fa-circle-user"></i>
                {{ $me ? 'You :' : '' }}</strong>
            <strong> {{ $comment->user->name ?? 'Anonymous' }}</strong>

            <small class="text-muted float-end">{{ $comment->created_at->diffForHumans() }}</small>
        </x-slot>
        <x-slot name="body">

            <div class="bg-light p-3 mb-3">
                {{ $comment->body }}
            </div>

            @if ($comment->comments->count() > 0)
                <ul class="border-start border-2 border-secondary" style="list-style-type: none;">
                    @foreach ($comment->comments as $item)
                        {{ $viewComment($item) }}
                    @endforeach
                </ul>
            @endif
        </x-slot>
        @can(['storage.comment.file'])
            <x-slot name="footer">
                <div class="d-flex justify-content-between">
                    <strong>ID #{{ $comment->id }}</strong>
                    <form action="{{ route('ladmin.storage.delete-comment', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="text-decoration-none px-2"
                            href="{{ route('ladmin.storage.details', array_merge(request()->except(['reply']), ['reply' => $comment->id])) }}"><i
                                class="fa-solid fa-reply"></i> Reply</a>
                        @if ($comment->user_id === auth()->id())
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#modal-remove-comment-{{ $comment->id }}"
                                class="btn btn-link text-decoration-none px-2 border-start border-2"> <i
                                    class="fa-solid fa-trash-can"></i> Delete</button>

                            <x-ladmin-modal id="modal-remove-comment-{{ $comment->id }}">
                                <x-slot name="title"> Delete #{{ $comment->id }} </x-slot>
                                <x-slot name="body">
                                    Are you sure you want to delete this comment?
                                </x-slot>
                                <x-slot name="footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger text-light">Yes</button>
                                </x-slot>
                            </x-ladmin-modal>
                        @endif
                    </form>
                </div>
            </x-slot>
        @endcan
    </x-ladmin-card>
</li>
