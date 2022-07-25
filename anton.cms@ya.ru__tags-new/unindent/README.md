# `<cms:unindent>`

Remove excessive indentation. Detects minimal available indentation and shifts other lines to the left.

```xml
<cms:unindent myhtml />
```

As tag-pair:

```xml
<cms:unindent><cms:show myhtml /></cms:unindent>
```

## Parameters

* unnamed

   Very first parameter string or enclosed content will be taken for trimming.

* full

   Completely strip all indentation

## Example

```xml
<cms:unindent>
      <ul>
         <li>1</li>
         <li>2</li>

         <li>3</li>
      </ul>
</cms:unindent>
```

↓

```html
<ul>
   <li>1</li>
   <li>2</li>
   <li>3</li>
</ul>
```

```xml
<cms:unindent full='1'>
      <ul>
         <li>1</li>
         <li>2</li>

         <li>3</li>
      </ul>
</cms:unindent>
```

↓

```html
<ul>
<li>1</li>
<li>2</li>
<li>3</li>
</ul>
```

## Usage

A trivial dump of some HTML beautifully alinged to the left

```xml
<cms:write 'log.html'>
   <cms:unindent captured_html full='1'/>
</cms:write>
```

## Related tags

* **[Midware Tags Reference » trim](https://github.com/trendoman/Midware/tree/main/tags-reference/trim.md)**
* **[Tweakus-Dilectus Tags » eol](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-new/eol)**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
