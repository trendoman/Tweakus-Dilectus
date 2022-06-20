# `<cms:if_empty>`

A combination of 2 tags &mdash; 'cms:if' plus 'cms:not_empty'.

There was a request from a colleague:

> It would be nice.. without not_empty .. else, just one tag and thats all &mdash; [@andrejprus](https://www.couchcms.com/forum/viewtopic.php?f=2&t=8773#p30507)

And I quickly made it happen &mdash;

```xml
<cms:if_empty fieldname >... empty ...</cms:if_empty>
```

It was certainly useful ☺ —

> SUPER COOL !!!!  &mdash; [@andrejprus](https://www.couchcms.com/forum/viewtopic.php?f=2&t=8773#p30502)

## Example

Let's test some values –

```xml
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

Output –

```
1 is empty!
3 is empty!
```

Using ordinary tag [**cms:not_empty**](#related-tags) the code would've required a condition pyramid –

```xml
<cms:if "<cms:not_empty fieldname />" >
   ... not empty ..
<cms:else />
   ... empty ...
</cms:if>
```

And the code above could be repeated for each value.

## Related tags

* [**Documentation &raquo; not_empty**](https://docs.couchcms.com/tags-reference/not_empty.html)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
