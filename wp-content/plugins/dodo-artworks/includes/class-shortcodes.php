<?php
/**
 * Manage Shortcodes
 * 
 */
class DODO_Artwork_Shortcodes {

    /**
     * Define Shortcodes on class init
     * 
     * 
     */
	public function __construct() {
		add_shortcode( 'dodo_shows',           array( $this, 'render_dodo_shows') );
		add_shortcode( 'dodo_artists',           array( $this, 'render_dodo_artists') );
		// add_shortcode( 'dodo_openings',           array( $this, 'render_dodo_openings') );
		add_shortcode( 'dodo_artworks',           array( $this, 'render_dodo_artworks') );

	}

    /**
     * Render the shows from dodo to the website
     * 
     * 
     */
    public function render_dodo_shows(){
        if( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			return;
		}

        $shows = $errors = '';
        $response = dodoartworks()->RESTAPI->shows->getShows();
        if(isset($response->data)){
            $shows = $response->data;
        }else{
            $errors = $response->errors;
        }

        ob_start();
        if(file_exists(DODO_STYLESHEET_DIR.'dodo-artworks/shows/shows.php')){
            include DODO_STYLESHEET_DIR.'dodo-artworks/shows/shows.php';
        }else{
            include DODO_ARTWORKS_DIR.'templates/shows/shows.php';
        }

        return ob_get_clean();
    }

    /**
     * Render the artists from dodo to the website
     * 
     * 
     */
    public function render_dodo_artists(){
        if( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			return;
		}

        $artists = $errors = '';
        $response = dodoartworks()->RESTAPI->artists->getArtists();
        if(isset($response->data)){
            $artists = $response->data;
        }else{
            $errors = $response->errors;
        }

        ob_start();
        if(file_exists(DODO_STYLESHEET_DIR.'dodo-artworks/artists/artists.php')){
            include DODO_STYLESHEET_DIR.'dodo-artworks/artists/artists.php';
        }else{
            include DODO_ARTWORKS_DIR.'templates/artists/artists.php';
        }

        return ob_get_clean();
    }

    /**
     * Render the shows from dodo to the website
     * 
     * 
     */
    public function render_dodo_openings(){
        if( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			return;
		}

        $openings = $errors = '';
        $response = dodoartworks()->RESTAPI->openings->getOpenings();
        if(isset($response->data)){
            $openings = $response->data;
        }else{
            $errors = $response->errors;
        }

        ob_start();
        if(file_exists(DODO_STYLESHEET_DIR.'dodo-artworks/openings/openings.php')){
            include DODO_STYLESHEET_DIR.'dodo-artworks/openings/openings.php';
        }else{
            include DODO_ARTWORKS_DIR.'templates/openings/openings.php';
        }

        return ob_get_clean();
    }

    /**
     * Render the artworks from dodo to the website
     * 
     * 
     */
    public function render_dodo_artworks(){
        if( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			return;
		}

        $artworks = $errors = '';
        $response = dodoartworks()->RESTAPI->artworks->getArtworks();
        if(isset($response->data)){
            $artworks = $response->data;
        }else{
            $errors = $response->errors;
        }

        ob_start();
        if(file_exists(DODO_STYLESHEET_DIR.'dodo-artworks/artworks/artworks.php')){
            include DODO_STYLESHEET_DIR.'dodo-artworks/artworks/artworks.php';
        }else{
            include DODO_ARTWORKS_DIR.'templates/artworks/artworks.php';
        }

        return ob_get_clean();
    }
}
new DODO_Artwork_Shortcodes;