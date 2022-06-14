# `<cms:is_not>`

A counter-tag for **is**.

Works for for non-associative arrays e.g.
```html
<cms:set langs='["de", "fr", "es"]' is_json='1' />
<cms:is_not val='br' in=langs />
```
## Example

This tag's purpose is to have clearer code and remove the nesting e.g.
```html
<cms:if "<cms:not "<cms:is 'br' in=langs/>" />" >...</cms:if>
```
becomes
```html
<cms:if "<cms:is_not 'br' in=langs/>" >...</cms:if>
```

## Parameters

* val
* in

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
