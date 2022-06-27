# adsense

Shortcode **[adsense]** outputs following –

```html
<script type="text/javascript"><!--
      google_ad_client = "pub-XXXXXXXXXXXXXXXX"; /* Put your own value here */
      google_ad_slot = "XXXXXXXXXX"; /* Put your own value here */
      google_ad_width = 468;
      google_ad_height = 60;
      //-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>';
```

## Parameters

None.

## Usage

Enter the secrets directly in the file `asense/adsense.php`.

### admin-panel

```html
[adsense]
```

### frontend

```xml
<cms:do_shortcodes><cms:show my_content /></cms:do_shortcodes>
```

– here *my_content* is your (richtext) editable field.

## Related pages

* [**Documentation &raquo; Shortcodes**](https://docs.couchcms.com/miscellaneous/shortcodes.html)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

**V.IMP:**
* Do not use the sample `kfunctions.php` file that was provided as part of the [**original documentation**](#related-pages). Use the file `couch/addons/kfunctions.php` instead.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
