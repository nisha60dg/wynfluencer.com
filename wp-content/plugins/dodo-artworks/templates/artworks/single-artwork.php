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
        <div class="artwork-details-container">

            <div class="artwork-thumbnail"><img src="<?=$artwork->thumbnail?>" /></div>

            <div class="artwork-description"><?=$artwork->post_content?></div>

            <?php if(isset($artwork->post_meta->_artwork_price)){?>
				<div class="artworks-price">
					<strong>Price:</strong> <?=$artwork->post_meta->_artwork_price[0]?>
				</div>
			<?php } ?>

			<div class="artworks-status">
				<strong>Gallery:</strong>  twelveartists.berlin
			</div>

			<?php if(isset($artwork->post_meta->_artwork_status)){?>
				<div class="artworks-status">
					<strong>Status:</strong> <?=$artwork->post_meta->_artwork_status[0]?>
				</div>
			<?php } ?>

			<?php 
			if ($artwork->posttags) { ?>
				<div class="artwork-tags">
					<strong>Categories:</strong>				
					<?php foreach($artwork->posttags as $index=>$tag) {
							echo (count($artwork->posttags) == ($index+1) ) ? $tag->name : $tag->name . ', '; 
						}
					?>
				</div>
			<?php } ?>

			<?php if(!empty($_artist_opensea)){ ?>
				<div class="artwork-opensea-link">
					<strong>Opensea:</strong> <?=$_artist_opensea?>
				</div>
			<?php } ?>

			<div class="artwork-twitter-link">
				<strong>Twitter:</strong>
				<ul>
					<li>@friends.of.dodo</li>
					<li>@twelveartists</li>
					<?php if(!empty($_artist_twitter)){ ?>
						<li><?=(strpos($_artist_twitter, "@") > -1 ) ? $_artist_twitter : "@".$_artist_twitter ?></li>
					<?php } ?>
				</ul>
			</div>

			<div class="artwork-insta-link">
				<strong>Instagram:</strong>
				<ul>
					<li>@friends.of.dodo</li>
					<li>@twelveartists</li>
					<?php if(!empty($_artist_instagram)){ ?>
						<li><?=(strpos($_artist_instagram, "@") > -1 ) ? $_artist_instagram : "@".$_artist_instagram ?></li>
					<?php } ?>
				</ul>
			</div>


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