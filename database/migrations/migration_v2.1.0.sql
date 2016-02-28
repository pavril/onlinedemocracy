CREATE TABLE `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `decode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `marker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposition_id` int(11) NOT NULL,
  `marker_id` int(11) NOT NULL,
  `marker_text` varchar(240) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marker_propositions_idx` (`proposition_id`),
  KEY `fk_marker_markers_idx` (`marker_id`),
  CONSTRAINT `fk_marker_markers` FOREIGN KEY (`marker_id`) REFERENCES `markers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_marker_propositions` FOREIGN KEY (`proposition_id`) REFERENCES `propositions` (`propositionId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `flags` 
DROP FOREIGN KEY `fk_flags_propositions`;
ALTER TABLE `onlinedemocracy`.`flags` 
ADD CONSTRAINT `fk_flags_propositions`
  FOREIGN KEY (`proposition`)
  REFERENCES `onlinedemocracy`.`propositions` (`propositionId`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;