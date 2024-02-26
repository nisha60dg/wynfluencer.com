<?php
/**
 * 
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
                <?php if(isset($show->thumbnail) && !empty($show->thumbnail)): ?>
                    <div class="thumbnail-container">
                        <img src="<?=$show->thumbnail?>" class="thumbnail" />
                    </div>
                <?php else: ?>
                    <div class="show-title"><div class="txt"><?=$show->name?></div></div>
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

        <div class="show-opening-list">
            <?php foreach ($showOpenings as $index=>$opening ){ ?>                
                <p class="mg-0"><a href="<?=home_url().'/openings/'.$opening->post_name?>"><?php echo $opening->post_title ?></a></p>
            <?php } ?>
        </div>

        <?php if(!empty($showArtists)){ ?>
            <div class="show-artists-container">
                <h2>Participating Artists</h2>
                <?php foreach($showArtists as $artist){ ?>
                    <div class="artist-item text-center">
                        <p><a href="<?=home_url().'/artists/'.$artist->post_name;?>"><?=$artist->post_title?></a></p>
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