# k__routes

Adds a new variable `k__routes` to the global context. It contains details about defined routes.

Variable only appears after addon [**Routes**](#related-pages) ('couch/addons/routes') is enabled via `couch/addons/kfunctions.php`.

> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Example

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:
```txt
k__routes: Array
```

### listing

List routes as JSON &mdash;

```html
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
<!--

### result

```json
```

## Usage

-->

## Related pages

* [**&raquo; Tutorial – Custom Routes**](https://github.com/trendoman/Midware/tree/main/tutorials/Custom-Routes)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
