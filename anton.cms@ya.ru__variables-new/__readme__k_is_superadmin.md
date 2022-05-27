# New variables: `k_is_superadmin`, `k_user_superadmin`

Add `k_is_superadmin`, `k_user_superadmin` to the global context in case **SuperAdmin** is logged in.

Helps make a quick check &mdash;
```html
<cms:if k_user_superadmin>...</cms:if>
```
or
```html
<cms:if k_is_superadmin>...</cms:if>
```
## Example
```html
<cms:test
    ignore='0'
    >
  <cms:dump_all />

</cms:test>
```
HTML (SuperAdmin is logged in):

![context](img/k_is_superadmin.png)

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
