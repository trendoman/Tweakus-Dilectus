# Installation

> The _not-recommended_ way of installation is the following &mdash; copy the source code from each file and paste in kfunctions file. It will quickly create a mess. The only doubtful reason is to immediately see the result, but such reasoning is *meh*.

### Get files

* Clone repository to some folder or download [main.zip](https://github.com/trendoman/Tweakus-Dilectus/archive/refs/heads/main.zip) and unpack.

   ```shell
   cd mywebsite
   git clone https://github.com/trendoman/Tweakus-Dilectus #Tweakus
   ```

* Copy content to the directory with CouchCMS Addons within your Couch installation (it's usually `couch/addons` or whatever is defined in `couch/config.php`)

   ```shell
   cp -r \#Tweakus/* couch/addons
   ```

* Run `git pull` from time to time to get fresh content

   ```shell
   cd \#Tweakus
   git pull
   ```

* Remove repository when not needed

   ```shell
   rm -rf \#Tweakus
   ```

### Enable addons

* Include lines of your choice to KFunctions file, usually found at `couch/addons/kfunctions.php` &mdash;

   ```php
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__admin-panel-tweaks/__autoload.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__func-on-demand/func-on-demand.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__shortcodes/__autoload.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-aliased/aliased-tags.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-modded/__autoload.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__validators/__autoload.php' );
   require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__variables-new/__autoload.php' );
   ```

* Check the [**Extended KFunctions**](https://github.com/trendoman/Extended-KFunctions) repository &ndash; it has annotated addons and already includes all lines with documentation links.

**Important:** some subfolders/files may have **~** /tilde/ in the name. This keeps such addons **disabled** and invisible to the loader. Remove to enable. This little trick is explained in the following section about autoloading:

## How autoload works?

Thanks to `/__autoload.php`, every `.php` file from all relevant subfolders is preloaded automatically when CouchCMS boots. Files are dropped in subfolders and all works without adding additional lines to `/couch/addons/kfunctions.php`.

Autoload therefore helps to have every tweak/addon in a separate file. Since everything is in separate files it is easy to &mdash;

+ archive tweaks/addons
+ move to a new installation
+ quickly disable some addon (with tilde **~**)
+ share tweaks with friends and colleagues
+ have cleaner `kfunctions.php` file
+ use professional and maintainable code

Autoload intel:

1. Code traverses all subfolders recursively and loads all found files with `*.php` extension.
2. Only files that _do not contain_ **`~`** symbol are processed.
    - it helps to rename a file or folder by adding the symbol `"~"`  to skip it from loading. As in &mdash; `mycode.php` &rArr; `~mycode.php`
    - also can rename a `.php` file to another valid extension such as `.php5` and it will also be skipped. Myself, I prefer the first method.

# Support

Check out my dedicated [**SUPPORT**](/SUPPORT.md) page.
