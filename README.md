# [Tweakus Dilectus](https://github.com/trendoman/Tweakus-Dilectus)

Powerful tweaks and addons for CouchCMS.

1. Admin Panel Tweaks &ndash; [readme](anton.cms%40ya.ru__admin-panel-tweaks/README.md)
1. Modded Existing Tags &ndash; [readme](anton.cms%40ya.ru__tags-modded/README.md)
1. Additional Tags &ndash; [readme](anton.cms%40ya.ru__tags-new/README.md)
1. Additional Variables &ndash; [readme](anton.cms%40ya.ru__variables-new/README.md)

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
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-modded/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__variables-new/__autoload.php' );
  ```

**NOTE:** This is a work in progress regarding publishing more addons and tweaks. Takes time to cleanup some random stuff, so to speak. Bear with it, won't take long! &mdash; May 2022


## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms
