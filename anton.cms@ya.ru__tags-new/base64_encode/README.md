# `<cms:base64_encode>`

Performs base64 encoding.

```xml
<cms:base64_encode 'Hello, Dolly!' />
```

## Parameters

* var

## Example

Pass a text to be encoded via parameter or as enclosed content –

```xml
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

Output –

```
MS4x
U2FtcGxlIHRleHQgaW4gYSB0YWctcGFpcg==
```

## Related tags

* [**base64_decode**](../base64_decode)
* [**md5**](../md5)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
