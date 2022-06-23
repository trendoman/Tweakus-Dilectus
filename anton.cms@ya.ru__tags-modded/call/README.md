# [Modded `<cms:call>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/call)

There are 2 modifications:

**a. Output is automatically trimmed**, i.e. removed spaces around the result (similar to how tag [**cms:trim**](#related-tags) works)

**b. Allow to mix named and unnamed values for parameters**, take canonical example —

```xml
<cms:call 'makecoffee' 'small' type='espresso' />
```

Here *small* is the unnamed value of parameter **size** and *espresso* is the named value of parameter **type**. Originally, **all parameters must be either named or unnamed**. Order of unnamed parameter still must match the declaration of cms:func. Without this mod, the result can not be guaranteed.

Let's see another example of function declaration and correct use of order for unnamed parameters —

```xml
<cms:func 'purchase' product='' amount='' reason=''>
    I have purchased a <cms:show product /> for <cms:show amount />. I want to <cms:show reason />!
</cms:func>
```

Thanks to present mod, named parameters may appear in any place, but unnamed ones must follow original declaration — 'amount' after 'product' –

```xml
<cms:call 'purchase' 'phone' reason='send it as a present' '$200' />
=> I have purchased a phone for $200. I want to send it as a present!
```

## Related tags

* [**Midware Tags Reference &raquo; call**](https://github.com/trendoman/Midware/tree/main/tags-reference/call.md)
* [**Midware Tags Reference &raquo; func**](https://github.com/trendoman/Midware/tree/main/tags-reference/func.md)
* [**Midware Tags Reference &raquo; trim**](https://github.com/trendoman/Midware/tree/main/tags-reference/trim.md)


## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
