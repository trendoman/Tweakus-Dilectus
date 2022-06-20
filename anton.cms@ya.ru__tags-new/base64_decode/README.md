# `<cms:base64_decode>`

Performs base64 decoding from a string. Can be used as a self-closed tag or a tag-pair.

```xml
<cms:base64_decode var=myvar />
```

## Parameters

* var

## Example

Set up a variable containing encoded string and pass it as tag's parameter –

```xml
<cms:test ignore='0' >
  <cms:set
      myvar='0J/RgNC40LLQtdGCLCDQkNC90YLQvtC9'
    />

  <cms:base64_decode var=myvar /><br>
</cms:test>
```

or tag's enclosed content –

```xml
<cms:base64_decode>U2FtcGxlIHRleHQgaW4gYSB0YWctcGFpcg==</cms:base64_decode>
```

Output as HTML –

```html
Привет, Антон
Sample text in a tag-pair
```

## Related tags

* [**base64_encode**](../base64_encode)
* [**md5**](../md5)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
