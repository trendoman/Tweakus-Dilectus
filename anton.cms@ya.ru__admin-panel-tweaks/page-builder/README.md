## PageBuilder Boilerplate code

This is a mandatory code for PageBuilder addon.

I only do not wish to clutter my `couch/addons/kfunctions.php` file! That's why code comes separately.

Instructions from [Documentation on CouchCMS's PageBuilder](https://www.couchcms.com/forum/viewtopic.php?f=5&t=13148), quoted verbatim -

` ~~~~~~~~~~~~ quote ~~~~~~~~~~~~~~`

OK, with that understood, let us finally associate the markups with the blocks.

This step involves just a wee bit of PHP but let that not disconcert you if you are not comfortable with the language.

It is boiler-plate code that you can just copy and paste into the indicated file.

Please open couch/addons/kfunctions.php in your text editor and paste the following code within it -

> code is placed here - `tweak-pb-render.php`

You can absolutely move ahead without knowing a thing about what the code above does but I think it wouldn't be a bad idea to have at least a passing understanding of what is happening above.

You see, when pagebuilder tries to render a block it broadcasts a message (an 'event' actually) asking other modules to let it know two things -
1. the name of the file containing the markup it is supposed to display and
2. the location where it can find that file.

Also, if you recall the discussion about IFRAME we had above, it does this twice - once for the wrapper and then for the block itself.

The code we used above answers its queries for both the items using the
```php
$FUNCS->override_render( 'pb_wrapper'
```
and
```php
$FUNCS->override_render( 'pb_tile'
```
statements.

Notice specifically the value for the 'template_path' we are providing in both the statements -

For 'pb_tile' it is 'snippets/pb/' within the couch folder while for 'pb_wrapper' it is more specifically 'snippets/pb/misc/theme/' folder in the same location.

If you recall the folder structure we created in the beginning for placing snippets, the two paths above point to locations within the same tree -
```txt
snippets
    |_pb
        |_about
            |_embed
            |_theme
        |_covers
            |_embed
            |_theme
        |_misc
            |_embed
            |_theme
```

OK, so that tells pagebuilder where we put the files containing the markup.

Now for the remaining question - what is the name of the file?

For wrapper, because we only have a single one, we'll go with the default name pagebuilder searches for - that is 'pb_wrapper'.

Copy the code for the wrapper we extracted above in a file named 'pb_wrapper.html' and place it within 'couch/snippets/pb/misc/theme/'.

For blocks (tiles), the name would depend on which block is being rendered (as each block will have its own specific markup) so in the
```php
$FUNCS->override_render( 'pb_tile'
```
statement we specify a function ('_render_pb_tile') that pagebuilder should consult to get the file name.

Code for that function simply passes back whatever we set as the '_pb_template' param in our `<cms:tile>` definition e.g.
```html
<cms:tile name='cr01' label='CR01' _pb_template='covers/theme/CR01' _pb_height='350'>
```

`~~~~~~~~~~~~ end quote ~~~~~~~~~~`

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

