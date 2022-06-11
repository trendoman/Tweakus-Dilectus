# `<cms:base64_encode>`

Performs base64 encoding.

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:set
      myvar='1.1'
    />

  <cms:base64_encode var=myvar /><br>
  <cms:base64_encode>Sample text in a tag-pair</cms:base64_encode>

</cms:test>
```
HTML:
```html
MS4x
U2FtcGxlIHRleHQgaW4gYSB0YWctcGFpcg==
```

## Parameters

* var

## Related tags

* base64_decode
* md5

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
