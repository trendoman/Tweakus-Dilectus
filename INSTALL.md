# Installation

1. Clone repo to website's root
    - or download zip &ndash; [main.zip](https://github.com/trendoman/Tweakus-Dilectus/archive/refs/heads/main.zip)

  ```shell
  git clone https://github.com/trendoman/Tweakus-Dilectus
  ```
2. Copy content to the directory with CouchCMS Addons within your Couch installation (it's usually `couch/addons` or `admin/addons`)
  ```bash
  cp -r Tweakus-Dilectus/* couch/addons
  ```
3. Remove repo if not needed, but probably it's best to keep it and run `git pull` from time to time ☺
  ```bash
  rm -rf Tweakus-Dilectus
  ```
4. Include lines of your choice to KFunctions file, usually found at `couch/addons/kfunctions.php` &mdash;
  ```php
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__admin-panel-tweaks/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__php-tweaks/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__shortcodes/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-aliased/aliased-tags.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-modded/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__validators/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__variables-new/__autoload.php' );
  ```
  **However**, if you check the **Extended KFunctions** [repo](https://github.com/trendoman/Extended-KFunctions) &ndash; it has everything packed neatly and have helpful links to sources for many other addons, including stock. The above lines already included there.

**Important:** some subfolders have **"~"** in the name. Read the section below about *autoload* to know why. In short, it keeps addons within such folders *disabled*.

---

The _not-recommended_ way of installation is the following &mdash; copy the source code from each file and paste in kfunctions file. It will quickly create a mess. The only doubtful reason is to immediately see the result, but such reasoning is *meh*.

## How autoload works?

Thanks to `/__autoload.php`, every `.php` file from all relevant subfolders is preloaded automatically when CouchCMS boots.

Autoload helps to have every tweak/addon in a separate file. Files are dropped in subfolders and all works without adding additional lines to `/couch/addons/kfunctions.php`.

Benefits are great. Since everything is in separate files it is easy to &mdash;

+ archive tweaks/addons
+ move to a new installation
+ quickly disable some addon (how-to: read below)
+ share with others
+ have cleaner code

Autoload works like this:

1. Code traverses all subfolders recursively and loads all found files with `*.php` extension.
2. Only files that _do not contain_ **`~`** symbol are processed.
    - it helps to rename a file or folder by adding the symbol `"~"`  to skip it from loading. As in &mdash; `mycode.php` &rArr; `~mycode.php`
    - also can rename a `.php` file to another valid extension such as `.php5` and it will also be skipped. Myself, I prefer the first method.


# Support

Check out my dedicated [**SUPPORT**](/SUPPORT.md) page.