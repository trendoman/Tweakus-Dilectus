## Fix Repeatable Region's issues

Tweak consists of several changes to the `couch/addons/repeatable/tablegear/tablegear.js` file.

1. Can override default `empty` message. It even overrides the message set by /couch/lang/EN.php file
2. Removed Alert. If Admin wants to delete multiple rows, Alert pops up on each action. Alert doesn't make much sense, because data is NOT deleted before PAGE SAVE. Page can be reloaded without saving to restore visibility of 'deleted' rows.
3. Disabled second empty row.
4. Prevented a DOM jump when empty row appears. When table is empty, plugin tableGear adds an 'empty' row with 'empty' message on event `DOM ready`, which causes jump. If plugin is tricked to think that an empty row already was attached, then there is no jump.

There was another tweak that allowed to disable a default empty row, but thanks to @KK it was fixed in the subsequent CouchCMS version. Now it is possible to add a parameter &mdash;

```xml
<cms:repeatable ... no_default_row = '1'>
```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

## A letter from CouchCMS Original Developer to PHP enthusiasts

> Unlike most other editable regions, RR does not lend its render routine to overriding.
Also, the fact that `<cms:repeatable>` tag internally calls a a hidden editable region named '__repeatable' also complicates things a little.<br>
> As you can see, we have defined our own class `'MyRepeatable'` that extends the core `'Repeatable'` class. We are only interested in the `_render()` function - in the code above the function is simply calling the original core routine of its parent so should work exactly the same as before.<br>
You can instead, now copy/paste here the original code and tweak it to your liking.

```php
$FUNCS->add_event_listener( 'init', function(){
    global $FUNCS;
    $FUNCS->udfs['__repeatable']['handler']='MyRepeatable';
});

class MyRepeatable extends Repeatable{
    function _render( $input_name, $input_id, $extra='', $dynamic_insertion=0 ){
        global $FUNCS, $CTX, $AUTH;

        $html = parent::_render( $input_name, $input_id, $extra='', $dynamic_insertion );

        return $html;
    }
}
```
