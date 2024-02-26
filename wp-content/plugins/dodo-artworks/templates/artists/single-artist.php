<?php
/**
 * Shows Listing Page
 * 
 * 
 */

get_header();
?>
<div class="container">
    <?php if(!empty($errors)){ ?>

    <?php }else{ ?>
        <div class="artist-container">
            <h1 class="heading"><?=$artist->post_title?></h1>
            <?php if(isset($artist->thumbnail) && !empty($artist->thumbnail)): ?>
                <div class="artist-thumbnail"><img src="<?=$artist->thumbnail?>" /></div>
            <?php endif; ?>

            <div class="artist-description"><?=$artist->post_content?></div>
        </div>

        <?php if(!empty($artistShows)){ ?>
            <div class="artist-show-container">
                <h2>Shows</h2>
                <div class="artist-shows-list">
                    <?php foreach($artistShows as $show){ ?> 
                        <div class="artist-shows-item">
                            <div class="show-title">		  
                                <a href="<?=home_url().'/shows/'.$show->slug?>"><?=$show->name?></a> 
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
	    <?php } ?>

        <div class="artist-artwork-wrapper">
            <?php if(!empty($artistArtworks)){ ?>
				<h2>Artworks</h2>
                <div class="artist-artwork-gallery">				
					<?php foreach($artistArtworks as $index=>$artwork){ ?>
						<a href="<?=home_url().'/artworks/'.$artwork->post_name?>" class="gallery-item" title="<?=(isset($artwork->post_meta->_artwork_title)) ? $artwork->post_meta->_artwork_title[0] : ''?>">
                            <img src="<?=$artwork->thumbnail?>" class="artist-artwork-img" alt="<?=(isset($artwork->post_meta->_artwork_title)) ? $artwork->post_meta->_artwork_title[0] : ''?>" />
						</a>
					<?php } ?>
				</div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<?php 
/**
 * 
 * 
 * 
 */
get_footer(); 

?>