# admin_create_link

Tag **cms:admin_create_link** outputs a link to the admin-panel "Add new page" screen of a clonable template.

```xml
<cms:admin_create_link />
```

## Example

Administrators will see the link to the "Add new" screen of admin-panel in case the template is a clonable one.

```xml
<cms:if k_user_access_level ge '7'>
   <a href="<cms:admin_create_link />">Create a new page</a>
</cms:if>
```

Tag works for the template in the context. Add another template's context with 'cms:pages' to get corresponding links for any template —

```xml
<cms:if k_user_access_level ge '7'>
   <cms:pages masterpage='gallery.php' limit='1' show_unpublished='1'>
      <a href="<cms:admin_create_link />">Add a new Gallery image</a>
   </cms:pages>
</cms:if>
```

## Related tags

* **admin_link** <!--returns the admin panel edit link of page in context.-->
* **admin_delete_link** <!--returns the admin panel delete link of page in context.-->

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
