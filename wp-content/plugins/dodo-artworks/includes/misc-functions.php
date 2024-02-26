<?php
/**
 * print array or object values
 * 
 * 
 */
function pr($ArrayObject, $die = false){
    echo '<pre>'; print_r($ArrayObject); echo '<pre>';

    if($die == true)
        die;
}

function dodo_artwork_pages(){
    return [
        ['post_title'   =>  "Shows", "post_name" => "shows", "post_content"   =>  "[dodo_shows]"],
        ['post_title'   =>  "Artists", "post_name" => "artists", "post_content"   =>  "[dodo_artists]"],
        // ['post_title'   =>  "Openings", "post_name" => "openings", "post_content"   =>  "[dodo_openings]"],
        ['post_title'   =>  "Artworks", "post_name" => "artworks", "post_content"   =>  "[dodo_artworks]"],
    ];
}