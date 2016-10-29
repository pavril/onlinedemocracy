CREATE TABLE `likes` (
  `like_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  `comment_id` INT NOT NULL COMMENT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`)  COMMENT '',
  UNIQUE INDEX `like_id_UNIQUE` (`like_id` ASC)  COMMENT '',
  INDEX `fk_likes_users_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_likes_comments_idx` (`comment_id` ASC)  COMMENT '',
  CONSTRAINT `fk_likes_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_comments`
    FOREIGN KEY (`comment_id`)
    REFERENCES `comments` (`commentId`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION);
