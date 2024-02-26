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
        <div class="show-container">
            <div class="col-md-3">
                <?php if(isset($currentOpening->show->thumbnail) && !empty($currentOpening->show->thumbnail)): ?>
                    <div class="thumbnail-container">
                        <img src="<?=$currentOpening->show->thumbnail?>" class="thumbnail" />
                    </div>
                <?php else: ?>
                    <div class="show-title"><div class="txt"><?=$currentOpening->show->name?></div></div>
                <?php endif; ?>
            </div>
            <div class="col-md-9">
                <?php foreach($showOpenings as $opening){ ?>
                    <div class="opening-item">     
                        <div class="opening-item-title"><?=$opening->post_title?></div>
						<p class="artist-counter"><?=$opening->artistsCount?> Artists</p>					
                    </div>
                <?php } ?>
            </div>
        </div>
		
        <h1 class="current-opening-heading"><?=$currentOpening->post_title?></h1>
        
        <?php if(isset($currentOpening->openingWindows) && !empty($currentOpening->openingWindows)){ ?>
            <div class="opening-windows-container">
                <?php foreach($currentOpening->openingWindows as $counter=>$window){ ?>
                    <?php $artist_artwork_link = home_url().'/openings/'.$currentOpening->post_name.'/artists/'.$window->artist->post_name; ?>
                    <div class="opening-gallery">
                        <a class="windowThumbnail" href="<?=$artist_artwork_link?>">
                            <img src="<?=$window->window_image?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
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