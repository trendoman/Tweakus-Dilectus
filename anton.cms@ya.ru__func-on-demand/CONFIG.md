# Advanced configuration • [FOD](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand)

If you have already mastered [**basic configuration**](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand/README.md#configuration) and need more, let's get right in:

## FOD_FUNCS_DIRECTORY

You can add more than a single directory to look up for the funcs. The main directory is already configured e.g.

```php
define( 'FOD_FUNCS_DIRECTORY', K_SITE_DIR.K_SNIPPETS_DIR.'/funcs' );
```

The above line is the mandatory one, so that must not be duplicated. To add, uncomment in the `config.php` the line in Advanced Configuration section:

```php
\trendoman\CmsFu\AutoloadFiltered::add_dir( K_SITE_DIR.'#CmsFu' );
```

Above line will add a second directory `#CmsFu` placed in website's root to be looked for funcs. Tweaking base directory and an extra directory, you may set which funcs have priority, as the first found will be used. Any number of additional directories may be added by cloning the line and changing paths. Example below sets 3 directories, main one already *defined* and 2 extra added:

```php
\trendoman\CmsFu\AutoloadFiltered::add_dir( K_SITE_DIR.'#CmsFu' );
\trendoman\CmsFu\AutoloadFiltered::add_dir( K_SITE_DIR.K_SNIPPETS_DIR.'/newfuncs' );
```

Make only sure the slashes are correctly placed, for example constant K_SITE_DIR already has a trailing slash, but K_SNIPPETS_DIR does not.

---

**IMPORTANT NOTE:** You should not worry about performance with multiple directories. Addon makes the **incremental & cached scan**. Suppose you have called three funcs, one named 'test', second is 'alert' and third is 'user'. Addon searches for "\*.func" files consequently in each directory and meanwhile adds found funcs to a list of found files. When the 'test' is found, the list of found files is saved and the next called func 'alert' will not trigger directory scan, because the path is already known. Third function named 'user' will trigger the search, but this scanning will *continue* from the point where the previous scan ended. Such 'continuous' scan will ensure no time is wasted for re-scanning again and again the same folders.


## FOD_FILE_EXTENSION

Perhaps, you'd like to have another extension for your func files, e.g. 'inc' or 'html' or whatever. Use this setting to change that:

```php
define( 'FOD_FILE_EXTENSION', 'func' );
```

It is not possible to have funcs with multiple different extensions, so only one or the other.

## FOD_USE_COUCHCACHE

Couch by default caches snippets and funcs to database for faster access. When a cached snippet or func is 'embedded' Couch will only check modification time on the file and parse it only if it is newer than cached. Default and recommended is ***1***.

```php
define( 'FOD_USE_COUCHCACHE', 1 );
```

Caches are always kept in *parsed* state — this feature of Couch is very nice, because parsing usually takes precious time. Addon will ride on this Couch cache feature to ask files loaded in parsed state from database. Addon removes blocks within 'cms:ignore' tags to keep only essential code before asking Couch to place funcs to cache. Setting will be ignored if you have set parent Couch cache options to ***0*** in `couch/header.php`, lines 62-63:

```php
define( 'K_CACHE_OPCODES', '1' );
define( 'K_CACHE_SETTINGS', '1' );
```

These settings do increase `couch_settings` table in database by a few rows. If that becomes an issue, switch FOD_USE_COUCHCACHE off to ***0*** and above lines to ***0***.

## FOD_PRELOAD_PATHS

Previous settings were tweaking where and how the func files are *searched*. Now let's instruct the addon to read a list of paths and load funcs from it beforehand.

Place somewhere on a page a new tag and set existing path —

```xml
<cms:gen_func_array "<cms:show k_site_path />mysnippets/funcs" />
```

Reload the page, tag executes and you get a list of found funcs to copy-paste into file `config-paths.php` in addon's folder e.g.

```php
<?php

return
array (
  'name' => 'mysnippets/funcs/name.func',
  'show-ms' => 'mysnippets/funcs/DateTime/show-ms/show-ms.func',
);
```

Code above only defines names of two funcs and paths to them. Size of the array does not matter, it may have hundreds of essential funcs. They will get registered to Couch early, i.e. when addon initializes. If some called func is not found in the list above, it will be searched within defined directory(ies).

This setting greatly increases already good performance. It is recommended to generate the code and then set setting at ***1***.

```php
define( 'FOD_PRELOAD_PATHS', 1 );
```

## FOD_CACHE_FILE_ON

If the database caching is off we can use file cache. This is also a way to upload funcs to server in a single file.

Addon can load funcs in their *parsed* state from a single file. Cache is packed and is ready to be sent alongside the addon **even without source funcs code**.

Such cache with funcs can be created by placing a tag on a page once:

```xml
<cms:gen_func_cache />
```

Tag is self-closed, doesn't take any parameters, doesn't search for funcs in directories. It will take already registered funcs i.e. those known to Couch (loaded with this addon, embedded or placed directly in page), crawl them and dump their code directly from Couch to a special file. Parsed state of funcs is the same as to what was said in the [**FOD_USE_COUCHCACHE**](#fod_use_couchcache) section.

Reload the page with tag and it will be executed. When done, it will display "OK (X)", where 'X' is the number of funcs. Check the file 'funcs.dat.md' in the addon's folder. It will overwrite the[ **demo file**](https://github.com/trendoman/Tweakus-Dilectus/blob/main/anton.cms%40ya.ru__func-on-demand/funcs.dat.md) shipped with addon. When you have generated the file with the tag **cms:gen_func_cache** and checked the file exists with all registered funcs, set the setting to ***1***.

```php
define( 'FOD_CACHE_FILE_ON', 1 );
```

Addon will load funcs from file and send them to Couch. It is quite fast, completely unnoticeable process. Name of the file can be changed in the next section.

## FOD_CACHE_FILE

Name for the file in addon's folder for the single cache in previous setting.

```php
define( 'FOD_CACHE_FILE', 'funcs.dat.md' );
```

It is generated by tag **gen_func_cache**, and can be opened in a text editor since it's a simple **Markdown** file. Signatures for all funcs in cache will be added to the top section of the file. Last line will hold a **VALIDATE_HASH** string that is a simple md4 hash to verify the funcs code is identical to what was packed.

Verify the cache is generated, then remove the tag from page.

## Support, suggestions, requests, feedback

Your feedback is always solicited. Drop me a mail and I'll try to get back.

<tony.smirnov@gmail.com>
