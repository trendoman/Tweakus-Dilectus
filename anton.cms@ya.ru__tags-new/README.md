# [Additional Tags](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new)

#### This is a collection of absolutely new Tags for CouchCMS

Look for a dedicated *`__readme__`* files for each new tag to learn more about it. And/or check the code.

Thanks to `__autoload.php`, every `.php` file is preloaded when CouchCMS boots.

## Content

- new `<cms:base64_decode>` &ndash; [readme](__readme__base64_decode.md)
- new `<cms:base64_encode>` &ndash; [readme](__readme__base64_encode.md)
- new `<cms:if_empty>` &ndash; [readme](__readme__if_empty.md)
- new `<cms:md5>` &ndash; [readme](__readme__md5.md)
- new `<cms:show_json>` &ndash; [readme](__readme__show_json.md)
- new `<cms:write>` &ndash; [readme](__readme__write.md)

## Installation

1. Place current folder into &ndash; `couch/addons`
2. Put this line to &ndash; `couch/addons/kfunctions.php`
    ```php
    require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-new/__autoload.php' );
    ```
    Advice: Check out **Extended KFunctions** [repository](https://github.com/trendoman/Extended-KFunctions) &ndash; it has everything packed neatly.
3. Make sure the folder/file name <span style="color:coral">does not contain `~` symbol</span> in path. Otherwise, tweak will not be active.

Or, you may just copy-paste tag's code into `couch/addons/kfunctions.php` file and be done. However you will lose a way to update tags comfortably.

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
