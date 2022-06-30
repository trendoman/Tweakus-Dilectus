# `<cms:show_json>`

Tag **show_json** pretty-prints JSON-formatted strings (objects, arrays). It is quite helpful for working with [**Couch Arrays**](#related-pages).

```xml
<cms:show_json myjson />
```

## Example

Pass a JSON-formatted string –

```xml
<cms:show_json '{ "id" : "1" }' />
```

and see –

```js
{
    "id" : "1"
}
```

Or pass an existing array e.g.

```xml
<cms:set langcodes='["de", "fr", "es", "ru"]' is_json='1' />
<cms:show_json langcodes />
```


```js
[
   "de",
   "fr",
   "es",
   "ru"
]
```

Tag's syntax reminds of tag [**cms:show**](#related-tags) and indeed piggybacks onto &mdash;

```xml
<cms:show myvar as_json='1' />
```

Tag's striking feat is **configurable indentation and HTML**. Full list of parameters with their default values —

```xml
<cms:show_json myvar
   scope='parent'
   as_html='1'
   html_encode='1'
   escape='0'
   spaces='3'
   monospace='1'
/>
```

Let's see each parameter closely.

## Parameters

* ***unnamed***
* **scope**
* **as_html**
* **html_encode**
* **escape**
* **spaces**
* **monospace**

**First *unnamed* parameter can be array or JSON-formatted string.**

### scope

Takes the same values as [**cms:show**](#related-tags) would expect.

### as_html

This parameter is usually omitted to invoke its default value ***1***. Spaces in resulting HTML will be converted to `&nbsp;` &mdash;

```xml
<cms:show_json climate />
```

Code above equals to –

```xml
<cms:show_json climate as_html='1' />
```

### html_encode

Default is ***1*** — HTML content in JSON nodes will be encoded. Browser won't destroy pretty layout if there is a HTML `<tag>` somewhere in a node, trying to render it.

Of course, if **as_html** is ***0***, then **html_encode** will also be ***0*** and content will not be encoded.

### escape

Often JSON contains \\escaped \\characters. Parameter **escape** (default is ***0***) improves readability as it will strip extra forward slashes from the values.

***escape = '1'***

```json
{
   "k_paginate_link_cur":"http:\/\/my.couch\/worker.php",
   "k_paginate_link_next":"http:\/\/my.couch\/worker.php?pg=2"
}
```

and without parameter (same as default ***escape = '0'***) &mdash;

```json
{
   "k_paginate_link_cur":"http://my.couch/worker.php",
   "k_paginate_link_next":"http://my.couch/worker.php?pg=2"
}
```

---

**CAUTION:** JSON standard *does not require* escaping of forward slashes, but keep an eye on 3rd-party parsers you send JSON to.

### spaces

You are free to choose any number of spaces that pleases your eyes. Default is ***3***.

```xml
<cms:capture into='climate' is_json='1'>
{
   "Russia":{
      "Moscow":"cold",
      "Sochi":"warm"
   }
}
</cms:capture >
<cms:show_json climate spaces='0'/>
```

With ***spaces = '0'*** everything becomes unindented:
```js
{
"Russia":{
"Moscow":"cold",
"Sochi":"warm"
}
```

And ***spaces = '5'*** expectedly goes as:

```js
{
     "Russia":{
          "Moscow":"cold",
          "Sochi":"warm"
     }
}
```

Do not forget that the print is actually HTML-formatted and HTML-encoded.

<details><summary>Last example's actual HTML</summary>

```html
{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Russia&quot;:{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Moscow&quot;:&quot;cold&quot;,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;Sochi&quot;:&quot;warm&quot;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>}
```
</details>

### monospace

Wraps output in `<pre>..</pre>` HTML tags. Default is ***1***. It can not be activated without HTML-formatting i.e. when **as_html** is *0*, automatically **monospace** becomes *0* as well.

## Usage

We can see the output identical to that of 'cms:show' by unsetting default values as follows –

```xml
<cms:show_json climate as_html='0' escape='1' spaces='0' />
```

Let's create an array and see our tag in action &mdash;

```xml
<cms:set climate = '{"Russia":{"Moscow":"cold","Sochi":"warm"}}' is_json='1' />
<cms:test
   ignore='0'>
   <cms:show_json climate />
</cms:test>
```

Output looks pretty in browser &mdash;

```js
{
   "Russia":{
      "Moscow":"cold",
      "Sochi":"warm"
   }
}
```

## Related tags

* **show**

## Related pages

* [**Midware Core Concepts &raquo; Couch Arrays**](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
