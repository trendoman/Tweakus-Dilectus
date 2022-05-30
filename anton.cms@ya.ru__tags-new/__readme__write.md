# New tag: `<cms:write>`

Writes data into files.

Discussion &mdash; [forum topic](https://www.couchcms.com/forum/viewtopic.php?f=8&t=11377&p=38001#p30085)

## Example
```html
<cms:test
    ignore='0'
    >
  <cms:write
    file=''
    truncate=''
    add_newline=''
    >Example text</cms:write>
</cms:test>
```

## Usage

All content enclosed within this tag will be written into the file specified as its first parameter.<br>
File is always considered **relative to the site's root**.
```html
<cms:write 'my.txt' >Hello world!</cms:write>
```
The code above will write "Hello world!" into a file named 'my.txt' present in the **site's root** (i.e. the parent folder of 'couch').
If the file is not present, the tag will create it. The created file should now contain the following -
```txt
  Hello world!
```

**NOTE:** If you skip the parameter **file**, tag will use *my_log.txt* as filename.

If newlines are required you can either -
1. Add the newline as part of the data e.g. as follows &mdash;
```html
<cms:write 'my.txt' >
Hello world!
</cms:write>
```
2. Or, set **add_newline** parameter to *1* e.g.as follows &mdash;
```html
<cms:write 'my.txt' add_newline='1'>Hello world!</cms:write>
```

If the specified file already exists, this tag by default appends data to that file's existing contents.<br>
If you wish the tag to discard any existing file and create a new file, set its **truncate** parameter to *1*.
```html
<cms:repeat '3'>
   <cms:write 'my.txt' add_newline='1' truncate='1'>Hello world!</cms:write>
</cms:repeat>
```

## Support

Donations are desperately welcomed to keep up with support requests; to continue receiving your [thankyou's](https://github.com/trendoman/Dignotas) &mdash;

**Bitcoin**: bc1qsl2tulmsjcvpkegepeunmumz599yz0lhuktdjt

Ask any question via forum or email &mdash; <anton.cms@ya.ru>, <tony.smirnov@gmail.com> &mdash; Anton S aka Trendoman<br>
You'll get *a good meaningful* reply within hours.

My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts

New Telegram channel: https://t.me/couchcms

---

```txt
@author Kamran Kashif aka KK <kksidd@couchcms.com>
@date   07.03.2018
```
