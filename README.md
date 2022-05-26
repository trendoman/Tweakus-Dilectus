# [Tweakus Dilectus](https://github.com/trendoman/Tweakus-Dilectus)

Simply the best tweaks and addons for CouchCMS.


## Installation

1. Clone repo to website's root
  ```bash
  git clone https://github.com/trendoman/Tweakus-Dilectus
  ```
2. Copy files to a directory with CouchCMS Addons
  ```bash
  cp -r Tweakus-Dilectus/* couch/addons
  ```
3. Remove repo
  ```bash
  rm -rf Tweakus-Dilectus
  ```
4. Include lines of your choice to `couch/addons/kfunctions.php` file &mdash;
  ```php
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__admin-panel-tweaks/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__preload-cms-func/preload-funcs.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-aliased/aliased-tags.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-modded/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__variables-new/__autoload.php' );
  ```
