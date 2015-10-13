<?php
$helper = new HelperPixel();
?>


<h1>Facebook Pixel Settings</h1>
<hr>
<div class="wrap">
    <h2>Conversion Pixel ID</h2>
    <p>
        This plugin will add the Facebook Id Code to the head of the wordpress site.
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('fbkPixel-settings-group'); ?>
        <?php do_settings_sections('fbkPixel-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Custom Pixel ID</th>
                <td><input type="text" name="fbk_pixel_id" value="<?php echo get_option('fbk_pixel_id'); ?>" /></td>

            </tr>
            <tr valign="top">
                <th scope="row">Currency Code</th>
                <td><?php echo $helper->getSelect("fbk_pixel_currency", "fbk_pixel_currency", get_option('fbk_pixel_currency')); ?></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>

<hr>

<div class="wrap">
    <h2>Custom Audience Pixel ID</h2>
    <p>
        Custom Audiences from your Website allows you to target your Facebook ads to audiences of people who have visited your website and remarket to people who have expressed interest in your products.
    </p>
    <form method="post" action="options.php">
        <?php settings_fields('fbkPixel-custom-settings-group'); ?>
        <?php do_settings_sections('fbkPixel-custom-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Custome Audience ID</th>
                <td><input type="text" name="fbk_pixel_custom_id" value="<?php echo get_option('fbk_pixel_custom_id'); ?>" /></td>

            </tr>
            <tr valign="top">
                <th scope="row">Audience Opcions</th>
                <td>
                    <?php
                    echo $helper->getOptionsForm("fbk_pixel_custom_option_");
                    ?></td>

            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>


