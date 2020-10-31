<h1>Sunset Theme Support</h1>
<?php settings_errors(); ?>


<div class="sunset-container">
    

</div>

<form method="post" action="options.php" class="sunset-general-form">
    <?php settings_fields('sunset-theme-support'); ?>
    <?php do_settings_sections('raza_sunset_theme') ?>
    <?php submit_button(); ?>
</form>

</div>


