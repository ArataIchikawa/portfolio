<?php
/**
 * The sidebar containing the Left sidebar widget area.
 *
 * @package The Monday
 */

?>

<div id="secondary" class="widget-area" role="complementary">
    <?php 
        do_action( 'the_monday_before_sidebar' );
        
        if( is_page_template( 'template-parts/template-contact.php' ) ) {
			$sidebar = 'contact_page_sidebar';
		} else {
			$sidebar = 'left_sidebar';
		}
        
        if ( ! dynamic_sidebar( $sidebar ) ) {  
            if( $sidebar == 'contact_page_sidebar' ) {
                $sidebar_name = __( 'Contact Page', 'the-monday' );
            } else {
                $sidebar_name = __( 'Left', 'the-monday' );
            }
        
            the_widget( 'WP_Widget_Text',
                array(
                   'title'  => __( 'Example Widget', 'the-monday' ),
                   /* translators: %1$s : sidebar name, %2$s : user role, %3$s : widget link */
                   'text'   => sprintf( __( 'This is an example widget to show how the %1$s Sidebar looks by default. You can add custom widgets from the %2$s widgets screen%3$s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'the-monday' ), $sidebar_name, current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
                   'filter' => true,
                ),
                array(
                   'before_widget' => '<aside class="widget widget_text clearfix">',
                   'after_widget'  => '</aside>',
                   'before_title'  => '<h3 class="widget-title"><span>',
                   'after_title'   => '</span></h3>'
                )
             );
         } 
    ?>
    
	<?php do_action( 'the_monday_after_sidebar' ); ?>
</div><!-- #secondary -->
