<?php 
add_action('activated_plugin','save_error');
function save_error(){
    update_option('plugin_error',  ob_get_contents());
}
echo get_option('plugin_error')

?>
