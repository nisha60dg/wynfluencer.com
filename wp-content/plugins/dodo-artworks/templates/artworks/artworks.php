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
        <div class="artist-artwork-wrapper">
            <?php if(!empty($artworks)){ ?>
                <div class="artist-artwork-gallery">				
					<?php foreach($artworks as $index=>$artwork){ ?>
						<div class="artworks-item">
							<div class="artwork-thumbnail">
								<a href="<?=home_url().'/artworks/'.$artwork->post_name?>" class="gallery-item" title="<?=(isset($artwork->post_meta->_artwork_title)) ? $artwork->post_meta->_artwork_title[0] : ''?>">
									<img src="<?=$artwork->thumbnail?>" class="artist-artwork-img" alt="<?=(isset($artwork->post_meta->_artwork_title)) ? $artwork->post_meta->_artwork_title[0] : ''?>" />
								</a>
							</div>
						</div>
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