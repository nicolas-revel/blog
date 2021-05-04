## Projet Blog

Ce projet est réalisé dans le cadre de ma formation à [La Plateforme_].

Le but de ce projet est de créer un blog avec :

- Une page d’accueil (index.php).
Cette page contient les 3 derniers articles. En bas de la page, il doit y avoir
un lien vers la page articles.
- Une page contenant un formulaire d’inscription (inscription.php) :
Le formulaire doit contenir l’ensemble des champs présents dans la table
“utilisateurs” ainsi qu’une confirmation de mot de passe. Dès qu’un
utilisateur remplit ce formulaire, les données sont insérées dans la base de
données et l’utilisateur est dirigé vers la page de connexion.
- Une page contenant un formulaire de connexion (connexion.php) :
Le formulaire doit avoir deux inputs : “login” et “password”. Lorsque le
formulaire est validé, s’il existe un utilisateur en bdd correspondant à ces
informations, alors l’utilisateur devient connecté et une (ou plusieurs)
variables de session sont créées.
- Une page permettant de modifier son profil (profil.php) :
Cette page possède un formulaire permettant à l’utilisateur de modifier
l’ensemble de ses informations.

- Une page contenant les articles (articles) :
Sur cette page, les utilisateurs peuvent voir l’ensemble des articles, triés du
plus récents au plus anciens. S’il y a plus de 5 articles, seuls les 5 premiers
sont affichés et un système de pagination permet d’afficher les 5 suivants
(ou les 5 précédents). Pour cela, il faut utiliser l’argument GET “start”.
ex : https://localhost/blog/articles.php/?start=5 affiche les articles 6 à 10.
La page articles peut également filtrer les articles par catégorie à l’aide de
l’argument GET “categorie” qui utilise les id des categories.
ex : https://localhost/blog/articles.php/?categorie=1&start=10 affiche les
articles 11 à 15 ayant comme id_categorie 1).
- Une page permettant de créer des articles (creer-article.php) :
Cette page possède un formulaire permettant aux modérateurs et
administrateurs de créer de nouveaux articles. Le formulaire contient donc
le texte de l’article, une liste déroulante contenant les catégories existantes
en base de données et un bouton submit.
- Une page contenant un article et ses commentaires (article.php) :
Cette page permet de voir un article, l’ensemble des commentaires
associés et la possibilité d’en ajouter un nouveau. Il faut utiliser l’argument
GET “id” afin de sélectionner l’article souhaité.
ex : https://localhost/blog/article.php/?id=1

- Une page d’administration (admin.php) :
Cette page permet aux administrateurs de gérer l’ensemble du site
(modification et suppression d’articles, création/modification et suppression
de catégories, d’utilisateurs, droits...)
Les technologies utilisées pour le projet :

<img align="left" alt="Logo HTML5" width="30px" src="https://logos-download.com/wp-content/uploads/2017/07/HTML5_logo.png" />
<img align="left" alt="Logo CSS3" width="30px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/CSS.3.svg/428px-CSS.3.svg.png" />
<img align="left" alt="Logo PHP" width="30px" src="https://s2.qwant.com/thumbr/700x0/6/e/f77aa00e692086da2960304c59edc9db69a99b1a9b14552b67a1e2f8ddb3bb/php-1-logo-png-transparent.png?u=https%3A%2F%2Fcdn.freebiesupply.com%2Flogos%2Flarge%2F2x%2Fphp-1-logo-png-transparent.png&q=0&b=1&p=0&a=0" />

[la plateforme_]: https://laplateforme.io/
