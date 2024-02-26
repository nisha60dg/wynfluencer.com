<?php
/**
 * Shows Listing Page
 * 
 * 
 */

defined( 'ABSPATH' ) || exit;

do_action( 'dodo_before_shows_loop_start' );
?>
<div class="container">
    <?php if(!empty($shows)){ ?>
        
        <?php if(isset($shows->ongoing) && !empty($shows->ongoing)){ ?> 
            <h2 class="page-sub-heading">Ongoing Shows</h2>
            <?php foreach($shows->ongoing as $show){ ?>
                <div class="show-container">
                    
                        <div class="col-md-3">
                            <?php if(isset($show->thumbnail) && !empty($show->thumbnail)): ?>
                                <div class="thumbnail-container">
								<a href="<?=home_url().'/shows/'.$show->slug?>" class="show-link">
                                    <img src="<?=$show->thumbnail?>" class="thumbnail" />
                                </div>
								</a>
                            <?php else: ?>
								
								<div class="show-title">
									<a href="<?=home_url().'/shows/'.$show->slug?>" class="show-link txt">
										<?=$show->name?>
									</a>
								</div>
								
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <?php foreach($show->showOpenings as $opening){ ?>
                                <div class="opening-item">    
                                    <div class="opening-item-title"><?=$opening->post_title?></div>
                                    <p class="artist-counter"><?=$opening->artistsCount?> Artists</p>
                                </div>
                            <?php } ?>
                        </div>
                    
                </div>
            <?php } ?>
        <?php } ?>    

        <?php if(isset($shows->upcoming) && !empty($shows->upcoming)){ ?>
            <h2 class="page-sub-heading">Upcoming Shows</h2>
            <?php foreach($shows->upcoming as $show){ ?>
                <div class="show-container">
                    <div class="col-md-3">
                        <?php if(isset($show->thumbnail) && !empty($show->thumbnail)): ?> 
                            <div class="thumbnail-container">
                                <img src="<?=$show->thumbnail?>" class="thumbnail" />
                            </div>
                        <?php else: ?>
                            <div class="show-title"><?=$show->name?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9">
                    <?php foreach($show->showOpenings as $opening){ ?>
                        <div class="opening-item">    
                            <div class="opening-item-title"><?=$opening->post_title?></div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?> 

    <?php } ?>


</div>
<?php 
do_action( 'dodo_before_shows_loop_start' );