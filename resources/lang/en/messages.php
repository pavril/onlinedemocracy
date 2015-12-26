<?php

return [
		
		'website' => [
				'home' => [
						'title' => "You finally got the power to change things!",
						'subtitle' => "Take part in your school's decision making in less than 5 seconds. Join DirectDemocracy.",

						'able_to' => "You can",
						'vote' => "Vote",
						'vote_text' => "With DirectDemocracy, you are able to vote on suggestions made by other pupils concerning the school life.",
						'suggest' => "Suggest",
						'suggest_text' => "With DirectDemocracy, you can make your own suggestions for everything concerning the school life. Everyone can vote on your propositions.",
						'comment' => "Comment",
						'comment_text' => "With DirectDemocracy, you can comment on suggestions made by other pupils and help improve your school life.",
				],
				'terms' => "Terms of service",
				'footer' => "DirectDemocracy is developped and mantained by Photis Avrilionis. Copyright © 2015 - 2016 Photis Avrilionis.",
		],

		'proposition' => [
				'back' => "Back",
				'flagged' => "This proposition was flagged successfully, our moderators team will handle your request.",
				'status' => [
						'expired' => "Expired",
						'blocked' => "Blocked by moderator",
						'pending' => "Pending for approval",
						'ending_in' => "{1} Ending in :daysleft day|{0} Ending in :daysleft days|[2,Inf] Ending in :daysleft days",
				],
				'share' => [
						'share' => "Share",
						'facebook' => "Facebook",
						'twitter' => "Twitter",
						'gplus' => "Google +",
						'pin' => "Pinterest",
				],
				'flagging' => [
						'flag' => "Flag this proposition",
						'offensive' => "This proposition is offensive",
						'inappropriate' => "This proposition is inappropriate",
						'incomprehensible' => "This proposition is incomprehensible",
				],
				'comments' => [
						'no_comments' => "This proposition has no comments",
						'no_comments_part2' => "yet, be the first to",
						'add' => "add a comment",
						'cancel' => "Cancel",
						'delete' => "Delete",
				],
				'voting' => [
						'expired' => "You can't vote anymore, this proposition has expired",
						'already_voted' => "You have already voted for this proposition",
						'already_voted_sort' => "You have voted!",
						'link' => "Link your school account in order to vote and comment",
						'credits' => "Written by:",
						'actions' => [
								'upvote' => "Upvote",
								'downvote' => "Downvote",
								'comment' => "New comment",
								'comment_placeholder' => "Enter your comment",
								'post_comment' => "Post",
						],
						'stats' => [
								'upvotes' => "{1} :votes upvote|{0} :votes upvotes|[2,Inf] :votes upvotes",
								'downvotes' => "{1} :votes downvote|{0} :votes downvotes|[2,Inf] :votes downvotes",
								'comments' => "{1} :comments comment|{0} :comments comments|[2,Inf] :comments comments",
						],
				],
		],
		
		'propositions' => [
				'create' => "Create proposition",
				'ending_soon' => "Propositions ending soon",
				'new_propositions' => "New propositions",
				'voted_propositions' => "Voted propositions",
				'expired_propositions' => "Expired propositions",
		],
		
		'profile' => [
				'menu' => [
						'active' => "Active account",
						'inactive' => "Inactive account",
						'linked_with_school' => "Your account is linked with your school email",
						'not_linked_with_school' => "Your account isn't linked with your school email",
						'account' => "Account",
						'overview' => "Overview",
						'language' => "Language",
						'propositions' => "Propositions",
						
						'contribute' => "Contribute",
						'translate' => "Help translate",
						'github' => "GitHub",
						'feedback' => "Give your feedback",
				],
				'account' => [
						'name' => "Name",
						'contact_email' => "Contact email",
						'contact_email_info' => "You will receive emails to this address.",
						'email' => "Email",
						'avatar' => "Avatar",
						'change_password' => "Change password",
						'language' => "Language",
						'school_link' => "School Account Link",
						'school_link_help' => "You need to be part of the European School of Mamer in order to vote, comment and create propositions.",
						'school_link_actions' => [
								'link_now' => "Link now",
								'linked_with' => "Linked with:",
								'unlink_now' => "Unlink",
						],
						'school_link_messages' => [
								"already_linked" => "This email is already linked with another account",
								"not_valid_email" => "This is not a school email, your email should end by @eursc-mamer.lu",
								"error" => "Link error",
								"unlinked" => "Unlinked successfully"
						],
						'propositionsCount' => "{1} :propositions proposition|{0} :propositions propositions|[2,Inf] :propositions propositions",
						'school_link_info' => "You need to be part of the European School of Mamer in order to vote, comment and make propositions or suggestions.",
						'save' => "Save",
				],
				'password' => [
						'old' => 'Old password',
						'enter_old' => 'Enter your old password',
						'new' => 'New password',
						'enter_new' => 'Enter a new password',
						'new_confirm' => 'Confirm password',
						'enter_new_confirm' => 'Re-enter your new password',
						'submit' => 'Update password',
						'updated' => "Your password was updated successfully",
						'wrong' => "Wrong password"
				],
				'create_proposition' => [
						'step' => "Step :step",
						'create_proposition' => "Create proposition",
						'proposition_sort' => "Write your proposition",
						'proposition_long' => "Describe your idea (optional)",
						'deadline' => "Pick a deadline",
						'confirm' => "Confirm",
						'next' => "Next",
						'previous' => "Previous",
						'submit' => "Post proposition",
						'agree' => 'By posting your proposition you agree that your propositions will be queued for approval by our moderator team before going public.',
						'more' => "Read more in Terms & Services",
						'errors' => "You have several errors, please check each step before posting your proposition.",
						'inactive' => "Oh snap! Your account isn't active.",
				],
				'propositions' => [
						'go_to' => "Go to proposition",
						'status' => [
								'ending_in' => "{1} Ending in :daysleft day|{0} Ending in :daysleft days|[2,Inf] Ending in :daysleft days",
								'2' => "Waiting for approval",
								'3' => "Blocked",
								'expired' => "Expired",
								'block_reason' => "Block reason:",
								'upvotes' => "{1} :votes upvote|{0} :votes upvotes|[2,Inf] :votes upvotes",
								'downvotes' => "{1} :votes downvote|{0} :votes downvotes|[2,Inf] :votes downvotes",
						],
				],
				'logout' => "Logout",
		],
		
		'feedback' => [
				'thanks' => "Thank you for your feedback",
				'reason' => "DirectDemocracy is still in it's development phase. Feel free to tell us what you think we could improve or add! Your help is much appreciated.",
				'feedback' => "Feedback",
				'submit' => "Send feedback",
		],
		
		'moderator' => [
				'head_title' => [
						'moderate_props' => "Propositions moderation",
						'handle_flags' => "Handle flagged propositions",
				],
				'menu' => [
						'title' => "Moderator",
						'for_approval' => "Propositions queued for approval",
						'handle_flags' => "Handle flagged propositions",
				],
				'flags' => [
						'count' => "{1} :flags flag|{0} :flags flags|[2,Inf] :flags flags",
						'offensive_count' => "{1} :flags time flagged as offensive|{0} :flags times flagged as offensive|[2,Inf] :flags times flagged as offensive",
						'inappropriate_count' => "{1} :flags time flagged as inappropriate|{0} :flags times flagged as inappropriate|[2,Inf] :flags times flagged as inappropriate",
						'incomprehensible_count' => "{1} :flags time flagged as incomprehensible|{0} :flags times flagged as incomprehensible|[2,Inf] :flags times flagged as incomprehensible",
						'avoid' => 'Unless in an emergency, avoid blocking propositins wich where flagged less than 5 times',
				],
				'for_approval' => "Queued propositions for approval",
				'criteria' => [
						'title' => "Approval criteria",
						'no_offensive_words' => "Must not contain offensive words",
						'no_mentions' => "Must not mention names",
						'grammar_and_spelling' => "Check for grammar and spelling mistakes if possible",
				],
				'approve' => "Approve",
				'block' => "Block",
				'days_left' => "{1} :daysleft day left|{0} :daysleft days left|[2,Inf] :daysleft days left",
				'reason_placeholder' => "Reason",
				'all_ok' => "No propositions left to approve, good job! :)",
				
		],
		
		'session' => [
				"login" => [
						'wrong_pass' => 'Wrong password',
						'facebook_connection_error' => "Something went wrong while connectin with Facebook",
						'error' => 'Something went wrong',
						'forgot_pass' => "Forgot password",
						'login' => "Login",
						'email' => "Email",
						'email_placeholder' => "Enter your email",
						'password' => "Password",
						'password_placeholder' => "Enter password",
						'submit' => "Sign in",
						'use_fb' => "Sign in with Facebook",
						'use_fb_login' => "Login with Facebook",
						'sign_up' => "Sign up",
				],
				"sign_up" => [
						'sign_up' => "Sign up",
						'name' => "Name",
						'first_placeholder' => "Enter your first name",
						'last_placeholder' => "Enter your last name",
						'email' => "Email",
						'email_placeholder' => "Enter your email",
						'password' => "Password",
						'password_placeholder' => "Enter a password",
						'password_confirm' => "Type your password again",
						'use_fb' => "Register with Facebook",
						'accept_terms' => "By signing up you agree the the",
				],
				"forgot" => [
						'reset' => "Reset password",
						'email' => "Email",
						'email_placeholder' => "Enter email",
						'email_link' => "Email me a password reset link",
				],
				"reset" => [
						'reset' => "Reset password",
						'new_pass' => "New password",
						'new_pass_placeholder' => "Enter a new password",
						'new_pass_confirm' => "Confirm password",
						'new_pass_confirm_placeholder' => "Enter your new password again",
						'submit' => "Reset password",
				],
				'return_to_login' => "Return to the login screen",
		],
		
		'form' => [
				'select' => [
						'please_select' => "Please select ...",
						'2weeks' => "2 weeks",
						'1month' => "1 month",
						'2months' => "2 months",
				],
				'buttons' => [
						'save' => "Save"
				]
		],
		
		'emails' => [
				'password_reset' => [
						'click_to_reset' => "Click here to reset your password:",
				],
		],
		
		'unauthorized' => "Unauthorized action.",
		
		'navigation' => [
				'nav_toggle' => "Toggle navigation",
				'home' => "Home",
				'create_proposition' => "Create proposition",
				'propositions' => "My propositions",
				'profile' => "Profile",
				'language' => "Language",
				'logout' => "Logout",
		],
		
		'languages' => [
				'en' => 'English',
				'fr' => 'Français',
		]

];
