# [Tweakus Dilectus](https://github.com/trendoman/Tweakus-Dilectus)

Powerful tweaks and addons for CouchCMS.
> First time? Visit [CouchCMS website](couchcms.com/) to enjoy this TIME-TESTED AND SECURE CMS. It's perfect for designers and is open source! See its [GitHub Repo](https://github.com/CouchCMS/CouchCMS).

* Admin-Panel tweaks &ndash; [readme](anton.cms%40ya.ru__admin-panel-tweaks/README.md)
* Aliases for tags &ndash; [readme](anton.cms%40ya.ru__tags-aliased/README.md)
* Modded stock tags &ndash; [readme](anton.cms%40ya.ru__tags-modded/README.md)
* Additional new tags &ndash; [readme](anton.cms%40ya.ru__tags-new/README.md)
* Additional new variables &ndash; [readme](anton.cms%40ya.ru__variables-new/README.md)

**NOTE:** This is a work in progress regarding publishing more addons and tweaks. More and more are coming every week. Watch it!

## Installation

1. Clone repo to website's root
    - or download zip &ndash; [main.zip](https://github.com/trendoman/Tweakus-Dilectus/archive/refs/heads/main.zip)

  ```bash
  git clone https://github.com/trendoman/Tweakus-Dilectus
  ```
2. Copy folders to a directory with CouchCMS Addons
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
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-aliased/aliased-tags.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-modded/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
  require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__variables-new/__autoload.php' );
  ```
  Advice: Check out **Extended KFunctions** [repository](https://github.com/trendoman/Extended-KFunctions) &ndash; it has everything packed neatly.


## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms
