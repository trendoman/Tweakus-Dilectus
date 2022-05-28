# [Aliases for Tags](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-aliased)

Addon allows to use a more comfortable name for a tag.

Check the code in `aliased-tags.php` for existing aliases and make your own changes.

Discussion of the addon is in the [forum topic](https://www.couchcms.com/forum/viewtopic.php?f=3&t=12536).

## Example:

```html
<cms:slashes> instead of <cms:add_slashes>
<cms:qs> instead of <cms:add_querystring>
```

## Installation

1. Place current folder into &ndash; `couch/addons`
2. Put this line to &ndash; `couch/addons/kfunctions.php`
    ```php
    require_once( K_COUCH_DIR.'addons/anton.cms@ya.ru__tags-aliased/aliased-tags.php' );
    ```
    Advice: Check out **Extended KFunctions** [repository](https://github.com/trendoman/Extended-KFunctions) &ndash; it has everything packed neatly.

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms
