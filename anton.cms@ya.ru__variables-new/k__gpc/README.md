# k__gpc

Adds a new variable `k__gpc` to the global context. It contains values from GET, POST, COOKIE.

It is quite comfortable to use this variable instead of tag `<cms:gpc>`.

> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Example
Since on the left side of the `<cms:if>` comparison there must be a variable or a value, not expression, the tag's variant requires an extra line.

Compare direct access to values with **k__gpc** Vs regular usage of `<cms:gpc>` tag &mdash;

```html
=> http://my.couch/?test=now&pg=2

<cms:test
   ignore='0'
   >
   <cms:if k__gpc.test eq 'now'>Test is running!</cms:if><br>

   <cms:set my_gpc_test = "<cms:gpc 'test' />" />
   <cms:if my_gpc_test eq 'now'>Test is running!</cms:if>
</cms:test>
```
See how simple print can be done with either `<cms:show>` or `<cms:gpc>` &mdash;
```html
=> http://my.couch/?test=true&pg=2

<cms:test
   ignore='0'
   >
   <cms:show k__gpc.pg /> = <cms:gpc 'pg' /><br>
</cms:test>
```


## Usage

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:
```txt
k__gpc: Array
```

### listing

Let's take a look at the full content of the JSON.
```html
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

### result

Variable's JSON has values separated in named sections **get**, **post**, **cookie** and, next, all the same values combined.<br>

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

### compatibility

Variable **k__gpc** is compatible with a **method** set via `<cms:gpc>` tag. If you want to show in code that a value is expected to be passed via **post** method, use the extended syntax e.g. `k__gpc.post.myvalue`, otherwise use direct access &ndash; `k__gpc.myvalue`.


## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

