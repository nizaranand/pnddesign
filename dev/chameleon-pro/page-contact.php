<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */

// form validation
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	// no errors, send out email
	if(!isset($hasError)) {
		$emailTo = of_get_option('ft_contact_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'Contact form enquiry';
		$body = "Name: $name \r\nEmail: $email \r\nComments: $comments\r\n";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<!-- CONTENT -->
<div class="<?php echo ft_sidebar_float('content', $post->ID); ?>" id="content">

	<!-- MAIN POST -->
	<div class="post">
		
		<h1 class="post-title"><?php the_title(); ?></h1>
		
		<?php the_content(); ?>
		
		<?php if(isset($emailSent) && $emailSent == true): ?>
			<div class="alert-box success"><strong>Thanks!</strong> Your email was sent successfully.</div>
		<?php elseif(isset($hasError) || isset($captchaError)): ?>
			<div class="alert-box error"><strong>Error!</strong> Sorry, an error occured.</div>
		<?php endif; ?>
		
		<?php if($emailSent!=true): ?>

		<form action="<?php the_permalink(); ?>" method="post" class="contactform">
			
			<fieldset>
				
				<legend>Contact Form</legend>
			
				<div class="inputs">
					<label for="name">Please tell us your name <span>*</span></label>
					<input type="text" name="contactName" value="<?php if(isset($_POST['contactName'])){ echo $_POST['contactName']; }else{ echo ''; }?>" id="name" class="input-text clearme" />
					<?php if($nameError != '') { ?>
						<div class="alert-box error clear"><?=$nameError;?></div>
					<?php } ?>
				</div>
				<div class="inputs">
					<label for="email">Please tell us your email address <span>*</span></label>
					<input type="text" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }else{ echo ''; }?>" id="email" class="input-text clearme" />
					<?php if($emailError != '') { ?>
						<div class="alert-box error clear"><?=$emailError;?></div>
					<?php } ?>
				</div>
				<div class="commentarea">
					<label>How can we help you? <span>*</span></label>
					<textarea name="comments" cols="30" rows="5" class="textarea clearme"></textarea>
					<?php if($commentError != '') { ?>
						<div class="alert-box error clear"><?=$commentError;?></div>
					<?php } ?>
				</div>
				<div class="clear">
					<input type="submit" name="submitContent" class="submit" value="Send it &raquo;" />
					<input type="hidden" name="submitted" id="submitted" value="true" />
				</div>
				
			</fieldset>
			
		</form>
		
		<?php endif; ?>
		
	</div>
	
</div>

<?php endwhile; // end of the loop. ?>	
<?php get_sidebar('page'); ?>
<?php get_footer(); ?>