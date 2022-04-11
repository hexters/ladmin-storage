<?php

namespace Modules\Storage\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LadminStorageManager
{

    protected $path = null;

    protected static function self()
    {
        return app(LadminStorageManager::class);
    }

    protected function storage()
    {
        return Storage::disk(config('storage.default'));
    }

    public function setPath($path = null)
    {
        $this->path = $path;
        return $this;
    }

    public function getDirs()
    {
        return $this->storage()->directories($this->path);
    }

    public function getFiles()
    {
        return $this->storage()->files($this->path);
    }

    public static function fileIgnores($path = null)
    {
        $ignores = [];
        foreach (config('storage.ignore.files') as $ignore) {
            $objectIgnore = ltrim($path . DIRECTORY_SEPARATOR . $ignore, '/');
            $ignores[] = $objectIgnore;
        }
        return $ignores;
    }

    public static function dirIgnores($path = null)
    {
        $ignores = [];
        foreach (config('storage.ignore.folders') as $ignore) {
            $objectIgnore = ltrim($path . DIRECTORY_SEPARATOR . $ignore, '/');
            $ignores[] = $objectIgnore;
        }

        return $ignores;
    }

    public static function getName($name)
    {
        $names = explode('/', $name);
        $result = $names[count($names) - 1];
        return $result;
    }

    public static function getFileSize($name)
    {
        $path = self::self()->storage()->path($name);
        $size = filesize($path);
        return number_format($size, 0) . ' bytes';
    }

    public static function getModifiedDate($name)
    {
        $path = self::self()->storage()->path($name);
        return date(config('ladmin.date.format'), File::lastModified($path));
    }


    public static function getLastAccessDate($name)
    {
        $path = self::self()->storage()->path($name);
        return date(config('ladmin.date.format'), fileatime($path));
    }


    public static function fullPath($name)
    {
        return self::self()->storage()->path($name);
    }

    public static function isWritable($name)
    {
        $path = self::self()->storage()->path($name);
        return File::isWritable($path);
    }

    public static function breadcrumb($name)
    {
        $paths = explode('/', $name);
        $basePath = null;
        $pathResults = [];
        foreach ($paths as $path) {
            if ($path) {
                $basePath .= rtrim($path, '/') . DIRECTORY_SEPARATOR;
                $pathResults[$basePath] = $path;
            }
        }

        return $pathResults;
    }

    public static function getIcon($name)
    {
        $ext = self::self()->extention($name);
        return self::self()->icons($ext);
    }

    protected function icons($name)
    {
        $icons = [
            // Image
            'jpg' => 'fa-solid fa-file-image',
            'jpeg' => 'fa-solid fa-file-image',
            'png' => 'fa-solid fa-file-image',
            'bitmap' => 'fa-solid fa-file-image',
            'gif' => 'fa-solid fa-file-image',
            'tiff' => 'fa-solid fa-file-image',
            'psd' => 'fa-solid fa-file-image',
            'ai' => 'fa-solid fa-file-image',

            // Audio
            'mp3' => 'fa-solid fa-file-audio',
            'wma' => 'fa-solid fa-file-audio',
            'aac' => 'fa-solid fa-file-audio',
            'wav' => 'fa-solid fa-file-audio',
            'ogg' => 'fa-solid fa-file-audio',
            'ogg' => 'fa-solid fa-file-audio',

            // Vide
            'mp4' => 'fa-solid fa-file-video',
            'mov' => 'fa-solid fa-file-video',
            'wmp' => 'fa-solid fa-file-video',
            'avi' => 'fa-solid fa-file-video',
            'avchd' => 'fa-solid fa-file-video',
            'flv' => 'fa-solid fa-file-video',
            'swf' => 'fa-solid fa-file-video',
            'mkv' => 'fa-solid fa-file-video',
            'mpeg-2' => 'fa-solid fa-file-video',

            // Document
            'pdf' => 'fa-solid fa-file-pdf',
            'doc' => 'fa-solid fa-file-word',
            'docx' => 'fa-solid fa-file-word',
            'xlsx' => 'fa-solid fa-file-excel',
            'xls' => 'fa-solid fa-file-excel',
            'csv' => 'fa-solid fa-file-excel',

            // Language
            'php' => 'fa-brands fa-php',
            'js' => 'fa-brands fa-js-square',
            'css' => 'fa-brands fa-css3-alt',
            'less' => 'fa-brands fa-less',
            'sass' => 'fa-brands fa-sass',
            'scss' => 'fa-brands fa-sass',
        ];

        return $icons[strtolower($name)] ?? 'fa-solid fa-file';
    }

    protected function extention($name)
    {
        $names = explode('.', $name);
        if (count($names) > 1) {
            return $names[count($names) - 1];
        }

        return null;
    }

    public static function storeAs($path, $file, $name)
    {

        return self::self()->storage()->putFileAs($path, $file, $name);
    }

    public static function makeDirectory($path, $name)
    {
        return self::self()->storage()->makeDirectory($path . DIRECTORY_SEPARATOR . $name);
    }

    public static function exists($path)
    {
        return self::self()->storage()->exists($path);
    }
}
