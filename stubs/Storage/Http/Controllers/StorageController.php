<?php

namespace Modules\Storage\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Storage\Services\LadminStorageManager;
use Modules\Storage\Http\Controllers\Controller;
use Modules\Storage\Http\Requests\CommentRequest;
use Modules\Storage\Http\Requests\StarRequest;
use Modules\Storage\Http\Requests\StorageRequest;
use Modules\Storage\Http\Requests\UploadRequest;
use Modules\Storage\Jobs\BroadcastDeleteJob;
use Modules\Storage\Models\Mark;

class StorageController extends Controller
{
    protected $storage;

    public function __construct(LadminStorageManager $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        ladmin()->allows(['storage.index']);

        $path = request()->get('path', null);
        $data['directories'] = $this->storage->setPath($path)->getDirs();
        $data['files'] = $this->storage->setPath($path)->getFiles();
        $data['path'] = $path;

        return view('storage::home.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorageRequest $request)
    {
        ladmin()->allows(['storage.create.folder']);
        return $request->createFolder();
    }

    /**
     * Store a newly file uploded in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadRequest $request)
    {
        ladmin()->allows(['storage.upload.file']);
        return $request->uploadFile();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        if (is_null($request->path)) {
            abort(403);
        }

        $path = urldecode($request->path);
        $basePath = urldecode($request->base_path);

        if (!LadminStorageManager::exists($path)) {
            session()->flash('warning', 'File not found!');
            return redirect()->back();
        }

        $data['file'] = $path;
        $data['base_path'] = $basePath;

        return view('storage::home.details', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {

        ladmin()->allows(['storage.download.file']);

        if (is_null($request->path)) {
            abort(403);
        }

        $path = urldecode($request->path);

        if (!file_exists($path)) {
            session()->flash('warning', 'File not found!');
            return redirect()->back();
        }

        return response()->download($path);
    }
}
