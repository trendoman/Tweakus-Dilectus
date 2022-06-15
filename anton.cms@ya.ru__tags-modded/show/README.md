# [Modded `<cms:show>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/show/README.md)

This modification adds new parameters to `<cms:show>` tag &mdash;
- **case** &mdash; *upper, lower, title*
- **encoding** — *UTF-8* (by default), *Windows-1251*...

Parameters are optional. Tag **show** will naturally work as expected, handling JSON and variables, so if the parameters are not provided nothing changes.

## Example

```html
<cms:set example = 'CouchCMS is great' />
<cms:show example case = 'upper' /> will display "COUCHCMS IS GREAT"
<cms:show example case = 'lower' /> will display "couchcms is great"
```
### encoding

```html
<cms:test
    ignore='0'
    >
  <cms:show 'Hello world' case='upper' /><br>
  <cms:show 'Hello WORLD' case='lower' /><br>
  <cms:show 'ПРИВЕТ, АНТОН' case='title' encoding='UTF-8' /><br>

</cms:test>
```
The code above prints —
```html
HELLO WORLD
hello world
Привет, Антон
```

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

