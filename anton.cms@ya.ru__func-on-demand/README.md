# [Func-on-demand](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand)

## Intro

To use &lt;cms:call&gt; with a func, we first need to embed that func code somewhere. This becomes tedious and error prone when there are tens of funcs. With this addon, you can keep all the funcs in a single folder and only specify the path of that folder to addon. Now whenever Couch encounters a [**cms:call**](#related-tags), it will ask addon to locate the code for the func being called and automatically embed it. This is akin to what PHP does with its Autoloading.

**TLDR;** Specify **only location(s) of snippets** to begin with and the [**cms:func**](#related-tags) gets loaded only when that particular func is called with &lt;cms:call&gt; in code. In other words, we recreate for Couch the **autoload** feature.

## Example

Create a snippet ***name.func*** and place it in the 'snippets/funcs' folder e.g. `couch/snippets/funcs/name.func` (or the one defined in `couch/config.php` e.g. 'mysnippets'). Paste the func's code to the snippet e.g.

```xml
<cms:func 'name' name='mate'>
Hi <cms:show name />!
</cms:func>
```

Save the snippet, [**activate the addon**](#configuration) and on *any page* you can now use your new function, even in Admin-panel themes or shortcodes!

```xml
<cms:call 'name' 'Anton' />
→ Hi Anton!
```

## Install

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

In short, copy files and enable addon in `couch/addons/kfunctions.php` file.

```php
require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__func-on-demand/func-on-demand.php' );
```

## Configuration

Open `func-on-demand/config.php` and find following setting –

### FOD_FUNCS_DIRECTORY

Define directory with your func files e.g.

```php
define( 'FOD_FUNCS_DIRECTORY', K_SITE_DIR.K_SNIPPETS_DIR.'/funcs' );
```

Addon will look in all child subfolders of that directory till it finds the file **named exactly as the called func** e.g. "name.func". It is recommended to have a dedicated folder to store funcs, so the lookup happens as fast as possible. Usually it happens within 1/100 of a second or faster. Check out the [**Advanced Configuration**](CONFIG.md) page to see how customize addon further for your *very special* needs.

## Related tags

* [**Midware Tags Reference &raquo; func**](https://github.com/trendoman/Midware/tree/main/tags-reference/func.md)
* [**Midware Tags Reference &raquo; call**](https://github.com/trendoman/Midware/tree/main/tags-reference/call.md)

## Support, suggestions, requests, feedback

Your feedback is always solicited. Drop me a mail and I'll try to get back.

<tony.smirnov@gmail.com>
