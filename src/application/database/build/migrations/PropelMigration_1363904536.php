<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1363904536.
 * Generated on 2013-03-21 22:22:16 by chris
 */
class PropelMigration_1363904536
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'signage' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

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

CREATE TABLE `slideshow_image`
(
    `slideshow_id` INTEGER NOT NULL,
    `image_id` INTEGER NOT NULL,
    PRIMARY KEY (`slideshow_id`,`image_id`),
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'signage' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `slideshow`;

DROP TABLE IF EXISTS `image`;

DROP TABLE IF EXISTS `slideshow_image`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}