# k__tags

Adds a new variable `k__tags` to the global context. It contains names of all present and registered tags.

Additional tags that come with addons that were not properly enabled in `couch/addons/kfunctions.php` are not registered and therefore not listed.

## Example

List array of tags as JSON &mdash;

```xml
<cms:test
    ignore='0'
    >
   <cms:if "<cms:tag_exists 'show_json' />">
      <cms:show_json k__tags />
   <cms:else />
      <cms:show k__tags as_json='1' />
   </cms:if>
</cms:test>
```

List tagnames as an ordered list &mdash;

```xml
<cms:test
   ignore='0'
   >
   <ol>
      <cms:each k__tags is_json='1'>
      <li><cms:show item /></li>
      </cms:each>
   </ol>
</cms:test>
```

Output as JSON –

```json
[
   "abort",
   "add",
   "add_querystring",
   "addslashes",
 ...
   "weeks",
   "while",
   "write",
   "zebra"
]
```

Output as HTML –

```html
1. abort
2. add
3. add_querystring
4. addslashes
..
194. while
195. write
196. zebra
```


Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__tags: Array`

## Usage

Using the examples above, feed your curiosity and list all present tags.

At this moment, there is little usage of this variable, if any ☺.

Maybe if you study some addon, like Cart or Extended Users/Folders/Comments addon, it may be beneficial to see all tags that it has to offer.

We can also check if a certain known tag is available via [**cms:tag_exists**](#related-tags) e.g.

```xml
<cms:if "<cms:tag_exists 'process_login' />"> .. </cms:if>
```

Same can be done with **k__tags** array and tag [**cms:is**](#related-tags), a handy synonym of [**cms:arr_val_exists**](#related-tags) &mdash;

```xml
<cms:if "<cms:is 'process_login' in=k__tags />"> .. </cms:if>
```

Send me your example of **k__tags** usage, if you find any other one.

## Related tags

* [**Midware Tags Reference &raquo; tag_exists**](https://github.com/trendoman/Midware/tree/main/tags-reference/tag_exists.md)
* **cms:is**
* **cms:arr_val_exists**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
