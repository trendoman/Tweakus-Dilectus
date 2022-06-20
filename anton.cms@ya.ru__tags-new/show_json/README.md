# `<cms:show_json>`

Tag **show_json** prints JSON arrays or strings beautifully aka pretty-print.

```xml
<cms:show_json myvar />
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

Tag's syntax reminds of tag [**cms:show**](#related-tags) and indeed is kinda shortcut to &mdash;

```xml
<cms:show myvar as_json='1' />
```

**However**, it's striking difference is ability of **show_json** to prettify JSON output with configurable indentation. Full list of parameters with default values —

```xml
<cms:test
   ignore='0'
   >
   <cms:show_json myvar
      as_html='1'
      html_encode='1'
      no_escape='1'
      no_validate='0'
      spaces='3'
      monospace='1'
      />
</cms:test>
```

Let's see each parameter closely.

## Parameters

* unnamed – mandatory value placed first after tag's name, similar to 'cms:show'
* as_html
* html_encode
* no_escape
* no_validate
* spaces
* monospace

### as_html

This parameter is usually omitted to invoke its default value *1*. Spaces in resulting HTML will be converted to `&nbsp;` &mdash;

```xml
<cms:show_json climate />
```

Code above equals to –

```html
<cms:show_json climate as_html='1' />
```

### html_encode

HTML content in JSON nodes will be encoded. Default is *1*. Browsers won't try to render HTML tags destroying pretty layout if there is a `<tag>` somewhere in a node.

### no_escape

Often JSON contains \\escaped \\characters. Parameter **no_escape** (default is *1*) improves readability as it will strip extra forward slashes from the values.

**no_escape** = '0'

```json
{
   "k_paginate_link_cur":"http:\/\/my.couch\/worker.php",
   "k_paginate_link_next":"http:\/\/my.couch\/worker.php?pg=2"
}
```

and without parameter (same as no_escape = '1' - which is by default) &mdash;

```json
{
   "k_paginate_link_cur":"http://my.couch/worker.php",
   "k_paginate_link_next":"http://my.couch/worker.php?pg=2"
}
```

**CAUTION:** While JSON standard does not require escaping of forward slashes, some nasty parsers may bulk on it.

### no_validate

Finally, **no_validate** set to *1* (default is *0*) instructs the tag to skip validating of input JSON-string if you are 100% sure it is correct (*are you?!*). This setting will slightly improve performance in case of very large JSONs or in repeated operations.

If the first parameter is a JSON-string which indeed is malformed (invalid JSON) *AND* **no_validate** is set to *1*, then there will be no error but the output will lose its beauty. Without this parameter (or set to *0*), the validation kicks in and there will be no output at all of malformed JSON.

Common usage would be passing a string or an output of a function that is known to return valid JSON without validation &mdash;

```xml
<cms:show_json "<cms:call 'get-users' access_level='10' />" no_validate='1' />
```

Absent parameter **no_validate** equals to *0*. In such case, the string will be validated. Invalid JSON will be blocked form output.

### spaces

You are free to choose any number of spaces that pleases your eyes. Default is *3*.

One last note. If you happen to use **show_json** but were forcefully tortured to see the output identical to that of tag 'cms:show', here is how it's done without much pain:

```xml
<cms:show climate as_json='1' />
```

equals to &ndash;

```xml
<cms:show_json climate as_html='0' no_escape='0' spaces='0' />
```

### monospace

Wraps output in `<pre>..</pre>` HTML tags. Default is *1*.

Depends on parameter **as_html**, which is when set to *0*, automatically sets **monospace** to *0* as well.

## Usage

Tag **show_json** takes both &mdash; array or JSON-string as its first parameter.

Let's create an array and see our tag in action &mdash;

```xml
<cms:set climate = '{"Russia":{"Moscow":"cold","Sochi":"warm"}}' is_json='1' />
<cms:test
   ignore='0'>

   <cms:show_json climate />

</cms:test>
```

Output is automatically formatted to 3 (default) spaces &mdash;

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

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
