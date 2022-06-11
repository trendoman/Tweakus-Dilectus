# k_million

Adds new variable `k_million` to the global context. It contains a number - `1000000`.

It helps **not count zeroes** when a limit needs to be set in some tag like *cms:pages*. Less time wasted!

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:dump_all />

</cms:test>
```
HTML:

![million](img/k_million.png)

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

