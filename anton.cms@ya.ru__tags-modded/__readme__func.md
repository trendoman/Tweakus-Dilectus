# [Modded `<cms:func>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/__readme__func.md)

Normal: CouchCMS will show an "Error:.." if you forget that a function with the same name has been declared already.
```html
ERROR: tag <cms:func />: 'myfunc' already registered
```
**With this mod**: If identical-named declaration happens, this tag will now simply skip it and move on. Your work will not be stopped.

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:func 'myfunc' >
    hello<br>
  </cms:func>

  <cms:func 'myfunc' >
    hello<br>
  </cms:func>

</cms:test>

<cms:call 'myfunc'/>
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
@date   24.05.2020
@last   30.06.2020
```
