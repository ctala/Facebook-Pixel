<div class="wrap">
    <h2>Facebook Pixel ID</h2>
    <p>
        This plugin will add the Facebook Id Code to the head of the wordpress site.
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('fbkPixel-settings-group'); ?>
        <?php do_settings_sections('fbkPixel-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Facebook Pixel ID</th>
                <td><input type="text" name="fbk_pixel_id" value="<?php echo get_option('fbk_pixel_id'); ?>" /></td>

            </tr>
            <tr valign="top">
                <th scope="row">Currency Code</th>
                <td><input type="text" name="fbk_pixel_currency" value="<?php echo get_option('fbk_pixel_currency'); ?>" /></td>

            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>


