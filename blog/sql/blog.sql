-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2021 at 02:40 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'En quoi consiste le developpement web  ?', 'Apparu avec Internet, le développement web fait référence au processus d’écriture d’un site ou d’une page web dans un langage technique. Il s’agit d’une étape incontournable pour qu’un contenu soit mis en ligne et atteigne ses lecteurs.\r\n\r\nLe développement web repose sur l’utilisation des langages (HTML/CSS, JavaScript, PHP…) pour écrire des programmes qui sont ensuite exécutés par les ordinateurs. Les instructions sont mises en place sur Internet et sont effectuées sur des serveurs.\r\n\r\nEn fonction des besoins des propriétaires du site ou des pages web, ces dernières peuvent être constituées uniquement de textes et d’éléments graphiques ressemblant à un document ou être interactives en affichant des informations qui évoluent (panier d’achat, par exemple).', 5, 4, '2021-01-23 11:30:03'),
(2, 'PHP est-il pertinent?', 'L\'une des questions les plus fréquemment posées par les universitaires, les candidats et même d\'autres développeurs est: «Pourquoi enseignez-vous PHP? ou, parfois même, &quot;PHP n\'est-il pas un langage mort?&quot;\r\n\r\nLaissez-moi très clair à ce sujet dès le début. PHP N\'EST PAS MORT.\r\n\r\nEn décembre 2017, PHP représentait plus de 83% des langages côté serveur utilisés sur Internet. Une grande partie de cela est constituée de systèmes de gestion de contenu basés sur PHP tels que WordPress, mais même si vous supprimez le CMS pré-construit de l\'équation, PHP représente toujours plus de 54% du Web . \r\n\r\n PHP est un langage très flexible et peu typé. Cela rend très facile la prise en main et le début de l\'écriture, mais aussi très facile de mal écrire. On pourrait dire qu\'il est victime de son propre succès. Mais lorsqu\'il est écrit correctement, en suivant des méthodologies telles que DRY, SOLID et MVC (tous les concepts que nous enseignons dans le cours de l\'académie), c\'est un langage très puissant, diversifié et rapide avec beaucoup à offrir.\r\n\r\nDonc non, PHP n\'est pas mort. Si, comme toute langue, elle a ses défauts, les statistiques parlent d’elles-mêmes.', 5, 1, '2021-01-23 12:02:08'),
(3, 'Presentation de &quot;Dead Simple Python&quot;', 'Avez-vous déjà passé trois heures à essayer de trouver ce peu de connaissances que tout le monde semblait avoir à part vous?\r\n\r\nEn tant que développeur Python auto-formé, je me suis parfois retrouvé coincé dans ce cratère de connaissances, entre des tutoriels beaucoup plus simples que la vraie vie et des articles plus avancés que je ne pourrais le comprendre. Même la documentation semblait être une source d\'informations, ce qui rendait presque impossible de trouver la seule chose de base que j\'avais besoin de savoir.\r\n\r\nDans cette série, je vais explorer quelques-uns de ces sujets, d\'une manière qui, espérons-le, les rend très simples!\r\n\r\n', 6, 3, '2021-01-23 13:45:27'),
(4, 'Pourquoi Python s\'appelle &quot;Python&quot;?', 'Guido van Rossum , l\'auteur de Python Programming Language, lisait les scripts publiés de « Monty Python\'s Flying Circus » , une série comique de la BBC des années 1970. Van Rossum pensait qu\'il avait besoin d\'un nom court, unique et légèrement mystérieux, il a donc décidé d\'appeler le langage Python .\r\nDans la FAQ , il a continué en disant qu\'il n\'y a aucune obligation d\'aimer Monty Python pour utiliser le langage de programmation Python et que l\'amour peut être mutuellement exclusif.', 6, 3, '2021-01-23 13:46:53'),
(5, 'Comment apprendre JavaScript.', 'De nos jours, le codage devient plus populaire que jamais. Il n\'est pas rare que les gens quittent leur emploi, apprennent le codage et obtiennent un poste de développement frontal en tant que deuxième carrière.\r\n\r\nLe développement front-end est une carrière si attrayante pour de nombreuses raisons: une forte demande, des salaires élevés et tout le monde peut apprendre à coder gratuitement (ou avec une petite somme d\'argent) sur Internet.\r\n\r\nPeut-être que la plus grande facette de l\'apprentissage du développement frontal est d\'avoir de solides compétences en JavaScript. La majorité des entretiens d\'embauche de développement front-end impliquent un codage JavaScript lourd ainsi qu\'une compréhension approfondie des concepts sous-jacents.\r\n\r\nMais apprendre JavaScript peut être intimidant avec autant de ressources à choisir. J\'ai donc compilé une liste des meilleurs endroits qui m\'ont aidé à apprendre JavaScript.\r\n\r\nSi vous êtes complètement nouveau dans le développement front-end, consultez le Manuel du développeur front-end . C\'est une excellente introduction au développement front-end avec des explications de haut niveau sur les technologies associées.', 7, 2, '2021-01-23 13:52:59'),
(6, 'A la defense du web moderne.', 'Je pense que je vais ennuyer tout le monde avec ce post: les croisés anti-JavaScript, à juste titre consternés par la quantité de choses que nous plaçons sur les sites Web modernes; les personnes qui se disputent le web est une plate - forme brisée pour les applications interactives de toute façon et nous devons recommencer; Réagissez aux utilisateurs; la vieille garde avec leur JS artisanal et HTML écrit à la main; et Tom MacWright , quelqu\'un que j\'admire de loin depuis que j\'ai pris conscience de son travail sur Mapbox il y a de nombreuses années. Mais je suppose que c\'est le prix d\'avoir des opinions.', 7, 4, '2021-01-23 13:56:42'),
(7, 'Node.js contre PHP', 'Il ne fait aucun doute que PHP est le langage le plus connu et le plus couramment utilisé pour les scripts côté serveur. Avant que Django et Ruby on Rails ne gagnent en popularité (2005-2006), il n\'y avait guère d\'option plus appropriée pour le back-end que PHP. Cependant, le monde de la technologie évolue rapidement dans le sens de la simplicité («Javascript partout») ce qui était autrefois le langage du front-end s\'est étendu avec succès au back-end. Nous sommes donc maintenant confrontés au célèbre dilemme back-end «Node.js vs PHP». Essayons de le résoudre ensemble!', 6, 5, '2021-01-23 14:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'PHP et MYSQL'),
(2, 'JAVASCRIPT'),
(3, 'PYTHON'),
(4, 'WEB'),
(5, 'NODE.JS');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'Super article, Python rules!', 14, 3, '2021-01-16 17:46:06'),
(2, 'Merci pour ce super article !', 14, 2, '2021-01-16 17:58:11'),
(3, 'Sublime ! ', 14, 1, '2021-01-16 18:02:37'),
(4, 'Javascript Rules!', 13, 1, '2021-01-16 18:05:43'),
(5, 'Test update commentaire', 14, 2, '2021-01-18 09:46:23'),
(6, 'liloilol merde', 14, 1, '2021-01-21 11:29:50'),
(7, 'hello !', 14, 1, '2021-01-17 17:30:53'),
(8, 'hello !', 14, 1, '2021-01-17 17:31:44'),
(18, 'hello !', 1, 5, '2021-01-23 09:13:56'),
(19, 'Je ne comprends pas. Personne ne vous empêche de lancer un document HTML dans le Bloc-notes et d\'envoyer le résultat par FTP sur un serveur Web, si c\'est tout ce dont vous avez besoin.', 6, 5, '2021-01-23 14:03:40'),
(20, 'Les grands frameworks cachent la complexité et permettent aux développeurs de créer rapidement de nouvelles choses. Par exemple, regardez l\'impact qu\'a eu Ruby on Rails lors de son introduction. Ce qui a pris des heures à configurer et à coder pourrait se résumer à quelques commandes:', 6, 6, '2021-01-23 14:20:42'),
(21, 'Merci pour le tuyau! ', 5, 6, '2021-01-23 14:21:51'),
(22, 'Super article, Python rules!', 4, 6, '2021-01-23 14:22:11'),
(23, 'Je viens de lire les deux premières parties qui sont actuellement publiées. Je dois dire que Python étant la 5ème langue dans laquelle je me plonge, j\'apprécie vraiment ce style d\'enseignement! Il est difficile de trouver du matériel pédagogique qui ne commence pas par «qu\'est-ce qu\'une variable» lol.  Partagez si vous avez des ressources pour les personnes qui utilisent Python qui ne sont pas novices en programmation. :)', 3, 6, '2021-01-23 14:23:06'),
(24, '83% des sites Web ne correspondent pas à 83% du Web utilisé. En regardant la méthodologie, les sites ne sont pas pondérés par le classement Alexa, donc de nombreux petits sites CMS basés sur les mêmes packages PHP peuvent fausser les résultats.', 2, 6, '2021-01-23 14:25:06'),
(25, 'Bonne petite intro!', 1, 6, '2021-01-23 14:27:00'),
(26, 'Ce sont deux mondes séparés. Je pense que c\'est un choix d\'habitude.  Je programme en PHP depuis 2003.  Puis Rails. Puis Node.JS.  Tous sont différents. Ils peuvent être utilisés aux mêmes fins, mais chacun d\'eux a ses propres avantages et inconvénients.  Personne ne vous refusera d\'utiliser une pile de technologies dans votre travail.  Et si vous ne faites pas de grands projets évolutifs, la différence de performances entre ces langages n\'est pas si perceptible.', 7, 5, '2021-01-23 14:31:30'),
(27, 'Je n\'ai pas beaucoup joué avec Node, mais j\'ai eu le sentiment, corrigez-moi si je me trompe, PHP exécute chaque requête indépendamment, donc casser le code sur une URL n\'affectera pas les autres visiteurs, tandis que sur le projet Node, vous pourriez planter le tout service, et devrait-il le redémarrer pour que l\'ensemble du site / de l\'application soit à nouveau disponible?', 7, 7, '2021-01-23 14:32:09'),
(28, 'Vous pouvez créer des micro-services avec nodejs afin que si l\'un d\'entre eux plante, ils ne plantent pas tous.', 7, 6, '2021-01-23 14:33:56'),
(29, 'Les deux réponses au commentaire d\'origine sont des solutions de contournement. PHP fournit cela directement, tandis qu\'avec Node.js, vous devez créer une architecture autour de la gestion de tels cas.', 7, 6, '2021-01-23 14:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'moderateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'tutu', '$2y$10$RLqhi8wG8o6wa6VwPreR2eieyOeZuZi8rHYK7cvo8YAtBtTLiHvoK', 'tutu', 1),
(2, 'tata', '$2y$10$k0hur2mh.rpmNGo7eUtQZuXrd51SqOC45TBPimFTuhxdg6qZO3l4K', 'tata', 1),
(3, 'riri', '$2y$10$NOTwlfc4W/zqJQE3ldOfuOCS3KzpYnkzW53VhpQBmNOQNCvDOM9g6', 'riri', 1),
(5, 'Emka', '$2y$10$HEK8wEUuNIeco2NrAghvMeG.WTHS5a/IS98OfTrORjFZjKnraGCFm', 'emma@emma.com', 42),
(6, 'VonOtto', '$2y$10$jaLrSR45cBKZ.OLRT84mNe.zEHS043iJHKAPB1LsyelvoBpMjhrnG', 'vincent@vincent.com', 42),
(7, 'Nico', '$2y$10$GErCJBjnECJjZLjaQV/CSOpGtOcYgrgCstxu6a8rltlzrolT7t4S.', 'nico@nico.com', 1337);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
