# `<cms:write>`

Writes data into files.

```xml
<cms:write file='greeting.html'>Hi Anton!</cms:write>
```

## Parameters

* file
* truncate
* add_newline

## Example

```xml
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

All content enclosed within this tag will be written into the file specified as its first parameter. File is always considered **relative to the site's root**.

```xml
<cms:write 'my.txt' >Hello world!</cms:write>
```

The code above will write "Hello world!" into a file named 'my.txt' present in the **site's root** (i.e. the parent folder of 'couch'). If the file is not present, the tag will create it.

The created file should now contain the following -

```
Hello world!
```

If you skip the parameter **file**, tag will use *my_log.txt* as filename.

```xml
<cms:write><cms:date /></cms:write>
```

If newlines are required you can either -

a. Add the newline as part of the data –

```xml
<cms:write 'my.txt' >
Hello world!
</cms:write>
```

or b. set **add_newline** parameter to *1* –

```xml
<cms:write 'my.txt' add_newline='1'>Hello world!</cms:write>
```

If the specified file already exists, this tag by default appends data to that file's existing contents. If you wish the tag to discard any existing file and create a new file, set its **truncate** parameter to *1* –

```xml
<cms:repeat '3'>
   <cms:write 'my.txt' add_newline='1' truncate='1'><cms:zebra 'a' 'b' 'c' /></cms:write>
</cms:repeat>
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
