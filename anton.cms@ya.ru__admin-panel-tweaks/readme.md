# Admin Panel Tweaks

This is a collection of various addons and codes for CouchCMS.

Look for a dedicated *`__readme__`* files in subfolders to learn more about each tweak. And/or check the code.

Thanks to `__autoload.php`, every `.php` file from all subfolders is preloaded when CouchCMS boots.

## Links to Readme

- [alert-aligned](alert-aligned/__readme__alert-aligned.md)
- [config_xxxx_view](config_xxxx_view/__readme__clean-up-template-configs.md)
- [repeatable-region](repeatable-region/__readme__repeatable-tweaks.md)
- template-list/
    - [default-page-short-title](template-list/__readme__default-page-short-title.md)
    - [default-page-unpublish](template-list/__readme__default-page-unpublish.md)
    - [tweak-date-display-format-globally](template-list/__readme__tweak-date-display-format-globally.md)
    - [tweak-users-list-view](template-list/__readme__tweak-users-list-view.md)
    - [tweak-list-limit-globally](template-list/__readme__tweak-list-limit-globally.md)
    - [tweak-title-visible-length](template-list/__readme__tweak-title-visible-length.md)
- ~sidebar/
    - [add-items](~sidebar/__readme__add-items.md)
    - [add-separator](~sidebar/__readme__add-separator.md)
    - [alter-items](~sidebar/__readme__alter-items.md)
    - [hide-items](~sidebar/__readme__hide-items.md)
- ~template-edit/
    - [translit-cyrillic](~template-edit/__readme__translit-cyrillic.md)

## Installation

1. Place current folder into `/couch/addons`
2. Put this line to `/couch/addons/kfunctions.php`
```php
require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__admin-panel-tweaks/__autoload.php' );
```

## How autoload works?

Simply put, autoload helps to have every tweak/addon in a separate file.

Files are dropped in subfolders and all works without adding additional lines to `/couch/addons/kfunctions.php`.

Since everything is in separate files it is easy to &mdash;

+ archive tweaks
+ move to a new installation
+ quickly disable some tweak (read below)
+ share with others and have cleaner code

Autoload works like this:

1. Code traverses all subfolders recursively and loads all found files with `*.php` extension.
2. Only files that *do not contain `~` symbol* are processed.
    - can rename a file or folder (by adding a symbol `"~"`)  to skip from loading. As in &mdash; `mycode.php` &rArr; `~mycode.php`
    - rename a `.php` file to another valid extenstion `.php5` and it will also be skipped.

## Credits

Send me your thoughts to <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

Telegram channel: https://t.me/couchcms
