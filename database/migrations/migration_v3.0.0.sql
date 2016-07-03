CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `propositions_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposition_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propositions_tags_propositions_idx` (`proposition_id`),
  KEY `fk_propositions_tags_tags_idx` (`tag_id`),
  CONSTRAINT `fk_propositions_tags_propositions` FOREIGN KEY (`proposition_id`) REFERENCES `propositions` (`propositionId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_propositions_tags_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;