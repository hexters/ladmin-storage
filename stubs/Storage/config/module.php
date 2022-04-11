<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your module. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => 'Storage', // config('storage.name')

    /*
    |--------------------------------------------------------------------------
    | Default storage disk
    |--------------------------------------------------------------------------
    |
    | Here you can specify which disk you will choose 
    | to display on the storage module.
    | 
    | Follow the `config/filesystems.php` file
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),


    /*
    |--------------------------------------------------------------------------
    | Ignore file and folder
    |--------------------------------------------------------------------------
    |
    | In this option you can hide files 
    | that do not want to be seen by others specifically.
    |
    */
    'ignore' => [
        'files' => [
            '.gitignore',
            '.gitkeep',
            '.DS_Store',
        ],
        'folders' => [
            // ...
        ],
    ],
    

];
