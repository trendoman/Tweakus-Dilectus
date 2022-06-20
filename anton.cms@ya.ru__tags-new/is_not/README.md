# `<cms:is_not>`

A counter-tag for [**cms:is**](#related-tags).

Works for for simple, non-associative [**arrays**](#related-pages) e.g.

```xml
<cms:set langs='["de", "fr", "es"]' is_json='1' />
<cms:is_not val='br' in=langs />
```

## Parameters

* val
* in

## Example

This tag's purpose is to have clearer code and remove the nesting e.g.

```xml
<cms:if "<cms:not "<cms:is 'br' in=langs/>" />" >...</cms:if>
```

becomes –

```xml
<cms:if "<cms:is_not 'br' in=langs/>" >...</cms:if>
```

## Related tags

* **is**
* **arr_val_exists**

## Related pages

* [**Midware Core Concepts &raquo; Couch Arrays**](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
