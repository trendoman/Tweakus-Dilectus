# k__gpc

Adds a new variable `k__gpc` to the global context. It contains values from **`G`ET**, **`P`OST**, **`C`OOKIE**.

It is quite comfortable to use this variable instead of tag [**cms:gpc**](#related-tags).

## Example

Compare direct access to values with **k__gpc** Vs. regular usage of `<cms:gpc>` tag &mdash;

```xml
=> http://my.couch/?test=now&pg=2

<cms:test
   ignore='0'
   >
   <cms:if k__gpc.test eq 'now'>Test is running!</cms:if><br>

   <cms:set my_gpc_test = "<cms:gpc 'test' />" />
   <cms:if my_gpc_test eq 'now'>Test is running!</cms:if>
</cms:test>
```

Output from variable or tag is identical &mdash;

```html
=> http://my.couch/?test=true&pg=2

<cms:test
   ignore='0'
   >
   <cms:show k__gpc.pg /> equals to <cms:gpc 'pg' /><br>
</cms:test>
```

Let's take a look at the full content of the JSON.

```xml
<cms:test
    ignore='0'
    >
  <cms:if "<cms:tag_exists 'show_json' />">
     <cms:show_json k__gpc />
  <cms:else />
     <cms:show k__gpc as_json='1' />
  </cms:if>

</cms:test>
```

Variable's JSON has values separated in named sections **get**, **post**, **cookie** and, next, all the same values combined —

```json
{
   "get":{
      "test":"true",
      "pg":"2",
   },
   "post":[],
   "cookie":{
      "KCFINDER_showname":"on",
      "KCFINDER_showsize":"off",
      "KCFINDER_showtime":"off",
      "KCFINDER_order":"name",
      "KCFINDER_orderDesc":"off",
      "KCFINDER_view":"thumbs",
      "KCFINDER_displaySettings":"off",
      "PHPSESSID":"ad8lvi9q2q3hokc4jf3uen9e0512onbr",
      "couchcms_testcookie":"CouchCMS test cookie",
      "couchcms_0990333521d5c55819147eb7bac23c58":"admin:1655032998:e82b6e5a18f79fbea014b0d7c3bdfed8",
      "mycookie":"test"
   },
   "test":"true",
   "pg":"2",
   "KCFINDER_showname":"on",
   "KCFINDER_showsize":"off",
   "KCFINDER_showtime":"off",
   "KCFINDER_order":"name",
   "KCFINDER_orderDesc":"off",
   "KCFINDER_view":"thumbs",
   "KCFINDER_displaySettings":"off",
   "PHPSESSID":"ad8lvi9q2q3hokc4jf3uen9e0512onbr",
   "couchcms_testcookie":"CouchCMS test cookie",
   "couchcms_0990333521d5c55819147eb7bac23c58":"admin:1655032998:e82b6e5a18f79fbea014b0d7c3bdfed8",
   "mycookie":"test"
}
```

Several sections and then all values together – designed to mimic original tag's parameter **method**. If you want to show in code that a value is expected to be passed via **post** method, use the extra hint e.g. `k__gpc.post.myvalue`, otherwise demonstrate an indifference to the source and access directly via `k__gpc.myvalue`.

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__gpc: Array`

## Related tags

* [**Documentation &raquo; gpc**](https://docs.couchcms.com/tags-reference/gpc.html)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
