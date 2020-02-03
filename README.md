# BlogSymfony

Projet de site en Symfony - Aurelien SANTANA & Leo YIU
! Projet réalisé sans Docker ! 

FONCTIONNALITÉS DU SITE :
	
	- En tant que visiteur sans connexion :
		- Voir la liste des jeux
		- Voir la liste des jeux et l'éditeur auquel il est lié
		- Possibilité de cliquer sur le bouton de détails pour + d'infos
		- Possibilité de se connecter et/ou de créer un compte

	- En tant qu'utilisateur connecté :
		- Voir la liste des jeux
		- Voir la liste des jeux et l'éditeur auquel il est lié
		- Possibilité de cliquer sur le bouton de détails pour + d'infos
		- Voir la liste des éditeurs
		- Possibilité d'ajouter un jeu en favoris et d'accéder à son interface de favoris pour les gérer (le bouton 'ajouter' ne disparait pas après utilisation mais n'ajoute le jeu qu'une fois)
		- Possibilité de cliquer sur le bouton de détails pour + d'infos
		- Possibilité de se déconnecter
		- Possibilité de modifier son profil

	- En tant qu'administrateur connecté : 
		- Mêmes roles que l'utilisateur
		- Peut créer un jeu/modifier un jeu/supprimer un jeu
		- Peut créer un éditeur/modifier un éditeur/supprimer un éditeur (Les jeux ne sont pas supprimés en conséquence)
		- Peut voir les utilisateurs du site/les modifier/les supprimer

	GESTION DE L'APPLICATION :

	- Un événement est propagé lorsqu'un utilisateur va créer un compte sur le site (je me suis inspiré de votre modèle vu en cours), le log est bien écrit
	- Possibilité de créer un utilisateur admin via la commande 'php bin/console app:create-admin-user admintest@gmail.com admintest admintest admintest' (exemple de champs remplis)
	- Barre de navigation persistante sur chaque page du site et modifiable en fonction des autorisations de l'utilisateur actuel
	- Ajout de message flash à chaque action réalisée dans le CRUD

	NON RÉALISÉ :

	Ajout des fixtures
	
	---------------------
	
	BASE DE DONNÉES :
	( Travail réalisé sur mac / MAMP )
	Nom de la base de données : symfoProject
	Export fait de la base de données dans le fichier -- phpMyAdmin SQL Dump
	

