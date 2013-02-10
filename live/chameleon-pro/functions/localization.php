<?php

// 404.php
if(of_get_option('ft_loc_404_home')): define('ft_loc_404_home', of_get_option('ft_loc_404_home')); else: define('ft_loc_404_home', 'Home'); endif;
if(of_get_option('ft_loc_404_page_not_found')): define('ft_loc_404_page_not_found', of_get_option('ft_loc_404_page_not_found')); else: define('ft_loc_404_page_not_found', 'Page Not found'); endif;
if(of_get_option('ft_loc_404_404')): define('ft_loc_404_404', of_get_option('ft_loc_404_404')); else: define('ft_loc_404_404', '404'); endif;
if(of_get_option('ft_loc_404_sorry')): define('ft_loc_404_sorry', of_get_option('ft_loc_404_sorry')); else: define('ft_loc_404_sorry', 'Sorry!'); endif;
if(of_get_option('ft_loc_404_cant_find')): define('ft_loc_404_cant_find', of_get_option('ft_loc_404_cant_find')); else: define('ft_loc_404_cant_find', 'It seems we can\'t find what you&rsquo;re looking for. Perhaps searching can help.'); endif;

// archive.php
if(of_get_option('ft_loc_archive_daily_archives')): define('ft_loc_archive_daily_archives', of_get_option('ft_loc_archive_daily_archives')); else: define('ft_loc_archive_daily_archives', 'Daily Archives'); endif;
if(of_get_option('ft_loc_archive_monthly_archives')): define('ft_loc_archive_monthly_archives', of_get_option('ft_loc_archive_monthly_archives')); else: define('ft_loc_archive_monthly_archives', 'Monthly Archives'); endif;
if(of_get_option('ft_loc_archive_yearly_archives')): define('ft_loc_archive_yearly_archives', of_get_option('ft_loc_archive_yearly_archives')); else: define('ft_loc_archive_yearly_archives', 'Yearly Archives'); endif;
if(of_get_option('ft_loc_archive_blog_archives')): define('ft_loc_archive_blog_archives', of_get_option('ft_loc_archive_blog_archives')); else: define('ft_loc_archive_blog_archives', 'Blog Archives'); endif;
if(of_get_option('ft_loc_archive_switch_view')): define('ft_loc_archive_switch_view', of_get_option('ft_loc_archive_switch_view')); else: define('ft_loc_archive_switch_view', 'Switch View'); endif;
if(of_get_option('ft_loc_archive_nothing_found')): define('ft_loc_archive_nothing_found', of_get_option('ft_loc_archive_nothing_found')); else: define('ft_loc_archive_nothing_found', 'Nothing Found'); endif;
if(of_get_option('ft_loc_archive_apologies')): define('ft_loc_archive_apologies', of_get_option('ft_loc_archive_apologies')); else: define('ft_loc_archive_apologies', 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'); endif;
if(of_get_option('ft_loc_archive_by')): define('ft_loc_archive_by', of_get_option('ft_loc_archive_by')); else: define('ft_loc_archive_by', 'By'); endif;
if(of_get_option('ft_loc_archive_comments')): define('ft_loc_archive_comments', of_get_option('ft_loc_archive_comments')); else: define('ft_loc_archive_comments', 'Comments'); endif;
if(of_get_option('ft_loc_archive_comment')): define('ft_loc_archive_comment', of_get_option('ft_loc_archive_comment')); else: define('ft_loc_archive_comment', 'Comment'); endif;
if(of_get_option('ft_loc_archive_continue_reading')): define('ft_loc_archive_continue_reading', of_get_option('ft_loc_archive_continue_reading')); else: define('ft_loc_archive_continue_reading', 'Continue reading'); endif;

/* author.php */
if(of_get_option('ft_loc_author_archives')): define('ft_loc_author_archives', of_get_option('ft_loc_author_archives')); else: define('ft_loc_author_archives', 'Author Archives'); endif;

/* category */
if(of_get_option('ft_loc_category_archives')): define('ft_loc_category_archives', of_get_option('ft_loc_category_archives')); else: define('ft_loc_category_archives', 'Category Archives'); endif;

/* comments.php */
if(of_get_option('ft_loc_comments_password_protected')): define('ft_loc_comments_password_protected', of_get_option('ft_loc_comments_password_protected')); else: define('ft_loc_comments_password_protected', 'This post is password protected. Enter the password to view any comments.'); endif;
if(of_get_option('ft_loc_comments_one_comment_on')): define('ft_loc_comments_one_comment_on', of_get_option('ft_loc_comments_one_comment_on')); else: define('ft_loc_comments_one_comment_on', 'One comment so far'); endif;
if(of_get_option('ft_loc_comments_comments_on')): define('ft_loc_comments_comments_on', of_get_option('ft_loc_comments_comments_on')); else: define('ft_loc_comments_comments_on', 'comments so far'); endif;
if(of_get_option('ft_loc_comments_comments_are_closed')): define('ft_loc_comments_comments_are_closed', of_get_option('ft_loc_comments_comments_are_closed')); else: define('ft_loc_comments_comments_are_closed', 'Comments are closed.'); endif;
if(of_get_option('ft_loc_comments_name')): define('ft_loc_comments_name', of_get_option('ft_loc_comments_name')); else: define('ft_loc_comments_name', 'Name'); endif;
if(of_get_option('ft_loc_comments_email')): define('ft_loc_comments_email', of_get_option('ft_loc_comments_email')); else: define('ft_loc_comments_email', 'Email'); endif;
if(of_get_option('ft_loc_comments_url')): define('ft_loc_comments_url', of_get_option('ft_loc_comments_url')); else: define('ft_loc_comments_url', 'URL'); endif;
if(of_get_option('ft_loc_comments_enter_your_name')): define('ft_loc_comments_enter_your_name', of_get_option('ft_loc_comments_enter_your_name')); else: define('ft_loc_comments_enter_your_name', 'Enter your name'); endif;
if(of_get_option('ft_loc_comments_your_email_address')): define('ft_loc_comments_your_email_address', of_get_option('ft_loc_comments_your_email_address')); else: define('ft_loc_comments_your_email_address', 'Your email address'); endif;
if(of_get_option('ft_loc_comments_your_url')): define('ft_loc_comments_your_url', of_get_option('ft_loc_comments_your_url')); else: define('ft_loc_comments_your_url', 'Your URL'); endif;
if(of_get_option('ft_loc_comments_your_comment')): define('ft_loc_comments_your_comment', of_get_option('ft_loc_comments_your_comment')); else: define('ft_loc_comments_your_comment', 'Your comment...'); endif;
if(of_get_option('ft_loc_comments_add_your_comment')): define('ft_loc_comments_add_your_comment', of_get_option('ft_loc_comments_add_your_comment')); else: define('ft_loc_comments_add_your_comment', 'Add your Comment'); endif;
if(of_get_option('ft_loc_comments_submit_comment')): define('ft_loc_comments_submit_comment', of_get_option('ft_loc_comments_submit_comment')); else: define('ft_loc_comments_submit_comment', 'Submit Comment'); endif;
if(of_get_option('ft_loc_comments_leave_a_comment')): define('ft_loc_comments_leave_a_comment', of_get_option('ft_loc_comments_leave_a_comment')); else: define('ft_loc_comments_leave_a_comment', 'Leave a comment'); endif;
if(of_get_option('ft_loc_comments_make_sure')): define('ft_loc_comments_make_sure', of_get_option('ft_loc_comments_make_sure')); else: define('ft_loc_comments_make_sure', 'Make sure you enter the <span>* required</span> information where indicated. Comments are moderated – and rel="nofollow" is in use. Please no link dropping, no keywords or domains as names; do not spam, and do not advertise!'); endif;

/* footer.php */
if(of_get_option('ft_loc_footer_enter_search')): define('ft_loc_footer_enter_search', of_get_option('ft_loc_footer_enter_search')); else: define('ft_loc_footer_enter_search', 'Enter search and hit enter!'); endif;
if(of_get_option('ft_loc_footer_back_top')): define('ft_loc_footer_back_top', of_get_option('ft_loc_footer_back_top')); else: define('ft_loc_footer_back_top', 'Back to top'); endif;

/* header.php */
if(of_get_option('ft_loc_header_menu')): define('ft_loc_header_menu', of_get_option('ft_loc_header_menu')); else: define('ft_loc_header_menu', 'Menu'); endif;
if(of_get_option('ft_loc_header_close')): define('ft_loc_header_close', of_get_option('ft_loc_header_close')); else: define('ft_loc_header_close', 'Close'); endif;

/* tag.php */
if(of_get_option('ft_loc_tag_archives')): define('ft_loc_tag_archives', of_get_option('ft_loc_tag_archives')); else: define('ft_loc_tag_archives', 'Tag Archives'); endif;

/* search.php */
if(of_get_option('ft_loc_search_search_results_for')): define('ft_loc_search_search_results_for', of_get_option('ft_loc_search_search_results_for')); else: define('ft_loc_search_search_results_for', 'Search Results For'); endif;

/* single.php */
if(of_get_option('ft_loc_single_related_posts')): define('ft_loc_single_related_posts', of_get_option('ft_loc_single_related_posts')); else: define('ft_loc_single_related_posts', 'Related Posts'); endif;
if(of_get_option('ft_loc_single_read_more')): define('ft_loc_single_read_more', of_get_option('ft_loc_single_read_more')); else: define('ft_loc_single_read_more', 'Read more'); endif;

/* page-contact.php */
if(of_get_option('ft_loc_contact_please_enter_your_name')): define('ft_loc_contact_please_enter_your_name', of_get_option('ft_loc_contact_please_enter_your_name')); else: define('ft_loc_contact_please_enter_your_name', 'Please enter your name.'); endif;
if(of_get_option('ft_loc_contact_please_enter_your_email')): define('ft_loc_contact_please_enter_your_email', of_get_option('ft_loc_contact_please_enter_your_email')); else: define('ft_loc_contact_please_enter_your_email', 'Please enter your email address.'); endif;
if(of_get_option('ft_loc_contact_invlaid_email')): define('ft_loc_contact_invlaid_email', of_get_option('ft_loc_contact_invlaid_email')); else: define('ft_loc_contact_invlaid_email', 'You entered an invalid email address.'); endif;
if(of_get_option('ft_loc_contact_please_enter_message')): define('ft_loc_contact_please_enter_message', of_get_option('ft_loc_contact_please_enter_message')); else: define('ft_loc_contact_please_enter_message', 'Please enter a message.'); endif;
if(of_get_option('ft_loc_contact_form_enquiry')): define('ft_loc_contact_form_enquiry', of_get_option('ft_loc_contact_form_enquiry')); else: define('ft_loc_contact_form_enquiry', 'Contact form enquiry'); endif;
if(of_get_option('ft_loc_contact_name')): define('ft_loc_contact_name', of_get_option('ft_loc_contact_name')); else: define('ft_loc_contact_name', 'Name'); endif;
if(of_get_option('ft_loc_contact_email')): define('ft_loc_contact_email', of_get_option('ft_loc_contact_email')); else: define('ft_loc_contact_email', 'Email'); endif;
if(of_get_option('ft_loc_contact_website')): define('ft_loc_contact_website', of_get_option('ft_loc_contact_website')); else: define('ft_loc_contact_website', 'Website'); endif;
if(of_get_option('ft_loc_contact_tel')): define('ft_loc_contact_tel', of_get_option('ft_loc_contact_tel')); else: define('ft_loc_contact_tel', 'Telephone'); endif;
if(of_get_option('ft_loc_contact_comments')): define('ft_loc_contact_comments', of_get_option('ft_loc_contact_comments')); else: define('ft_loc_contact_comments', 'Comments'); endif;
if(of_get_option('ft_loc_contact_contact_detail')): define('ft_loc_contact_contact_detail', of_get_option('ft_loc_contact_contact_detail')); else: define('ft_loc_contact_contact_detail', 'Contact Detail'); endif;
if(of_get_option('ft_loc_contact_social_links')): define('ft_loc_contact_social_links', of_get_option('ft_loc_contact_social_links')); else: define('ft_loc_contact_social_links', 'Social Links'); endif;
if(of_get_option('ft_loc_contact_follow_us_on')): define('ft_loc_contact_follow_us_on', of_get_option('ft_loc_contact_follow_us_on')); else: define('ft_loc_contact_follow_us_on', 'Follow us on'); endif;
if(of_get_option('ft_loc_contact_fan_us_on')): define('ft_loc_contact_fan_us_on', of_get_option('ft_loc_contact_fan_us_on')); else: define('ft_loc_contact_fan_us_on', 'Fan us on'); endif;
if(of_get_option('ft_loc_contact_find_us_on')): define('ft_loc_contact_find_us_on', of_get_option('ft_loc_contact_find_us_on')); else: define('ft_loc_contact_find_us_on', 'Find us on'); endif;
if(of_get_option('ft_loc_contact_contact_form')): define('ft_loc_contact_contact_form', of_get_option('ft_loc_contact_contact_form')); else: define('ft_loc_contact_contact_form', 'Contact Form'); endif;
if(of_get_option('ft_loc_contact_email_sent')): define('ft_loc_contact_email_sent', of_get_option('ft_loc_contact_email_sent')); else: define('ft_loc_contact_email_sent', 'Thanks, your email was sent successfully.'); endif;
if(of_get_option('ft_loc_contact_error')): define('ft_loc_contact_error', of_get_option('ft_loc_contact_error')); else: define('ft_loc_contact_error', 'Sorry, an error occured.'); endif;
if(of_get_option('ft_loc_contact_how_can_we_help_you')): define('ft_loc_contact_how_can_we_help_you', of_get_option('ft_loc_contact_how_can_we_help_you')); else: define('ft_loc_contact_how_can_we_help_you', 'How can we help you?'); endif;
if(of_get_option('ft_loc_contact_your_name')): define('ft_loc_contact_your_name', of_get_option('ft_loc_contact_your_name')); else: define('ft_loc_contact_your_name', 'Your Name'); endif;
if(of_get_option('ft_loc_contact_your_email')): define('ft_loc_contact_your_email', of_get_option('ft_loc_contact_your_email')); else: define('ft_loc_contact_your_email', 'Your Email Address'); endif;
if(of_get_option('ft_loc_contact_your_website')): define('ft_loc_contact_your_website', of_get_option('ft_loc_contact_your_website')); else: define('ft_loc_contact_your_website', 'Your Website'); endif;
if(of_get_option('ft_loc_contact_your_tel')): define('ft_loc_contact_your_tel', of_get_option('ft_loc_contact_your_tel')); else: define('ft_loc_contact_your_tel', 'Your Telephone Number'); endif;
if(of_get_option('ft_loc_contact_subject')): define('ft_loc_contact_subject', of_get_option('ft_loc_contact_subject')); else: define('ft_loc_contact_subject', 'Subject'); endif;
if(of_get_option('ft_loc_contact_enquiry')): define('ft_loc_contact_enquiry', of_get_option('ft_loc_contact_enquiry')); else: define('ft_loc_contact_enquiry', 'Your Enquiry'); endif;
if(of_get_option('ft_loc_contact_send')): define('ft_loc_contact_send', of_get_option('ft_loc_contact_send')); else: define('ft_loc_contact_send', 'Send it'); endif;


?>