# [Modded `<cms:show>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/show/)

This modification adds new parameters to [**cms:show**](#related-tags) tag &mdash;
- **case** &mdash; with values: *`upper` OR `u`, `lower` OR `l` , `title` OR `t`*.
- **encoding** — with possible values: *UTF-8* (by default), *Windows-1251*...

Parameters are optional. Tag **show** will naturally work as expected, handling JSON and variables, so if the parameters are not provided nothing changes.

## Example

Trying different cases –

```xml
<cms:set example = 'CouchCMS is great' />
<cms:show example case = 'upper' /> == "COUCHCMS IS GREAT"
<cms:show example case = 'lower' /> == "couchcms is great"
```

Trying encoding over cyrillic string –

```xml
<cms:test
    ignore='0'
    >
  <cms:show 'Hello world' case='upper' /><br>
  <cms:show 'Hello WORLD' case='lower' /><br>
  <cms:show 'ПРИВЕТ, АНТОН' case='title' encoding='UTF-8' /><br>

</cms:test>
```

with output —

```
HELLO WORLD
hello world
Привет, Антон
```

## Related tags

* **show**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
