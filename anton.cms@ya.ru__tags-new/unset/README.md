# unset

Tag **cms:unset** deletes a variable. It's the opposite of tags [**put, set**](#related-tags). It has ability to remove keys from [**Couch arrays**](#related-pages).

```xml
<cms:unset 'my_var' />
```

## Parameters

* ***unnamed***
* **scope**

### *unnamed*

One or more variables, separated by a comma, enclosed with single or double quotes. Can have nested Couch tags, if they output name(s) to unset.

```xml
<cms:unset "k_user_title, <cms:concat p1='k_user_' p2='email' />" />
```

### scope

Takes a single possible value ***global***. If not set, the ***parent*** is assumed.

## Example

This little snippet illustates removal of a key *Russia.Sochi* from array ***climate*** —

```xml
<cms:capture into='climate' is_json='1'>
{"Russia":{"Moscow":"cold","Sochi":"warm"}}
</cms:capture >
<cms:show climate as_json='1' /><br>
<cms:unset 'climate.Russia.Sochi' />
<cms:show climate as_json='1' />
```

```json
{"Russia":{"Moscow":"cold","Sochi":"warm"}}
{"Russia":{"Moscow":"cold"}}
```

## Related tags

* **show**
* **put**
* **set**

## Related pages

* [**Midware Core Concepts &raquo; Couch Arrays**](https://github.com/trendoman/Midware/tree/main/concepts/Arrays)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
