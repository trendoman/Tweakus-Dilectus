# [Modded `<cms:show>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/show/README.md)

This modification adds new parameters to `<cms:show>` tag &mdash;
- **case** &mdash; *upper, lower, title*
- **encoding**

Discuss in forum &ndash; [open topic](https://www.couchcms.com/forum/viewtopic.php?f=8&t=13015)

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:show 'Hello world' case='upper' /><br>
  <cms:show 'Hello WORLD' case='lower' /><br>
  <cms:show 'ПРИВЕТ, АНТОН' case='title' encoding='UTF-8' /><br>

</cms:test>
```
HTML:
```html
HELLO WORLD
hello world
Привет, Антон
```

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

