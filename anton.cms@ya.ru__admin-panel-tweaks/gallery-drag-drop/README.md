# Reorderable gallery (drag & drop)

Allows to rearrange images by mouse, greatly simplifies sorting.

Demo —

https://user-images.githubusercontent.com/6024107/175763951-deba632f-7bc8-4377-9c59-0a9e0b3b9a61.mp4

This is my amazing drag-n-drop ajax-powered solution for Couch Gallery templates. It is based on famous [**Dragula.js**](https://github.com/bevacqua/dragula) library.

Easy to install, it additionally fixes a few things for gallery templates —

* If Root doesn't contain images, but contains a Subfolder with images, the will be no weird "Empty" infomessage.
*	Gallery name length changed from 20 to 30
* Screen is no longer dimmed when position is changed by buttons in default regime.

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

In essense —

* Keep this tweak enabled (i.e. `gallery-drag-drop.php`)
* Move folder `theme-gallery-dragndrop` to `couch/theme` directory
* Edit Couch config e.g.

   ```php
   define( 'K_ADMIN_THEME', 'theme-gallery-dragndrop' );
   ```

* Add mandatory configuration `orderby='weight'` to your gallery template e.g.

   ```xml
   <cms:template ... gallery='1'>
      <!-- editable fields here -->

      <cms:config_list_view orderby='weight' />
   </cms:template>
   ```

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.
