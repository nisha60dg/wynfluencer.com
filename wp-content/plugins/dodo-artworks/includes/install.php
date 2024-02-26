<?php
/**
 * Installs DODO_Artwork.
 *
 * @since 1.0
 */
function dodo_wp_install() {

    if ( ! get_option( 'dodo_is_installed' ) ) {

		// Add Required Pages
        $dodo_pages = dodo_artwork_pages();
		foreach($dodo_pages as $page){
			$dodo_page = get_post( $page['post_name'] );
			// Create the page if it doesn't exist.
			if ( empty( $dodo_page ) ) {
				$pageArray = wp_insert_post( array_merge($page, 
                        array(
                            'post_status'    => 'publish',
                            'post_author'    => get_current_user_id(),
                            'post_type'      => 'page',
                            'comment_status' => 'closed'
                        )
                    )
				);
			}
		}
    }

    flush_rewrite_rules();
    update_option( 'dodo_is_installed', '1' );

}
register_activation_hook( DODO_PLUGIN_FILE, 'dodo_wp_install' );

/**
 * Checks if DODO_Artwork is installed, and if not, runs the installer.
 *
 * @since 1.0
 */
function dodo_check_if_installed() {

	// This is mainly for network-activated installs.
	if( ! get_option( 'dodo_is_installed' ) ) {
		dodo_wp_install();
	}
}
add_action( 'admin_init', 'dodo_check_if_installed' );