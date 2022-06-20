## Add items

Addon manipulates admin-panel sidebar to &ndash;

* create __sections__
* create __items__

## Example

Following example from `add-items.php` creates a section named *MyFolder* that sits on top of other sections, using **weight** to tweak order.

```php
$FUNCS->register_admin_menuitem( array('name'=>'_myfolder_', 'title'=>'MyFolder', 'is_header'=>'1', 'weight'=>'-1')  );
```

Templates can be configured to become child items of the section with parameter **parent**.

```xml
<cms:template ... parent='_myfolder_' ... />
```

Edit `add-items.php` directly to change / add more sections.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

Remove the ~ (tilde) from the path to enable tweak.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

