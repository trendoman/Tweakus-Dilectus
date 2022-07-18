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

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
