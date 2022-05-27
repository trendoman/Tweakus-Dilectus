# New tag: `<cms:if_empty>`

A combination of 2 tags &mdash; `<cms:if>` plus `<cms:not_empty>`.

Previously it was required to make a more complicated logic -
```html
<cms:if "<cms:not_empty fieldname />" >
   ... not empty ..
<cms:else />
   ... empty ...
</cms:if>
```

Then there was a request:

> It would be nice.. without not_empty .. else, just one tag and thats all &mdash; [@andrejprus](https://www.couchcms.com/forum/viewtopic.php?f=2&t=8773#p30507)

And I quickly made it happen &mdash;
```html
<cms:if_empty fieldname >... empty ...</cms:if_empty>
```
> SUPER COOL !!!!  &mdash; [@andrejprus](https://www.couchcms.com/forum/viewtopic.php?f=2&t=8773#p30502)

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:set var1 = '' />
  <cms:set var2 = '0' />
  <cms:set var3 = '<p></p>' />

  <cms:if_empty var1 >1 is empty!<br></cms:if_empty>
  <cms:if_empty var2 >2 is empty!<br></cms:if_empty>
  <cms:if_empty var3 >3 is empty!<br></cms:if_empty>

</cms:test>
```
HTML:
```html
1 is empty!
3 is empty!
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
@author Anton S aka Trendoman <tony.smirnov@gmail.com>
@date   13.06.2019
```
