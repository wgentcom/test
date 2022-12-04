<?php
if ( !is_admin() ) {
 wp_enqueue_script( 'test-script', get_template_directory_uri() . '/assets/js/vote.js', array(), true );
 wp_enqueue_style( 'test-style', get_stylesheet_directory_uri() . '/style.css' ); 
}
else{
 wp_enqueue_script( 'test-script', get_template_directory_uri() . '/assets/js/admin.js?t='.time(), array(), true );
 wp_enqueue_style( 'test-style', get_stylesheet_directory_uri() . '/admin.css?t='.time() ); 
}
function q($s){return htmlspecialchars($s, ENT_COMPAT);}
?>