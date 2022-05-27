## Clean up configs of `<cms:template>`

Imagine you added a config to your template &mdash;
```html
<cms:template title="Index">
  <cms:config_list_view limit='10' searchable='1'/>

  ..other editable fields...
</cms:template>
```
Then, one rainy day, you decide to remove it from that template completely &mdash;
```html
<cms:template title="Index">

  ..other editable fields...
</cms:template>
```

What happens?

Poor CouchCMS does not see the tags &mdash;
- `<cms:config_list_view />`
- `<cms:config_form_view />`

&ndash; and also does not see *tag's content* (if there was any). So it goes on doing its thing without concern. However &mdash;

**Values are still present in database!**

This little addon makes sure the values are cleaned up properly.

**NOTE:** Alternatively, you may just leave tags without parameters within `cms:template` block and that will re-set the values. Actually, that's exactly what this addon does.

### Logic of PHP code:

1. When tag `:config_list_view` or `:config_form_view` is executed we set a flag.
2. If tag was not executed it means it is not present inside `cms:template`.
3. If the tag is not present, assume it was deleted and we need to clear the db.
4. To clear the db, we forcibly re-run the missing tag without params, as if
```html
<cms:config_list_view />
<cms:config_form_view />
```
because tag's native code will handle the db update naturally.

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms

---

```txt
@author "Anton Smirnov aka Trendoman" <tony.smirnov@gmail.com>
@date   12.06.2019
@last   14.02.2020
```
