# [Admin Panel Tweaks](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__admin-panel-tweaks)

#### This is a collection of various addons and codes for CouchCMS.<br>
> First time? Visit [CouchCMS website](couchcms.com/) to enjoy this TIME-TESTED AND SECURE CMS. It's perfect for designers and is open source! See its [GitHub Repo](https://github.com/CouchCMS/CouchCMS).

Look for a dedicated *`__readme__`* files in subfolders to learn more about each tweak. And/or check the code.

Thanks to `__autoload.php`, every `.php` file from all subfolders is preloaded when CouchCMS boots.

## Contents

- alert-aligned &mdash; [readme](alert-aligned/__readme__alert-aligned.md)
- config_xxxx_view &mdash; [readme](config_xxxx_view/__readme__clean-up-template-configs.md)
- repeatable-region &mdash; [readme](repeatable-region/__readme__repeatable-tweaks.md)
- ~page-builder/ &mdash; for the newest PageBuilder ADDON in CouchCMS V2.3 ([forum link](https://www.couchcms.com/forum/viewtopic.php?f=5&t=13148))
    - tweak-pb-render &mdash; [readme](~page-builder/__readme__tweak-pb-render.md)
- ~sidebar/
    - add-items &mdash; [readme](~sidebar/__readme__add-items.md)
    - add-separator &mdash; [readme](~sidebar/__readme__add-separator.md)
    - alter-items &mdash; [readme](~sidebar/__readme__alter-items.md)
    - hide-items &mdash; [readme](~sidebar/__readme__hide-items.md)
- ~template-edit/
    - translit-cyrillic &mdash; [readme](~template-edit/__readme__translit-cyrillic.md)
- template-list/
    - default-page-short-title &mdash; [readme](template-list/__readme__default-page-short-title.md)
    - default-page-unpublish &mdash; [readme](template-list/__readme__default-page-unpublish.md)
    - tweak-date-display-format-globally &mdash; [readme](template-list/__readme__tweak-date-display-format-globally.md)
    - tweak-list-limit-globally &mdash; [readme](template-list/__readme__tweak-list-limit-globally.md)
    - tweak-title-visible-length &mdash; [readme](template-list/__readme__tweak-title-visible-length.md)
    - tweak-users-list-view &mdash; [readme](template-list/__readme__tweak-users-list-view.md)

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
