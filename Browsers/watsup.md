$watsup = get_field('watsup', 'option');
$watsup_clear = clear_phone($watsup);
<a target="_blank" href="https://wa.me/+<?php echo $watsup_clear; ?>"><?php echo $watsup; ?></a>
