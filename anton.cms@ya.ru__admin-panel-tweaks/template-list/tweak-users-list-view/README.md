## Extended Users display

Extended Users addon makes that the same user accounts appear at two different places - Administration section and Extended Users template. Tweak allows to display Admin/Superadmin users only in Administration section and Regular Users only in EU template.

> And now when you visit the core users section you'll find that it shows only the admin/super-admin/special accounts (i.e. skips all lowest level accounts that are created from the front-end using the extended template).

> If for (perhaps debugging) you'd want to see all accounts listed here, add a `&debug=1` to the URL in admin panel and that would remove this filter temporarily.

So now, the accounts are neatly segregated in two places -
1. All admin level accounts are in core
2. All lower level accounts (usually created from front-end) are in the extended users template.


## Equalize form-views

> Coming to the second issue (different field layouts), we can normalize that by using `<cms:config_form_view>` in your **extended** template.

```html
<!--
    config form GUI
-->
<cms:config_form_view>
    <cms:persist
        k_publish_date="
            <cms:if frm_my_disabled='1'>
                0000-00-00 00:00:00
            <cms:else/>
                <cms:if k_cur_form_mode='edit' && k_page_date!='0000-00-00 00:00:00'>
                    <cms:show k_page_date />
                <cms:else />
                    <cms:date format='Y-m-d H:i:s' />
                </cms:if>
            </cms:if>"
        _auto_title='1'
    />

    <cms:style>
        #settings-panel{display: none; }
    </cms:style>
    <cms:field 'extended_user_id' hide='1' />

    <cms:field 'k_page_name' label="<cms:localize 'user_name' />" desc="<cms:localize 'user_name_restrictions' />" order='-7' />
    <cms:field 'k_page_title' label="<cms:localize 'display_name' />" order='-6' />
    <cms:field 'extended_user_email' label="<cms:localize 'email' />" group='_system_fields_' order='-5' />
    <cms:field 'my_disabled' label="<cms:localize 'disabled' />" group='_system_fields_' order='-4'>
        <cms:input
            type='singlecheck'
            id=k_field_input_id
            name=k_field_input_name
            field_label="<cms:localize 'disabled' />"
            value="<cms:if k_page_date='0000-00-00 00:00:00'>1<cms:else />0</cms:if>"
        />
    </cms:field>
    <cms:field 'extended_user_password' label="<cms:localize 'new_password' />" desc="<cms:localize 'new_password_msg' />" group='_system_fields_' order='-3' />
    <cms:field 'extended_user_password_repeat' label="<cms:localize 'repeat_password' />" desc="<cms:localize 'repeat_password_msg' />" group='_system_fields_' order='-2' />
</cms:config_form_view>
```


## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
