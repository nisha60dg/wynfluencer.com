<?php
/**
 * Shows Listing Page
 * 
 * 
 */

get_header();
?>

<div class="container">
    <?php if(!empty($artists)){ ?>			
        <div class="artists-wrapper">
            <?php foreach($artists as $artist){ ?>			
                <div class="artists-item">
                    <div class="post-title">
                        <h4><?=$artist->post_title?></h4>
                        <a class="artist_link" href="<?=home_url().'/artists/'.$artist->post_name?>">
                            <span>more</span> 
                            <svg data-bbox="20 86 160 28" viewBox="0 0 200 200" height="200" width="200" xmlns="http://www.w3.org/2000/svg" data-type="shape">
                                <g><path d="M164.965 114L180 100l-15.035-14-2.8 2.941 9.275 8.636H20v4.846h151.44l-9.275 8.636 2.8 2.941z"></path></g>
                            </svg>
                        </a>
                    </div>
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