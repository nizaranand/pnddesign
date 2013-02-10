<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */

// if comments are open
if(comments_open()):
?>
	<div class="row" id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'frogblog' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2><?php
			printf( _n( 'One comment so far', '%1$s comments so far', get_comments_number(), 'frogblog' ),
				number_format_i18n( get_comments_number() ), '<strong>' . get_the_title() . '</strong>' );
			?>
		</h2>
		
		<ul class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ft_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define ft_comment() and that will be used instead.
				 */
				wp_list_comments( array( 'callback' => 'ft_comment' ) );
			?>
		</ul>

		<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'frogblog' ); ?></p>
	<?php endif; ?>

	<?php
	$fields =  array(
		'author' => '<div class="inputs"><label class="author">' . __( 'Name:' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" class="input-text clearme" name="author" type="text" value="Enter your name" size="30"' . $aria_req . ' /></div>',
		'email' => '<div class="inputs"><label class="email">' . __( 'Email:' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" class="input-text clearme" name="email" type="text" value="Your email address" size="30"' . $aria_req . ' /></div>',
		'url' => '<div class="inputs"><label class="url">' . __( 'URL:' ) . '</label><input id="url" class="input-text clearme" name="url" type="text" value="Your URL" size="30" /></div>'
	); ?>
	
	<?php $defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="commentarea"><label class="message">Message: <span class="required">*</span></label><textarea name="comment" cols="30" rows="5" class="textarea clearme" id="comment" tabindex="4" aria-required="true">Your comment...</textarea></div>',
		'logged_in_as'         => '',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'std-form',
		'id_submit'            => 'button',
		'title_reply'			=> '',
		'label_submit'         => __( 'Submit Comment' ),
	);
	?>

	<div class="row" id="comments-form-wrap">
				
		<h2>Leave a comment</h2>
		
		<p>Make sure you enter the <span>* required</span> information where indicated. Comments are moderated – and rel="nofollow" is in use. Please no link dropping, no keywords or domains as names; do not spam, and do not advertise!</p>
		
		<?php comment_form($defaults); ?>
		
	</div>
	
</div><!-- #comments -->
<?php endif; ?>