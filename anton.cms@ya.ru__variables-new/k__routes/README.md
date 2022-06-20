# k__routes

Adds a new variable `k__routes` to the global context. It contains details about defined routes.

Variable only appears after addon [**Routes**](#related-pages) ('couch/addons/routes') is enabled via `couch/addons/kfunctions.php`.

## Example

List routes as JSON &mdash;

```xml
<cms:test
    ignore='0'
    >
   <cms:if "<cms:tag_exists 'show_json' />">
      <cms:show_json k__routes />
   <cms:else />
      <cms:show k__routes as_json='1' />
   </cms:if>
</cms:test>
```

If you have defined some routes they'd certainly be dumped.

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__routes: Array`

## Related pages

* [**Midware Core Concepts &raquo; Custom Routes**](https://github.com/trendoman/Midware/tree/main/concepts/Custom-Routes)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
