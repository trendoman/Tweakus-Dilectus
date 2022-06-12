# k__tags

Adds a new variable `k__tags` to the global context. It contains names of all present and registered tags.

Additional tags that come with addons that were not properly enabled in `couch/addons/kfunctions.php` are not registered and therefore not listed.

> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Example

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:
```txt
k__tags: Array
```

### listing

List tagnames as JSON &mdash;

```html
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
```html
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

### result

JSON

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

HTML
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

## Usage

Using the examples above, feed your curiosity and list all present tags.<br>
At this moment, there is little usage of this variable, if any ☺.

Normally, we can check if a certain tag is available via **tag_exists** tag e.g.
```html
<cms:if "<cms:tag_exists 'process_login' />"> .. </cms:if>
```
Same can be done with **k__tags** variable and tag **is** (a handy synonym of **arr_val_exists** tag) &mdash;

```html
<cms:if "<cms:is 'process_login' in=k__tags />"> .. </cms:if>
```

Send me your example of **k__tags** usage, if you find any other one.

## Relevant pages

* tag_exists

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
