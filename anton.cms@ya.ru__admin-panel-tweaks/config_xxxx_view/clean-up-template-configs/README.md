# Clean up configs

Tweak cleans up redundant data from configs left in database after configs were removed from `<cms:template>` block.

## Example

Imagine you added a config to your template &mdash;

```xml
<cms:template title="Index">
  <cms:config_list_view limit='10' searchable='1'/>

  ..other editable fields...
</cms:template>
```

Then, one rainy day, you decide to remove it from that template completely &mdash;

```xml
<cms:template title="Index">

  ..other editable fields...
</cms:template>
```

What happens?

Poor CouchCMS does not see the tags &mdash;
- `<cms:config_list_view />`
- `<cms:config_form_view />`

&ndash; and also does not see *tag's content* (if there was any). So it goes on doing its thing without concern. However &mdash;

**Values are still present in database!**

This little addon makes sure the values are cleaned up properly.

**NOTE:** Alternatively, you may just leave tags without parameters within `cms:template` block and that will re-set the values. Actually, that's exactly what this addon does.

```xml
<cms:template title="Index">
  <cms:config_list_view />
  <cms:config_form_view />

  ..other editable fields...
</cms:template>
```

## Code intel

1. When tag 'cms:config_list_view' or 'cms:config_form_view' is present and executed we set a flag.
2. If tag was not executed it means it is not present inside 'cms:template'.
3. If the tag is not present, assume it was deleted and we need to clear the db.
4. To clear the db, we forcibly re-run the missing tag without params, as if

   ```xml
   <cms:config_list_view />
   <cms:config_form_view />
   ```
   – because tag's native code will handle the db update naturally.

Code does not run for anyone but Superadmin.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
