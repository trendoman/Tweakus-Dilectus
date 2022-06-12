# k__template_name_safe

Quickly access a safe name of current template via this new variable.

* #### `k__template_name_safe`
   ```txt
   index.php => index-php
   ```
* #### `k__template_name_safe_ex`
   `index-php => index`, i.e. without extension


> Notation `k__` with double underscore is used to distinguish custom variables from native `k_` variables.<br>
> Name starts with `k__` because such variables can not be overridden accidentally with tags `<cms:set>`, `<cms:put>`.

## Example

Output of the tag `<cms:dump_all/>` displays these variables before the user-defined variables.

### dump
```html
<cms:test
    ignore='0'
    >
  <cms:dump_all />
</cms:test>
```
### result

![safe-name](img/k__template_name_safe.png)

## Usage

If you are interested in one of the values print it with `<cms:show>` &mdash;
```html
<cms:show k__template_name_safe />
```
As a tag's param &mdash;
```html
param = k__template_name_safe
```


## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
