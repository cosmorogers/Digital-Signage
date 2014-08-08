
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- screen
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `screen`;

CREATE TABLE `screen`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `ip` VARCHAR(24) NOT NULL,
    `key` INTEGER NOT NULL,
    `width` INTEGER NOT NULL,
    `height` INTEGER NOT NULL,
    `last_seen` DATETIME,
    `mac` VARCHAR(24) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `created_at` DATETIME NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `author` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `start` DATE NOT NULL,
    `end` DATE NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `message_FI_1` (`user_id`),
    CONSTRAINT `message_FK_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- screen_message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `screen_message`;

CREATE TABLE `screen_message`
(
    `screen_id` INTEGER NOT NULL,
    `message_id` INTEGER NOT NULL,
    PRIMARY KEY (`screen_id`,`message_id`),
    INDEX `screen_message_FI_2` (`message_id`),
    CONSTRAINT `screen_message_FK_1`
        FOREIGN KEY (`screen_id`)
        REFERENCES `screen` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `screen_message_FK_2`
        FOREIGN KEY (`message_id`)
        REFERENCES `message` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(254) NOT NULL,
    `use_ad` TINYINT(1) NOT NULL,
    `password` VARCHAR(254),
    `name` VARCHAR(254) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- slideshow
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `slideshow`;

CREATE TABLE `slideshow`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `width` INTEGER NOT NULL,
    `height` INTEGER NOT NULL,
    `delay` INTEGER NOT NULL,
    `effect` TINYINT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `filename` VARCHAR(100) NOT NULL,
    `date` DATETIME NOT NULL,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `image_FI_1` (`user_id`),
    CONSTRAINT `image_FK_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- slideshow_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `slideshow_image`;

CREATE TABLE `slideshow_image`
(
    `slideshow_id` INTEGER NOT NULL,
    `image_id` INTEGER NOT NULL,
    `order` INTEGER NOT NULL,
    PRIMARY KEY (`slideshow_id`,`image_id`,`order`),
    INDEX `slideshow_image_FI_2` (`image_id`),
    CONSTRAINT `slideshow_image_FK_1`
        FOREIGN KEY (`slideshow_id`)
        REFERENCES `slideshow` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `slideshow_image_FK_2`
        FOREIGN KEY (`image_id`)
        REFERENCES `image` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quote
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quote`;

CREATE TABLE `quote`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `quote` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- template
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `template`;

CREATE TABLE `template`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `layout` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- template_widget
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `template_widget`;

CREATE TABLE `template_widget`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `template_id` INTEGER,
    `widget_name` VARCHAR(25),
    `container` VARCHAR(100),
    `data` TEXT,
    PRIMARY KEY (`id`),
    INDEX `template_widget_FI_1` (`template_id`),
    INDEX `template_widget_FI_2` (`widget_name`),
    CONSTRAINT `template_widget_FK_1`
        FOREIGN KEY (`template_id`)
        REFERENCES `template` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `template_widget_FK_2`
        FOREIGN KEY (`widget_name`)
        REFERENCES `widget` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- widget
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `widget`;

CREATE TABLE `widget`
(
    `name` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- temperature
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `temperature`;

CREATE TABLE `temperature`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `location` VARCHAR(25) NOT NULL,
    `time` DATETIME NOT NULL,
    `reading` FLOAT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
