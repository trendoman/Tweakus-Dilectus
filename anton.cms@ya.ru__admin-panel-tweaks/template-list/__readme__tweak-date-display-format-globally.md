## Global date format

The code is overriding the core functions inside Couch which are outputting the dates in admin listing pages (there are actually two formats of dates used - one for normal pages and the other used in 'Drafts' listing).


Change the `"M jS Y"` and `"M jS Y @ H:i"` strings to whatever format you desire.

The details of that format is found at - http://docs.couchcms.com/tags-reference/date.html

For example -
```php
$html = $FUNCS->date( $publish_date, "d.m.Y" );
$html = $FUNCS->date( $mod_date, "d.m.Y @ H:i" );
```

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms

---

```txt
@link   https://www.couchcms.com/forum/viewtopic.php?f=4&t=11313&p=30107#p30107
@author Kamran Kashif aka KK <kksidd@couchcms.com>
@author Anton S aka Trendoman <tony.smirnov@gmail.com>
@date   26.05.2022
```
