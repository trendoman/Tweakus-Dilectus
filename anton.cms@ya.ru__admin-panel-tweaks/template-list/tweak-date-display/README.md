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

See dedicated [**SUPPORT**](/SUPPORT.md) page.
