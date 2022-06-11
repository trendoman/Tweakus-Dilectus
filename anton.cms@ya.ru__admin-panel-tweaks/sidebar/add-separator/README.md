## Add a separator

**Separator** entry is just a little spacer between templates in the sidebar section.

Can be placed inside a collapsible folder and aligned by weight.

Change style and layout in `couch/theme/../sidebar.html` thanks to a custom class ***my-separator*** that is added in code for each separator &mdash;
```html
<cms:if k_menu_class eq 'my-separator'>..</cms:if>
=> ok, this is our separator
```
Read more here &ndash; https://www.couchcms.com/forum/viewtopic.php?f=8&t=9887

Set the separator item directly in code: `add-separator.php`.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

Remove the ~ (tilde) from the path to enable tweak.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

