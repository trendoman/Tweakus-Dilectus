# k__session

Adds a new variable `k__session` to the global context. It contains values from the `$_SESSION` superlobal array.

> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Example

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:
```txt
k__session: Array
```

### listing

```html
<cms:test
    ignore='0'
    >
   <cms:set_session 'mysession' "42" />
   <cms:set_flash 'myflash' "it's a flash" />

   <cms:if "<cms:tag_exists 'show_json' />">
      <cms:show_json k__session />
   <cms:else />
      <cms:show k__session as_json='1' />
   </cms:if>
</cms:test>
```

### result

```json
{
   "KSESSIONmsgs":{
      "old_msgs":{
         "myflash":"it's a flash"
      },
      "new_msgs":[]
   },
   "KCFINDER":{
      "disabled":false,
      "uploadURL":"http://my.couch/myuploads/",
      "uploadDir":"D:/CloudOne/OpenServer/domains/my.couch/myuploads/",
      "self":{
         "dir":"image"
      }
   },
   "mysession":"42"
}
```

## Usage

Variable gives access to user-defined session vars set by tag `<cms:set_session>` and Couch's *flash* messages set by tag `<cms:set_flash>`.

If you are interested in one of the values print it with `<cms:show>` &mdash;
```html
<cms:show k__server.mysession />
```

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
