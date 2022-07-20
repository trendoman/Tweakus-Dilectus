# `<cms:eol>`

Echoes newline (aka PHP_EOL).

```xml
<cms:eol />
```

Tag is self-closed without parameters.

## Example

Auto-trimmed spaces at the end of the line are not a problem anymore. Following works fine (in view-source):

```xml
<cms:repeat '3'>
* I'm <cms:show item /><cms:eol />
</cms:repeat>
```

↓

```html
* I'm 0
* I'm 1
* I'm 2
```

To skip an indentation of the line with code indented, use the tag like this:

```xml
<cms:each '1,2,3' sep=','>
   <cms:eol/><cms:show item />
</cms:each>
```

↓

```
1
2
3
```

I have successfully used the example above to write json keeping its pretty indentation:

```xml
<cms:each 'style|color|width|application|material|price|depth' sep='|'>
   <cms:write "mysnippets/json/filter-<cms:show item />.json" truncate='1'>
      <cms:eol /><cms:show_json "<cms:show_repeatable item as_json='1' />" as_html='0' />
   </cms:write>
</cms:each>
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
