# `<cms:md5>`

Calculates MD5 hash of any content.

```xml
<cms:md5 var=myvar />
```

## Parameters

* var

## Example

```xml
<cms:test
    ignore='0'
    >
  <cms:set
      myvar='example text'
    />

  <cms:md5 var=myvar />

</cms:test>
```

Output –

```
f81e29ae988b19699abd92c59906d0ee
```

## Related tags

* [**base64_encode**](../base64_encode)
* [**base64_decode**](../base64_decode)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

