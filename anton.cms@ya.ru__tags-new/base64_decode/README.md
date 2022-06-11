# `<cms:base64_decode>`

Performs base64 decoding from a string. Can be used as a self-closed tag or a tag-pair.


## Example
```html
<cms:test ignore='0' >
  <cms:set
      myvar='0J/RgNC40LLQtdGCLCDQkNC90YLQvtC9'
    />

  <cms:base64_decode var=myvar /><br>
  <cms:base64_decode>U2FtcGxlIHRleHQgaW4gYSB0YWctcGFpcg==</cms:base64_decode>
</cms:test>
```
HTML:
```html
Привет, Антон
Sample text in a tag-pair
```

## Parameters

* var

## Related tags

* base64_encode
* md5

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

