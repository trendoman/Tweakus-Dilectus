# k__defined

Adds a new variable `k__defined` to the global context.

It contains a few constants defined in CouchCMS but not visible in extended dump (using tag `<cms:dump_all />`).

## Example

Let's print the content of the variable –

```xml
<cms:test
    ignore='0'
    >
  <cms:if "<cms:tag_exists 'show_json' />">
     <cms:show_json k__defined />
  <cms:else />
     <cms:show k__defined as_json='1' />
  </cms:if>

</cms:test>
```

Sample output (from my local machine) –

```json
{
   "K_ADDONS_DIR":"D:/CloudOne/OpenServer/domains/my.couch/couch/addons/",
   "K_SNIPPETS_DIR":"mysnippets",
   "K_UPLOAD_DIR":"myuploads",
   "K_GMT_OFFSET":3,
   "K_CACHE_OPCODES":"1",
   "K_CACHE_SETTINGS":"0",
   "K_USE_CACHE":0,
   "K_MAX_CACHE_AGE":168,
   "K_CACHE_PURGE_INTERVAL":24,
   "K_SITE_OFFLINE":0,
   "K_ADMIN":0,
   "K_ADMIN_LANG":"EN",
   "K_HTTPS":0,
   "K_IS_MY_TEST_MACHINE":1,
   "K_COMMENTS_INTERVAL":0,
   "K_COMMENTS_REQUIRE_APPROVAL":1,
   "K_PAID_LICENSE":0,
   "K_REMOVE_FOOTER_LINK":0,
   "K_DB_HOST":"127.0.0.1",
   "K_DB_NAME":"my1couch",
   "K_DB_PASSWORD":"",
   "K_DB_TABLES_PREFIX":"",
   "K_DB_USER":"root",
   "K_TBL_ATTACHMENTS":"couch_attachments",
   "K_TBL_COMMENTS":"couch_comments",
   "K_TBL_DATA_NUMERIC":"couch_data_numeric",
   "K_TBL_DATA_TEXT":"couch_data_text",
   "K_TBL_FIELDS":"couch_fields",
   "K_TBL_FOLDERS":"couch_folders",
   "K_TBL_FULLTEXT":"couch_fulltext",
   "K_TBL_PAGES":"couch_pages",
   "K_TBL_RELATIONS":"couch_relations",
   "K_TBL_SETTINGS":"couch_settings",
   "K_TBL_TEMPLATES":"couch_templates",
   "K_TBL_USER_LEVELS":"couch_levels",
   "K_TBL_USERS":"couch_users",
   "K_TBL_VOTES_CALC":"",
   "K_TBL_VOTES_RAW":"",
   "K_VOTE_VERSION":"",
   "K_VOTE_WINDOW_ANON":"",
   "K_VOTE_WINDOW_MEMBER":"",
   "K_PAYPAL_CURRENCY":"USD",
   "K_PAYPAL_EMAIL":"seller_1272492192_biz@gmail.com",
   "K_PAYPAL_USE_SANDBOX":1,
   "K_RECAPTCHA_SECRET_KEY":"6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe",
   "K_RECAPTCHA_SITE_KEY":"6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI",
   "K_GOOGLE_KEY":"ABQIAAAAD7z_FToS5NSqosnG9No1ABQYPrehWcZJH1ec0SZqipYFbK_nfRT1ryCGKzl5KGpFG3y5jyPe_uClVg",
   "K_USE_ALTERNATIVE_MTA":1,
   "K_USE_KC_FINDER":1,
   "K_MASQUERADE_ON":false,
   "K_MIN_PASSWORD_LEN":5,
   "K_ACCESS_LEVEL_UNAUTHENTICATED":0,
   "K_ACCESS_LEVEL_AUTHENTICATED":2,
   "K_ACCESS_LEVEL_AUTHENTICATED_SPECIAL":4,
   "K_ACCESS_LEVEL_ADMIN":7,
   "K_ACCESS_LEVEL_SUPER_ADMIN":10
}
```

Output of the tag `<cms:dump_all/>` displays this variable before the user-defined variables with value *Array*:

`k__defined: Array`

## Usage

Some defined values were previously available only with PHP code, for instance the actual names of database tables – K_TBL_PAGES, K_TBL_TEMPLATES, etc.. The values of these constants depends on defined K_DB_TABLES_PREFIX (in `config.php`), so building an SQL query with tag 'cms:query' previously necessitated a mandatory PHP code echoing the table names. With **k__defined** we can access them directly, as in

```xml
<cms:show k__defined.K_TBL_PAGES />
```

to place in a query –

```xml
<cms:set sql = "<cms:concat p1='SELECT * FROM ' p2=k__defined.K_TBL_TEMPLATES p3=' WHERE ...' />" />
```

Next, constants K_CACHE_OPCODES, K_CACHE_SETTINGS, K_USE_CACHE allow to set up a strategy that takes into account caching status. When cache is enabled, code might switch to using javascript to request values via ajax calls to api.

Code designed to run both in admin-panel and frontend may benefit from different algorythms depending on the value of K_ADMIN.

Hope it becomes clear how useful this variable might be under circumstances.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
