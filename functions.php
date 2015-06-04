<?php

// Recommended plugins installer
require_once 'include/plugins/init.php';

// Shortcodes functions
require_once 'include/shortcodes.php';

// Custom functionality
require_once 'include/core.php';

//# Uncomit for add custom post type
// require_once('include/custom-cpt.php');
//# Register custom image size
// add_image_size( 'custom', '300', '300', true );
update_option('thumbnail_size_w', 200);
update_option('thumbnail_size_h', 200);
// update_option('medium_size_w', 400);
// update_option('medium_size_h', 350);
// update_option('large_size_w', 800);
// update_option('large_size_h', 400);


