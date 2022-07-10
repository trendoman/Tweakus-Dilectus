# `<cms:close_session>`

End the current session and store session data. Tag is self-closed without parameters.

```xml
<cms:close_session />
```

Session data is locked to prevent concurrent writes i.e. only one script may operate on a session at any time. For example, a page that makes an ajax request, where the ajax request polls a server-side event (and may not return immediately). If the ajax processing server-side code doesn't do **cms:close_session**, then your outer page will appear to hang, and opening other pages in new tabs will also stall.

May be used in pair with **cms:db_commit_trans** tag.

## Related tags

* **db_commit_trans**

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
