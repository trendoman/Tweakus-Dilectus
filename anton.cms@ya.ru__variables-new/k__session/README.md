# k__session

Adds a new variable `k__session` to the global context. It contains values from the `$_SESSION` superlobal array.

## Example

Let's print the content of session after setting some values to it –

```xml
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

Sample output (on my local machine) –

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

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__session: Array`

## Usage

Variable gives access to user-defined session vars set by tag `<cms:set_session>` and Couch's *flash* messages set by tag `<cms:set_flash>`.

If you are interested in one of the values print it with 'cms:show' &mdash;

```xml
<cms:show k__server.mysession />
```

## Related tags

* **set_session**
* **get_session**
* **set_flash**
* **get_flash**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
