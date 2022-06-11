# `<cms:write>`

Writes data into files. Discussion &mdash; [forum topic](https://www.couchcms.com/forum/viewtopic.php?f=8&t=11377&p=38001#p30085)

## Parameters
* file
* truncate
* add_newline

## Example
```html
<cms:test
   ignore='0'
   >
   <cms:write file='example.html'
      truncate='1'
      add_newline='0'
      ><h1>Title</h1>Example text
   </cms:write>
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
* Add the newline as part of the data e.g. as follows &mdash;
   ```html
   <cms:write 'my.txt' >
   Hello world!
   </cms:write>
   ```
* Or, set **add_newline** parameter to *1* e.g.as follows &mdash;
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

See dedicated [**SUPPORT**](/SUPPORT.md) page.
