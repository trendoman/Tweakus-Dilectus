# [Additional Variables](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__variables-new)

#### This is a collection of additional variables set for CouchCMS' context

Check out *READMEs*, they have examples.

> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Contents

* ### [k__defined](k__defined/)
   Has a few helpful constants defined in CouchCMS.

* ### [k__gpc](k__gpc/)
   It contains values from **GET**, **POST**, **COOKIE**.

* ### [k__is_](k__is_/)
   Follows current visitor's access_level with values either *0* or *1*.
   * k__is_superadmin
   * k__is_admin
   * k__is_user
   * k__is_anon

* ### [k__million](k__million/)
   Variable contains a number *1.000.000*.

* ### [k__server](k__server/)
   View `S_SERVER` superglobal. Contains a few helpful variables such as `HTTP_USER_AGENT`.

* ### [k__session](k__session/)
   View values from the `$_SESSION` superlobal array. Dumps flash messages too.

* ### [k__template_name_safe](k__template_name_safe/)
   Quickly get a safe name of a current template without string manipulation, e.g. *index-php*.

## Example

Variables are placed before user-defined and after Couch-defined vars &mdash;

```txt
k__defined: Array
k__gpc: Array
k__is_superadmin: 1
k__is_admin: 0
k__is_user: 0
k__is_anon: 0
k__million: 1000000
k__server: Array
k__session: Array
k__template_name_safe: index-php
k__template_name_safe_ex: index
```

JSON Arrays can be printed with `<cms:show>` tag or, much recommended, custom `<cms:show_json>` tag e.g.
```html
<cms:show k__defined as_json='1'/>

<cms:show_json k__defined />
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

Check out my dedicated [**SUPPORT**](/SUPPORT.md) page.
