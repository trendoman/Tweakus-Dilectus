# [Modded `<cms:gpc>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/gpc)

Mod adds one line to preprocess arrays into JSON-encoded string.

Query string arrays of params, such as multi-select checkboxes will be managed by **gpc** tag and effectively sanitized.

## Example

Declare a simple form to test how things now work –

```xml
<cms:form method='get'>
   <cms:if k_success>
      <cms:abort>
         <h2>Printout of submitted multi-value checkbox:</h2>
         <cms:gpc 'colors' />
      </cms:abort>
   </cms:if>
   <cms:input type='checkbox' name='colors' opt_values='black|white|yellow|blue|red' />
   <cms:input type='hidden' name='p' value=k_page_id />
   <cms:input type='submit' name='go' value='Submit' />
</cms:form>
```

tick some boxes and submit -

```js
Printout of submitted multi-value checkbox:
["white","yellow","blue"]
```

Work with the values as usual (refresh **[Couch Arrays](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)** concept and its **[tags](https://github.com/trendoman/Midware/tree/main/tags-reference/Arrays)** if necessary).

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
