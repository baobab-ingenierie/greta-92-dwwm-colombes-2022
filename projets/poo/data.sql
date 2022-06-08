-- Base de données `singleton`
DROP SCHEMA IF EXISTS singleton ;
CREATE SCHEMA singleton;
USE singleton;

-- Structure de la table `contacts`
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `gender` varchar(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Peuplement de la table `contacts`
INSERT INTO `contacts` (`id`, `fname`, `gender`) 
VALUES
	(1, 'Iheb', 'Masculin'),
	(2, 'Sadou', 'Masculin'),
	(3, 'Raphaële', 'Féminin'),
	(4, 'Yann', 'Masculin'),
	(5, 'Ilyes', 'Masculin'),
	(6, 'Jonathan', 'Masculin'),
	(7, 'Aymane', 'Masculin'),
	(8, 'Ahmad', 'Masculin'),
	(9, 'Inas', 'Féminin'),
	(10, 'Sofiane', 'Masculin'),
	(11, 'Maeliss', 'Féminin'),
	(12, 'Mohamed', 'Masculin'),
	(13, 'Joëlle', 'Féminin'),
	(14, 'Mourad', 'Masculin'),
	(15, 'Fayçal', 'Masculin')
;

-- Indexes dans la table `contacts`
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`)
;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16
;