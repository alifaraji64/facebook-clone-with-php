CREATE TABLE `social`.`users`
(
    `id` INT NOT NULL AUTO_INCREMENT ,
    `first_name` VARCHAR(25) NOT NULL ,
    `last_name` VARCHAR(25) NOT NULL ,
    `username` VARCHAR(100) NOT NULL ,
    `email` VARCHAR(50) NOT NULL ,
    `password` VARCHAR(255) NOT NULL ,
    `signup_date` DATE NOT NULL ,
    `profile_pic` VARCHAR(255) NOT NULL ,
    `num_posts` INT NOT NULL ,
    `num_likes` INT NOT NULL ,
    `user_closed` VARCHAR(3) NOT NULL ,
    `friend_array` TEXT NOT NULL ,
     PRIMARY KEY (`id`)
     ) ENGINE = InnoDB;
