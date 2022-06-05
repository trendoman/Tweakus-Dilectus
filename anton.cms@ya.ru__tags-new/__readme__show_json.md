# New tag: `<cms:show_json>`

Tag **show_json** prints JSON arrays or strings in a pretty readable way.
```html
<cms:show_json myvar />
```
```html
<cms:show_json '{ "id" : "1" }' />
```
```txt
{
    "id" : "1"
}
```

Its syntax reminds of tag **show** and indeed is kinda shortcut to &mdash;
```html
<cms:show myvar as_json='1' />
```
It's striking difference though is ability of **show_json** to prettify JSON output with configurable indentation.

## Example
```html
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

## Usage

If common **show** tag expected only array, **show_json** takes both &mdash; array or JSON-string as its first parameter. That is to showcase its prominent feature &mdash; prettify JSON output.

Let's create an array and see our tag in action &mdash;
```html
<cms:set climate = '{"Russia":{"Moscow":"cold","Sochi":"warm"}}' is_json='1' />
<cms:test
   ignore='0'>

   <cms:show_json climate />

</cms:test>
```

Output is automatically formatted to 3 (default) spaces &mdash;
```txt
{
   "Russia":{
      "Moscow":"cold",
      "Sochi":"warm"
   }
}
```
## Parameters

* as_html
* html_encode
* no_escape
* no_validate
* spaces
* monospace

### as_html

This parameter is usually omitted to invoke its default value (*1*). The spaces are converted to `&nbsp;` &mdash;
```html
<cms:show_json climate />
```
Equals to
```html
<cms:show_json climate as_html='1' />
```

### html_encode

HTML content in JSON nodes will be encoded. Default is *1*. Browsers won't destroy layout if there is a tag somewhere.

### no_escape

Often JSON contains \\escaped \\characters. Parameter **no_escape** (default is *1*) improves readability as it will strip extra forward slashes from the values.

**no_escape** *= '0'*
```json
{
   "k_paginate_link_cur":"http:\/\/my.couch\/worker.php",
   "k_paginate_link_next":"http:\/\/my.couch\/worker.php?pg=2"
}
```
Without parameter &ndash; same as **no_escape** *= '1'* (default) &mdash;
```json
{
   "k_paginate_link_cur":"http://my.couch/worker.php",
   "k_paginate_link_next":"http://my.couch/worker.php?pg=2"
}
```
**CAUTION:** While JSON standard does not require escaping of forward slashes, some parsers may bulk on it.

### no_validate

Finally, **no_validate** set to *1* (default is *0*) instructs the tag to skip validating of input JSON-string if you are 100% sure it is correct (*are you?!*). This setting will slightly improve performance in case of very large JSONs or in repeated operations.<br>

If the first parameter is a JSON-string which indeed is malformed (invalid JSON) *AND* **no_validate** is set to *1*, then there will be no error but the output will lose its beauty.

**ATTN:** Without this parameter (or set to *0*), the validation kicks in and there will be no output at all of malformed JSON.

Common usage would be passing an output of a function that is known to return valid JSON without validation &mdash;
```html
<cms:show_json "<cms:call 'get-users' access_level='10' />" no_validate='1' />
```
Absent parameter **no_validate** equals to *0*. In such case, the string will be validated. Invalid JSON will be blocked.

### spaces

You are free to choose any number of spaces that pleases your eyes. Default is *3*, because *I* like it.

One last note. If you happen to use **show_json** and wish to see the output identical to those of tag **show**, here is how it's done:
```html
<cms:show climate as_json='1' />
```
equals to &ndash;
```html
<cms:show_json climate as_html='0' no_escape='0' spaces='0' />
```

### monospace

Wraps output in `<pre>..</pre>` HTML tags. Default is *1*.<br>
Depends on parameter **as_html**, which is when set to *0*, automatically sets **monospace** to *0* as well.

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms

---

```txt
@author @trendoman <tony.smirnov@gmail.com>
@date   13.06.2019
@last   01.06.2022
```
