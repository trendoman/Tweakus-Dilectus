# [Modded `<cms:is_ajax>`](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms%40ya.ru__tags-modded/is_ajax)

Adds a new parameter **local_only**.

```xml
<cms:is_ajax local_only='1'>
   ..processing code
</cms:is_ajax>
```

Parameter with value *1* checks if server's address is different from requester's address. If so, ajax calls from the other website will not be handled by the 'processing code' enclosed by **cms:is_ajax**.

Default value is *0* i.e. treat all requests equally.

## Example

Deny incoming ajax calls from other websites, but pass through local calls —

```xml
<cms:if "<cms:is_ajax />">
   <cms:content_type 'application/json' />
   <cms:if "<cms:is_ajax local_only='1' />">
      <cms:abort>{ "status" : "ok" }</cms:abort>
   </cms:if>
   <cms:abort is_404='0' msg='{"status":"denied"}' />
</cms:if>
```

Redirect request to page '404' –

```xml
<cms:if "<cms:is_ajax />">
   <cms:if "<cms:is_ajax local_only='1' />">
      <cms:abort>
         ..processing code
      </cms:abort>
   </cms:if>
   <cms:abort is_404='1' msg='Not available' />
</cms:if>
```

Simply serve the normal page to outsiders without restrictions –

```xml
<cms:if "<cms:is_ajax local_only='1' />">
   <cms:abort>
      ..processing code
   </cms:abort>
</cms:if>
<!-- outsiders, including non-local ajax-visitors, will be served as usual -->
```

## Related tags

* [**Midware Tags Reference &raquo; is_ajax**](https://github.com/trendoman/Midware/tree/main/tags-reference/is_ajax.md)
* [**Midware Tags Reference &raquo; content_type**](https://github.com/trendoman/Midware/tree/main/tags-reference/content_type.md)
* [**Midware Tags Reference &raquo; abort**](https://github.com/trendoman/Midware/tree/main/tags-reference/abort.md)

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
