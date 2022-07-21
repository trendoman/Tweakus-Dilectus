# `<cms:back2utf>`

Convert escaped unicode such as `\u00f3` back to readable unicode.

```xml
<cms:back2utf>\u304a\u306f\u3088\u3046\u3054\u3056\u3044\u307e\u3059</cms:back2utf>
```

↓

```
おはようございます
```

## Parameters

* *unnamed*

   String may be passed as the first parameter (any name) in a self-closed tag fashion –

   ```xml
   <cms:back2utf myjson />
   ```

## Example

Fixes Couch's automatic conversion in returned json e.g.

```xml
<cms:back2utf><cms:show myvar as_json='1' /></cms:back2utf>
```

\- with repeatable region -

```xml
<cms:back2utf><cms:show_repeatable 'offices' as_json='1' /></cms:back2utf>
```

\- and writing normalized text to disk with 'write' tag (and 'eol' tag adds a new line before the printout) -

```xml
<cms:write "mysnippets/json/saved.json" truncate='1'>
   <cms:eol /><cms:back2utf><cms:show_repeatable 'field' as_json='1' /></cms:back2utf>
</cms:write>
```

\- and for my dear followers that use new tags here is an example with 'show_json' tag that simply prints a pretty-formatted json -

```xml
<cms:show_json "<cms:back2utf><cms:show_repeatable 'field' as_json='1' /></cms:back2utf>" as_html='0' />
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

[![Mail](https://img.shields.io/badge/gmail-%23539CFF.svg?&style=for-the-badge&logo=gmail&logoColor=white)](mailto:"Anton"<tony.smirnov@gmail.com>?subject=[GitHub])

See dedicated [**SUPPORT**](/SUPPORT.md) page.
