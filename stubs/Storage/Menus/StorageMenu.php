<?php

namespace Modules\Storage\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class StorageMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'storage.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Storage';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa fa-solid fa-box-open'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access module name';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'storage*';

    /**
     * Menu ID
     *
     * @var string
     */
    protected $id = '';

    /**
     * Route name
     *
     * @return Array|string|null
     * @example ['route.name', ['uuid', 'foo' => 'bar']]
     */
    protected function route()
    {
        return ['ladmin.storage.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'storage.create.folder', title: 'Create Folder', description: 'User can create folder'),
            new Gate(gate: 'storage.upload.file', title: 'Upload File', description: 'User can upload file'),
            new Gate(gate: 'storage.download.file', title: 'Download File', description: 'User can download file'),
        ];
    }

    /**
     * Other menus
     *
     * @return void
     */
    protected function submenus()
    {
        return [
            // ...
        ];
    }
}
