<?php
/**
 * Manage Custom URL Rewrite Rules
 * 
 * 
 */
function dodo_artwork_custom_urls() {
    add_rewrite_rule( 'shows/([a-z0-9-]+)[/]?$', 'index.php?shows=$matches[1]', 'top' );
    add_rewrite_rule( 'openings/([a-z0-9-]+)[/]?$', 'index.php?openings=$matches[1]', 'top' );
    add_rewrite_rule( 'openings/([-a-zA-Z0-9]+)/artists/([-a-zA-Z0-9]+)$','index.php?openings=$matches[1]&artists=$matches[2]','top' );
    add_rewrite_rule( 'artists/([a-z0-9-]+)[/]?$', 'index.php?artists=$matches[1]', 'top' );
    add_rewrite_rule( 'artworks/([a-z0-9-]+)[/]?$', 'index.php?artworks=$matches[1]', 'top' );
}
 
add_action( 'init', 'dodo_artwork_custom_urls' );

/**
 * 
 * 
 * 
 */
add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'shows';
    $query_vars[] = 'openings';
    $query_vars[] = 'artists';
    $query_vars[] = 'artworks';
    return $query_vars;
} );

add_action('parse_request', 'parse_requests', 0);
function parse_requests() {
    global $wp, $wp_query;
    
    if(isset($wp->query_vars['shows'])) {

        $show = $showOpenings = $showArtists = $errors = '';
        $response = dodoartworks()->RESTAPI->shows->getShow($wp->query_vars['shows']);
        if(isset($response->data)){
            $show = $response->data;
            if(!empty($show)){
                $openingsResponse = dodoartworks()->RESTAPI->openings->getOpenings(['show'=>$show->slug]);
                if(isset($openingsResponse->data)){
                    $showOpenings = $openingsResponse->data;
                }
                $artistsResponse = dodoartworks()->RESTAPI->artists->getArtists(['show'=>$show->slug]);
                if(isset($artistsResponse->data)){
                    $showArtists = $artistsResponse->data;
                }
            }
        }else{
            $errors = $response->errors;
        }

        if(file_exists(get_stylesheet_directory().'/dodo-artworks/single-show.php')){
            include_once get_stylesheet_directory().'/dodo-artworks/single-show.php';
        }else{
            include_once DODO_ARTWORKS_DIR . '/templates/shows/single-show.php';
        }
        exit();

    }else if(isset($wp->query_vars['artists'])) {
        // find the artists post
        $artist = $artistShows = $opening = $artistArtworks = $errors = '';
        $response = dodoartworks()->RESTAPI->artists->getArtist($wp->query_vars['artists']);
        if(isset($response->data)){
            $artist = $response->data;
            $showsResponse = dodoartworks()->RESTAPI->shows->getShows(['artist'=>$artist->ID] );
            if(isset($showsResponse->data)){
                $artistShows = $showsResponse->data;
            }

            if(isset($wp->query_vars['openings'])){
                $openingResponse = dodoartworks()->RESTAPI->openings->getOpening($wp->query_vars['openings']);
                if(isset($openingResponse->data)){
                    $opening = $openingResponse->data;
                    $artworkResponse = dodoartworks()->RESTAPI->artworks->getArtworks(['opening'=>$opening->ID, 'artist'=> $artist->ID]);
                    if(isset($artworkResponse->data)){
                        $artistArtworks = $artworkResponse->data;
                    }
                }
            }
        }else{
            $errors = $response->errors;
        }
        

        if(file_exists(get_stylesheet_directory().'/dodo-artworks/artists/single-artist.php')){
            include_once get_stylesheet_directory().'/dodo-artworks/artists/single-artist.php';
        }else{
            include_once DODO_ARTWORKS_DIR . '/templates/artists/single-artist.php';
        }
        exit;
    }else if(isset($wp->query_vars['openings']) ) {
        
        $currentOpening = $showOpenings = $openingErrors = $errors = '';
        $response = dodoartworks()->RESTAPI->openings->getOpening($wp->query_vars['openings']);
        // pr($response, true);
        if(isset($response->data)){
            $currentOpening = $response->data;
            $openingsResponse = dodoartworks()->RESTAPI->openings->getOpenings(['show'=>$currentOpening->show->slug]);
            if(isset($openingsResponse->data)){
                $showOpenings = $openingsResponse->data;
            }else{
                $openingErrors = $openingsResponse->errors;
            }
        }else{
            $errors = $response->errors;
        }
        if(file_exists(get_stylesheet_directory().'/dodo-artworks/openings/single-opening.php')){
            include_once get_stylesheet_directory().'/dodo-artworks/openings/single-opening.php';
        }else{
            include_once DODO_ARTWORKS_DIR . '/templates/openings/single-opening.php';
        }
        exit;
    }else if(isset($wp->query_vars['artworks']) ) {
        
        $artwork = $errors = '';
        $response = dodoartworks()->RESTAPI->artworks->getArtwork($wp->query_vars['artworks']);
        if(isset($response->data)){
            $artwork = $response->data;
            if(isset($artwork->artist) && !empty($artwork->artist)){
                $_artist_opensea = $artwork->artist->post_meta->_artist_opensea[0];
                $_artist_twitter = $artwork->artist->post_meta->_artist_twitter_username[0];
                $_artist_instagram = $artwork->artist->post_meta->_artist_instagram_username[0];
            }
        }else{
            $errors = $response->errors;
        }
        if(file_exists(get_stylesheet_directory().'/dodo-artworks/artworks/single-artwork.php')){
            include_once get_stylesheet_directory().'/dodo-artworks/artworks/single-artwork.php';
        }else{
            include_once DODO_ARTWORKS_DIR . '/templates/artworks/single-artwork.php';
        }
        exit;
    }
}