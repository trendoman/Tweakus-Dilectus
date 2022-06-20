# k__million

Adds a new variable `k__million` to the global context. It contains a number `1000000`.

It helps **not count zeroes** when a huge overlapping limit needs to be set in some tag like 'cms:pages' to surely iterate through all available pages. Tag's default limit is always at *1000*, if you didn't know ☺.

## Example

```xml
<cms:pages masterpage='orders.php' limit=k__million return_sql='1' />
```

Variable is set in global scope so is visible with dump &mdash;

```xml
<cms:test
    ignore='0'
    >
  <cms:dump_all />
</cms:test>
```

Output –

![million](img/k__million.png)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
