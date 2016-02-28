<?php

return [
		
		'website' => [
				'home' => [
						'title' => "Le pouvoir de changer!",
						'subtitle' => "Participes aux décisions de ton école en moins de 5 secondes. Rejoins DirectDemocracy !",

						'able_to' => "Tu peux",
						'vote' => "Voter",
						'vote_text' => "Avec DirectDemocracy tu peux voter les pétitions des autres élèves concernant la vie de l'école.",
						'suggest' => "Suggèrer",
						'suggest_text' => "Avec DirectDemocracy tu peux proposer tes propes pétitions pour tout ce qui concerne la vie de l'école. Tous les autres élèves pouvent voter pour tes propositions.",
						'comment' => "Commenter",
						'comment_text' => "Avec DirectDemocracy tu peux commenter les pétitions des autres élèves et aider à l'amélioration de la vie de l'école.",
				],
				'terms' => "Conditions d'utilisation",
				'footer' => "DirectDemocracy est développpé et maintenu par Photis Avrilionis Copyright © 2015 - 2016",
		],

		'proposition' => [
				'back' => "Retour",
				'flagged' => "La proposition a été marqué et sera signalée aux modérateurs.",
				'status' => [
						'expired' => "Expirée",
						'blocked' => "Bloquée par les modérateurs",
						'pending' => "En attente d'approbation",
						'ending_in' => "{1} Termine dans :daysleft jour|{0} Termine aujourd'hui|[2,Inf] Termine dans :daysleft jours",
				],
				'share' => [
						'share' => "Partager",
						'facebook' => "Facebook",
						'twitter' => "Twitter",
						'gplus' => "Google +",
						'pin' => "Pinterest",
				],
				'flagging' => [
						'flag' => "Marquer cette proposition",
						'offensive' => "Cette proposition est provocante/aggresive",
						'inappropriate' => "Cette proposition est inappropriée",
						'incomprehensible' => "Cette proposition est incompréhensible",
				],
				'comments' => [
						'no_comments' => "Cette proposition n'a pas de commentaires.",
						'no_comments_part2' => "Sois le premier à en",
						'add' => "rajouter",
						'cancel' => "Annuler",
						'delete' => "Supprimer",
				],
				'voting' => [
						'expired' => "Cette proposition est expirée, tu ne peux plus voter",
						'already_voted' => "Tu as déjà voté pour cette proposition",
						'already_voted_sort' => "Tu as voté, félicitations !",
						'link' => "Lies ce compte avec l'email de ton école pour pouvoir voter et commenter !",
						'credits' => "Ecrit par",
						'actions' => [
								'upvote' => "Voter pour",
								'downvote' => "Voter contre",
								'comment' => "Nouveau commentaire",
								'comment_placeholder' => "Ecris ton commentaire",
								'post_comment' => "Soumettre ton commentaire",
						],
						'stats' => [
								'upvotes' => "{0} Pas de vote pour|[1,Inf] :votes pour",
								'downvotes' => "{0} Pas de vote contre|[1,Inf] :votes contre",
								'comments' => "{1} :comments commentaire|{0} Pas de commentaire|[2,Inf] :comments commentaires",
						],
				],
				'marker' => [
						'1' => "Réussite",
						'2' => "En discussion",
						'3' => "Ne sera pas discutée davantage pour le moment ",
						'modal' => [
								'create_title' => "Marquer cette proposition",
								'edit_title' => "Modifier proposition marquée",
								'type' => "Type du marqueur",
								'message' => "Message du marqueur",
								'set' => "Enregistrer",
								'delete' => "Supprimer le marqueur",
								'update' => "Enregistrer",
								'create_success' => "Proposition marquée avec succès !",
								'update_success' => "Modifications enregistrés avec succès !",
						],
				],
		],
		
		'propositions' => [
				'create' => "Créer une proposition",
				'ending_soon' => "Propositions expirant bientôt",
				'new_propositions' => "Nouvelles propositions",
				'voted_propositions' => "Propositions auxquelles tu as voté",
				'expired_propositions' => "Propositions expirées",
		],
		
		'profile' => [
				'menu' => [
						'active' => "Compte actif",
						'inactive' => "Compte inactif",
						'linked_with_school' => "Ton compte est lié avec l'email de l'école",
						'not_linked_with_school' => "Ton compte n'est pas encore lié avec l'email de l'école",
						'account' => "Compte",
						'overview' => "Sommaire",
						'language' => "Langue",
						'propositions' => "Propositions",
						
						'contribute' => "Contribuer",
						'translate' => "Aides-nous à traduire",
						'github' => "GitHub",
						'feedback' => "Donnes-nous ton avis",
				],
				'account' => [
						'name' => "Nom",
						'contact_email' => "Email de contact",
						'contact_email_info' => "Tu vas recevoir notre courriel à cette adresse.",
						'email' => "Email",
						'avatar' => "Avatar",
						'change_password' => "Changer le mot de passe",
						'language' => "Langue",
						'school_link' => "Lien au compte de l'école",
						'school_link_help' => "Tu dois faire partie de l'école Européenne de Mamer pour voter, commenter et créer des propositions.",
						'school_link_actions' => [
								'link_now' => "Lier maintenant",
								'linked_with' => "Lié avec :",
								'unlink_now' => "Détacher",
						],
						'school_link_messages' => [
								"already_linked" => "Cet email est déjà utilisé dans un autre compte",
								"not_valid_email" => "Ceci n'est pas un compte email valide, ton email doit terminer par @eursc-mamer.lu",
								"error" => "Erreur de liaison avec compte email",
								"unlinked" => "Détachement réussi"
						],
						'propositionsCount' => "{1} :propositions proposition|{0} Pas de proposition|[2,Inf] :propositions propositions",
						'school_link_info' => "Tu dois faire partie de l'école Européenne de Mamer pour voter, commenter et créer des propositions.",
						'save' => "Enregistrer",
				],
				'password' => [
						'old' => 'Mot de passe actuel',
						'enter_old' => 'Saisir mot de passe actuel',
						'new' => 'Nouveau mot de passe',
						'enter_new' => 'Saisir nouveau mot de passe',
						'new_confirm' => 'Confirmer mot de passe',
						'enter_new_confirm' => 'Re-saisir nouveau mot de passe',
						'submit' => 'Mise à jour du mot de passe',
						'updated' => "Ton mot de passe a été mis à jour avec succès",
						'wrong' => "Mauvais mot de passe"
				],
				'create_proposition' => [
						'step' => "Etape :step",
						'create_proposition' => "Créer proposition",
						'proposition_sort' => "Écris ta proposition",
						'proposition_long' => "Décris ton idée (optionnel)",
						'deadline' => "Choisis une date limite",
						'confirm' => "Confimer",
						'next' => "Suivant",
						'previous' => "Précédent",
						'submit' => "Soumettre ta proposition",
						'agree' => "En soumettant ta proposition tu acceptes que ta proposition sera mis en attente d'approbation par un modérateur avant d'être publiée.",
						'more' => "Lire plus sur les conditions d'utilisation",
						'errors' => "Il y a plusieurs erreur, vérifies chaque étape avant de soumettre ta proposition.",
						'inactive' => "Zut ! Ton compte n'est pas encore actif.",
				],
				'propositions' => [
						'go_to' => "Aller à la proposition",
						'status' => [
								'ending_in' => "{1} Expire dans :daysleft jour|{0} Expire aujourd'hui|[2,Inf] Expire dans :daysleft jours",
								'2' => "En attente d'approbation",
								'3' => "Bloquée par les modérateurs",
								'expired' => "Expirée",
								'block_reason' => "Raison de blocage:",
								'upvotes' => "{0} Pas de vote pour|[1,Inf] :votes pour",
								'downvotes' => "{0} Pas de vote contre|[1,Inf] :votes contre",
						],
				],
				'logout' => "Déconnexion",
		],
		
		'feedback' => [
				'thanks' => "Merci pour ton avis",
				'reason' => "DirectDemocracy peut faire mieux ! N'hésites pas à nous dire ce que l'on peut améliorer ou rajouter ! Ton aide sera beaucoup appréciée.",
				'feedback' => "Ton avis",
				'submit' => "Donnes-nous ton avis",
		],
		
		'moderator' => [
				'head_title' => [
						'moderate_props' => "Modération des propositions",
						'handle_flags' => "Gérer les propositions marquées",
				],
				'menu' => [
						'title' => "Modérateur",
						'for_approval' => "Propositions soumises pour approbation",
						'handle_flags' => "Gérer les propositions marquées",
				],
				'flags' => [
						'count' => "{0} Pas de marque|{1} :flags marque|[2,Inf] :flags marques",
						'offensive_count' => "{0} Pas de marque de provocation|{1} :flags marque de provocation|[2,Inf] :flags marques de provocation",
						'incomprehensible_count' => "{0} Pas de marque d'incompréhension|{1} :flags marque d'incompréhension|[2,Inf] :flags marques d'incompréhension",
						'avoid' => "Sauf en cas d'urgence, ne pas bloquer des propositions qui ont moins de 5 marques",
				],
				'for_approval' => "Propositions en attente d'approbation",
				'criteria' => [
						'title' => "Critères d'approbation",
						'no_offensive_words' => "Ne doit pas contenir des mots aggressifs ou provocants",
						'no_mentions' => "Ne doit pas contenir des noms",
						'grammar_and_spelling' => "Si possible vérifier les erreurs de grammaire et d'orthographe",
				],
				'approve' => "Approuver",
				'block' => "Bloquer",
				'days_left' => "{0} Dernier jour|{1} Plus qu'un jour|[2,Inf] Encore :daysleft jours",
				'reason_placeholder' => "Raison",
				'all_ok' => "Plus de proposition à approuver, bon travail ! :)",
				
		],
		
		'session' => [
				"login" => [
						'wrong_pass' => 'Mauvais mot de passe',
						'facebook_connection_error' => "Une erreur est survenue lors de la connexion avec Facebook",
						'error' => "Quelque chose n'a pas fonctionné :(",
						'forgot_pass' => "Mot de passe oublié",
						'login' => "Connexion",
						'email' => "Email",
						'email_placeholder' => "Saisir adresse email",
						'password' => "Mot de passe",
						'password_placeholder' => "Saisir mot de passe",
						'submit' => "S'enregistrer",
						'use_fb' => "S'enregistrer avec Facebook",
						'use_fb_login' => "Se connecter avec Facebook",
						'sign_up' => "S'enregistrer",
				],
				"sign_up" => [
						'sign_up' => "S'enregistrer",
						'name' => "Nom",
						'first_placeholder' => "Saisir prènom",
						'last_placeholder' => "Saisir nom",
						'email' => "Adresse email",
						'email_placeholder' => "Saisir adresse email",
						'password' => "Mot de passe",
						'password_placeholder' => "Saisir un mot de passe",
						'password_confirm' => "Saisir mot de passe une deuxième fois",
						'use_fb' => "S'enregistrer avec Facebook",
						'accept_terms' => "En s'enregistrant tu acceptes les",
				],
				"forgot" => [
						'reset' => "Réinitialiser le mot de passe",
						'email' => "Adresse email",
						'email_placeholder' => "Saisir adresse email",
						'email_link' => "Envoyez-moi un lien de réinitialisation du mot de passe",
				],
				"reset" => [
						'reset' => "Réinitialiser le mot de passe",
						'new_pass' => "Nouveau mot de passe",
						'new_pass_placeholder' => "Saisir nouveau mot de passe",
						'new_pass_confirm' => "Confirmer mot de passe",
						'new_pass_confirm_placeholder' => "Re-saisir nouveau mot de passe",
						'submit' => "Réinitialiser le mot de passe",
				],
				'return_to_login' => "Retour à la page de connexion",
		],
		
		'form' => [
				'select' => [
						'please_select' => "Veuillez choisir ...",
						'please_select_deadline' => "Choisis une date limite ...",
						'2weeks' => "2 semaines",
						'1month' => "1 mois",
						'2months' => "2 mois",
				],
				'buttons' => [
						'save' => "Enregistrer"
				]
		],
		
		'emails' => [
				'password_reset' => [
						'click_to_reset' => "Cliquer ici pour réinitialiser le mot de passe:",
				],
		],
		
		'unauthorized' => "Action non autorisée.",
		
		'navigation' => [
				'nav_toggle' => "Toggle navigation",
				'home' => "Accueil",
				'create_proposition' => "Créer proposition",
				'propositions' => "Mes propositions",
				'profile' => "Profil",
				'language' => "Langue",
				'logout' => "Déconnexion",
		],
		
		'languages' => [
				'en' => 'English',
				'fr' => 'Français',
		]

];
