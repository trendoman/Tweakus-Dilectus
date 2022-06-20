# [Modded `<cms:func>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/func/README.md)

Allows to ignore double-declaration of funcs.

By default, CouchCMS will show an *Error: ...* if you forget that a function with the same name had been already declared.

`ERROR: tag <cms:func />: 'myfunc' already registered`

**With this mod**: If identical-named declaration happens, tag will simply skip it and move on. Your work will not be stopped.

## Example

Let's re-declare the same 'myfunc' and call it –
```xml
<cms:test
    ignore='0'
    >
  <cms:func 'myfunc' >
    hello<br>
  </cms:func>

  <cms:func 'myfunc' >
    hello<br>
  </cms:func>

</cms:test>

<cms:call 'myfunc'/>
```

Expectedly, nothing bad happens.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
