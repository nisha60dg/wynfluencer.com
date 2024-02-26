<?php
/*
Template Name: Affiliate Application
*/
?>

<?php
$errorMessage = '';

if(isset($_POST['submitted'])) {
	$_POST['affiliate_status'] = 'new';
	$_POST['request_type'] = 'api_call';	
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$pronouns = trim($_POST['pronouns']);
	$instagram = trim($_POST['instagram']);
	$twitter = trim($_POST['twitter']);
	$twitch = trim($_POST['twitch']);
	$discord = trim($_POST['discord']);
	$youtube = trim($_POST['youtube']);
	$followers_count = trim($_POST['followers_count']);	
	$ta_follower_per = trim($_POST['ta_follower_per']);
	$engagement_rate = trim($_POST['engagement_rate']);
	$ta_income_limit = trim($_POST['ta_income_limit']);
	$ta_hold_nft = trim($_POST['ta_hold_nft']);
	$about_passion = trim($_POST['about_passion']);
	$about_followers = trim($_POST['about_followers']);
	$about_books = trim($_POST['about_books']);
	$about_collaboration = trim($_POST['about_collaboration']);
	$nft_limit_per_show = trim($_POST['nft_limit_per_show']);
	$affiliate_status = trim($_POST['affiliate_status']);

	if(!isset($hasError)) {
		
		//	echo '<pre>'; print_r($_POST); 
		$cURLConnection = curl_init('https://the-flourishing.com/api/affiliates');
		curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$apiResponse = curl_exec($cURLConnection);
		//print_r($apiResponse);
		curl_close($cURLConnection);

		// $apiResponse - available data from the API request
		$jsonArrayResponse = json_decode($apiResponse);
	//	echo '<pre>'; print_r($jsonArrayResponse); die('end');
		
		if($jsonArrayResponse->status  == 200){

			$emails = ['uday.jbbn@gmail.com', 'stefan@twelveartists.berlin', 'tahmid@wynfluencer.com'];
			$emailTo = implode(',', $emails);
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('uday.jbbn@gmail.com');
			}
			$subject = 'New Affiliate Application Request' ;
			$body = "First Name: $first_name \n\nLast Name: $last_name \n\nPronouns: $pronouns \n\nEmail: $email \n\nInstagram: $instagram \n\nTwitter: $twitter \n\nTwitch: $twitch \n\nDiscord: $discord \n\nYoutube: $youtube \n\nFollowers Count: $followers_count \n\nIn relation to our target audience, what percentage of your followers: $ta_follower_per \n\n Engagement Rate: $engagement_rate \n\nIncome Limit: $ta_income_limit \n\nHold NFT: $ta_hold_nft \n\nAbout Passion: $about_passion \n\nAbout Followers: $about_followers \n\nAbout Books: $about_books \n\nAbout Collaboration: $about_collaboration \n\nNFT Limit Per Show: $nft_limit_per_show \n\nStatus: $affiliate_status";
			
			$headers = "Reply-To: ".$first_name."  <".$email.">\r\n";
			$headers .= 'From: '.$first_name.' <'.$emailTo.'>'."\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "X-Priority: 3\r\n";
		
			wp_mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
			
		}else{
			if(is_object($jsonArrayResponse->message)){
				foreach($jsonArrayResponse->message as $error){
					if(is_string($error)){
						$errorMessage .= '<p class="error">'.$error.'</p>';
					}else{
						foreach($error as $message){
							$errorMessage .= '<p class="error">'.$message.'</p>';
						}
					}
				}				
			}else{
				$errorMessage = $jsonArrayResponse->message;
			}
		}

	}
    
} ?>

