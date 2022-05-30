# [Additional Variables](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__variables-new)

#### This is a collection of additional variables set by CouchCMS in context

Look for a dedicated *`__readme__`* files for each new tag to learn more about it. And/or check the code.

Thanks to `__autoload.php`, every `.php` file is preloaded when CouchCMS boots.

## Content

- `k_is_superadmin` &ndash; [readme](__readme__k_is_superadmin.md)
- `k_million` &ndash; [readme](__readme__k_million.md)
- `k_template_name_safe` &ndash; [readme](__readme__k_template_name_safe.md)

## Installation

1. Place current folder into &ndash; `couch/addons`
2. Put this line to &ndash; `couch/addons/kfunctions.php`
    ```php
    require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__admin-panel-tweaks/__autoload.php' );
    ```
    Advice: Check out **Extended KFunctions** [repository](https://github.com/trendoman/Extended-KFunctions) &ndash; it has everything packed neatly.
3. Make sure the folder/file name <span style="color:coral">does not contain `~` symbol</span> in path. Otherwise, tweak will not be active.

## How autoload works?

Simply put, autoload helps to have every tweak/addon in a separate file.

Files are dropped in subfolders and all works without adding additional lines to `/couch/addons/kfunctions.php`.

Since everything is in separate files it is easy to &mdash;

+ archive tweaks/addons
+ move to a new installation
+ quickly disable some tweak (read below)
+ share with others and have cleaner code

Autoload works like this:

1. Code traverses all subfolders recursively and loads all found files with `*.php` extension.
2. Only files that <span style="color:coral">*do not contain*</span> `~` symbol are processed.
    - can rename a file or folder (by adding a symbol `"~"`)  to skip from loading. As in &mdash; `mycode.php` &rArr; `~mycode.php`
    - rename a `.php` file to another valid extenstion `.php5` and it will also be skipped.

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms
