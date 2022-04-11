# Storage

![](https://github.com/hexters/assets/blob/main/ladmin-package/ladmin-storage/v1/free/root.png?raw=true)

View complete documentation for [Ladmin Package](https://github.com/hexters/ladmin)

# Installation

Add the repository by running the command below.

```bash
$ composer require hexters/ladmin-storage
```

Publish the module by running the command below.

```bash
$ php artisan vendor:publish --tag=ladmin-storage-module --force
```

Register the storage menu on the kernel menu, open the `app/Menu/Sidebar.php` file, see the example below.

```php
. . .

use Modules\Ladmin\Menus\System;
use Modules\Storage\Menus\StorageMenu;

. . .

return [

    StorageMenu::class,

    Account::class,

. . .
```

And assign permissions like the example below. in menu `http://localhost:8000/administrator/role`

![](https://github.com/hexters/assets/blob/main/ladmin-package/ladmin-storage/v1/free/access.png?raw=true)

# Config
Open the file `Modules/Storage/config/module.php`, to change the root folder of the main **Storage Module**

# Ladmin Storage Pro
[ ![](https://github.com/hexters/assets/blob/main/ladmin-package/ladmin-storage/v1/pro/banner-pro.png?raw=true) ](https://ppmarket.org/browse/hexters-ladmin-storage-pro)
