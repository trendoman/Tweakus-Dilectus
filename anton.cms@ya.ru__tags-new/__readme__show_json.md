# New tag: `<cms:show_json>`

Kinda shortcut to &mdash;
```html
<cms:show myvar as_json='1' />
```
Also `show_json` can prettify JSON output with configurable indentation.

## Example
```html
<cms:test
   ignore='0'
   >
   <cms:show_json myvar
      as_html='1'
      no_escape=''
      no_validate=''
      spaces='4'
      />
</cms:test>
```

## Usage

If **show** tag expected only array, **show_json** takes both &mdash; array or JSON-string as its first parameter. That is to showcase its prominent feature &mdash; prettify JSON output.

Let's create an array and see tag in action &mdash;
```html
<cms:set climate = '{"Russia":{"Moscow":"cold","Sochi":"warm"}}' is_json='1' />
<cms:test
   ignore='0'>

   <pre><cms:show_json climate /></pre>

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

#### as_html

If you do not want to wrap tag in `<pre>` as I did above, then use parameter **as_html**, which can be either *0* (default) or *1*, and see spaces converted to `&nbsp;` &mdash;
```html
<cms:show_json climate as_html='1' />
```

#### no_escape

Often JSON contains \\escaped \\characters. Set parameter **no_escape** to *1* (default is *0*) to improve readability as it will strip values from extra forward slashes.

Without parameter &ndash; same as **no_escape** *= '0'*
```json
{
   "k_paginate_link_cur":"http:\/\/my.couch\/worker.php",
   "k_paginate_link_next":"http:\/\/my.couch\/worker.php?pg=2",
}
```
**no_escape** *= '1'*
```json
{
   "k_paginate_link_cur":"http://my.couch/worker.php",
   "k_paginate_link_next":"http://my.couch/worker.php?pg=2",
}
```
**CAUTION:** While JSON standard does not require escaping of forward slashes, some parsers may bulk on it. So it is safer to keep slashes escaped.

#### no_validate

Finally, **no_validate** set to *1* (default is *0*) instructs the tag to skip validating of input JSON-string if you are 100% sure it is correct (*are you?!*). This setting will slightly improve performance in case of very large JSONs or in repeated operations.<br>
**ATTN:** If the first parameter is a JSON-string which indeed is malformed (invalid JSON) *AND* **no_validate** is set to *1*, then there will be no error but the output will lose its beauty. Without this parameter (or set to *0*), the validation kicks in and there will be no output at all.

#### spaces

You are free to choose any number of spaces that pleases your eyes. Default is *3*, because *I* like it.

One last note. If you happen to use `show_json` and wish to see the output identical to those of tag `show`, here is how it's done:
```html
<cms:show climate as_json='1' />
```
equals to &ndash;
```html
<cms:show_json climate spaces='0' />
```

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
@last   30.05.2022
```
