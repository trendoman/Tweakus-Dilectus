# `<cms:if_empty>`

A combination of 2 tags &mdash; `<cms:if>` plus `<cms:not_empty>`.

Previously it was required to make a more complicated logic -
```html
<cms:if "<cms:not_empty fieldname />" >
   ... not empty ..
<cms:else />
   ... empty ...
</cms:if>
```

Then there was a request from a friend:

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

See dedicated [**SUPPORT**](/SUPPORT.md) page.
