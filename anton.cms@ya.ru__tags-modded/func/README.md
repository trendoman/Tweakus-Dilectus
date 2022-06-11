# [Modded `<cms:func>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/func/README.md)

By default, CouchCMS will show an *Error: ...* if you forget that a function with the same name had been already declared.
```html
ERROR: tag <cms:func />: 'myfunc' already registered
```
**With this mod**: If identical-named declaration happens, this tag will now simply skip it and move on. Your work will not be stopped.

## Example
```html
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

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
