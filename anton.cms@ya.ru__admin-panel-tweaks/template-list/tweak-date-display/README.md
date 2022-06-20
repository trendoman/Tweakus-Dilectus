## Global date format

The code is overriding the core functions inside Couch which are outputting the dates in admin listing pages (there are actually two formats of dates used - one for normal pages and the other used in 'Drafts' listing).

Change the `"M jS Y"` and `"M jS Y @ H:i"` strings to whatever format you desire. Visit the [**Midware Tags Reference &raquo; date**](#related-pages) to view details on many other date-time formats. Note, that CouchCMS supports dates at 1-second resolution i.e. no milliseconds.

For example, open the file and find following lines:

for 'publish date' –

```php
$html = $FUNCS->date( $publish_date, "M jS Y" );
```

and for modification date –

```php
$html = $FUNCS->date( $mod_date, "M jS Y @ H:i" );
```

Values in database are not affected, only the display in admin-panel.

## Related pages

* [**Midware Tags Reference &raquo; date**](https://github.com/trendoman/Midware/tree/main/tags-reference/date.md)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