<?php get_header(); ?>

	<div id="container" style="margin-top:0;">
		<div id="content">
			<?php the_post() ?>
			<div id="post-<?php the_ID() ?>" class="post">
				<div class="entry-content">
				<h1>Brand Ambassador Application</h1>
				
				<?php if(isset($emailSent) && $emailSent == true) { ?>
					<script> location.href='https://wynfluencer.com/brand-ambassador-12a-confirmed/'; </script>
				<?php } else { ?>
					<?php if(isset($errorMessage) || !empty($errorMessage)) { ?>
						<p class="error"><?php echo $errorMessage; ?><p>
					<?php }else if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error">Sorry, an error occured.<p>
					<?php } ?>
							
							
				<form id="affiliateForm" action="<?php the_permalink(); ?>"  method="post">

						<!-- Tab 1 -->
						<div class="tab"><h5>About you</h5>
						  <p>
							<label>First Name</label>
							<input type="text" name="first_name" placeholder="First Name"  class="required" value="<?php if(isset($_POST['first_name']))  echo $_POST['first_name'];?>" required />
							<?php if($first_name_Error != '') { ?>
								<span class="error"><?=$first_name_Error;?></span>
							<?php } ?>
						  </p>
						  <p>
							<label>Last Name</label>
							<input type="text" name="last_name" placeholder="Last Name"  class="required" value="<?php if(isset($_POST['last_name']))  echo $_POST['last_name'];?>" required/>
							<?php if($last_name_Error != '') { ?>
								<span class="error"><?=$last_name_Error;?></span>
							<?php } ?>
						  </p>
						  <p>
							<label>Your pronouns</label>
							<input type="text" name="pronouns" placeholder="Your pronouns"  class="required" value="<?php if(isset($_POST['pronouns']))  echo $_POST['pronouns'];?>" required/>
							<?php if($pronouns_Error != '') { ?>
								<span class="error"><?=$pronouns_Error;?></span>
							<?php } ?>
						  </p>
						  <p>
							<label>Your Email Address</label>
							<input type="email" name="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required"  required />
							<?php if($email_Error != '') { ?>
								<span class="error"><?=$email_Error;?></span>
							<?php } ?>
						  </p>
						  <p><label>Your Instagram</label><input type="text" name="instagram" placeholder="Your Instagram" ></p>
						  <p><label>Your Twitter</label><input type="text" name="twitter" placeholder="Your Twitter" ></p>
						  <p><label>Your Twitch</label><input type="text" name="twitch" placeholder="Your Twitch" ></p>
						  <p><label>Your Discord</label><input type="text" name="discord" placeholder="Your Discord" ></p>
						  <p><label>Your Youtube</label><input type="text" name="youtube" placeholder="Your Youtube" ></p>
						  
						  <div style="text-align:right; margin-top:20px;">						  
							<button type="button" class="next">Next</button>
						  </div>
						  
						</div>
						
						<!-- Tab 2 -->
						<div class="tab"><h5>About Your Followers</h5>
						  <p><label>Number of Followers</label><input type="text" name="followers_count" placeholder="Number of Followers" ></p>
						  <p><label>Engagement Rate</label><input type="text" name="engagement_rate" placeholder="" ></p>
						  <p><label>In relation to our target audience, what percentage of your followers</label><input name="ta_follower_per" class="slider" type="range" min="1" max="100" value="50"  id="myRange"><span id="myRangeval"></span></p>
						  <p><label>Have an annual income above US$ 500.000</label><input type="text" name="ta_income_limit" placeholder="" ></p>
						  <p><label>Already own high-value NFTs (BAYC, CryptoPunks, World of Women, …)</label><input type="text" name="ta_hold_nft" placeholder="" ></p>
						  
						  <div style="text-align:right; margin-top:20px;">						  
							<button type="button" class="previous">Previous</button>
							<button type="button" class="next">Next</button>
						  </div>
						  
						</div>

						<!-- Tab 3 -->
						<div class="tab"><h5>About your passion</h5>
						  <p><label>Describe your passion in 3 words</label><input type="text" name="about_passion" placeholder="" ></p>
						  <p><label>How would your followers describe you in 3 words?</label><input type="text" name="about_followers" placeholder="" ></p>
						  <p><label>Name 3 books that inspired you</label><input type="text" name="about_books" placeholder="" ></p>
						  <p><label>What makes you an outstanding brand ambassador?</label><input type="text" name="about_collaboration" placeholder="" ></p>
						  <p><label>How many NFT purchases do you expect to generate per show?</label><input type="text" name="nft_limit_per_show" placeholder="" ></p>
						  						  
						  <div style="text-align:right;  margin-top:20px;">						  
							<button type="button" class="previous">Previous</button>
							<button type="submit" class="next">Submit</button>
						  </div>						
						  <input type="hidden" name="submitted" id="submitted" value="true" />
						</div>
						</form>
						
				<?php } ?>
				
				</div><!-- .entry-content ->
			</div><!-- .post-->
		</div><!-- #content -->
	</div><!-- #container -->
	<script>
	var slider = document.getElementById("myRange");
	var output = document.getElementById("myRangeval");
	output.innerHTML = slider.value; // Display the default slider value

	// Update the current slider value (each time you drag the slider handle)
	slider.oninput = function() {
	  output.innerHTML = this.value;
	}
	
$(document).ready(function(){
	var current = 1,current_step,next_step,steps;
	steps = $(".tab").length;
	$(".next").click(function(){
		if($("#affiliateForm").valid())
	   {          
		current_step = $(this).parents('.tab');
		next_step = $(this).parents('.tab').next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);		
	   }
	});
	$(".previous").click(function(){
		current_step = $(this).parents('.tab');
		next_step = $(this).parents('.tab').prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width",percent+"%")
			.html(percent+"%");		
	}	   
	  
});


$(document).ready(function () {
	$(".next").click(function() {
		
    $('#affiliateForm').validate({
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        first_name: 'Please enter First Name.',
		last_name: 'Please enter Last Name.',
		pronouns: 'Please enter Pronouns.',
        email: {
          required: 'Please enter Email Address.',
          email: 'Please enter a valid Email Address.',
        }
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
	
	$("html, body").animate({
            scrollTop: 0
        }, 1000);
	
	});
	
  });
  
	</script>
	
<?php get_footer() ?>