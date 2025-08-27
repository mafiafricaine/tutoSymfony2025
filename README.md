Télécharger le projet en zip.

Decompressez le dans le dossier ou vous avez des projets Symfony.

Lancez le cmd dans ce dossier.

Puis faites : 
  - composer update

Ca va permettre d'installer tous les composants nécessaire pour faire fonctionner le projet.

Au cas ou il faudrait changer le nom de la base de données dans le fichier .env

Créez la base de données via la commande :
  - symfony console doctrine:database:create

Si la base de données n'est pas fournie, faites la migration.

Récuperez la base de données du projet et importez la dans votre base de données créée.

Ensuite lancez le serveur et enjoy ;)

Sur le site, vous pouvez vous loguez avec 
  - login : jamesbond@cfitech.be
  - mot de passe : jamesbond
