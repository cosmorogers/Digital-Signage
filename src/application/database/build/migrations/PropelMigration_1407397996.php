<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1407397996.
 * Generated on 2014-08-07 08:53:16 by chris
 */
class PropelMigration_1407397996
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

ALTER TABLE `widget` DROP PRIMARY KEY;

ALTER TABLE `widget`
    ADD `name` VARCHAR(25) NOT NULL FIRST;

ALTER TABLE `widget` DROP `id`;

ALTER TABLE `widget` DROP `pos_id`;

ALTER TABLE `widget` DROP `data`;

ALTER TABLE `widget` DROP `class_key`;

ALTER TABLE `widget` ADD PRIMARY KEY (`name`);

CREATE TABLE `template_widget`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `template_id` INTEGER,
    `widget_name` VARCHAR(25),
    `area` VARCHAR(100),
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

DROP TABLE IF EXISTS `template_widget`;

ALTER TABLE `widget` DROP PRIMARY KEY;

ALTER TABLE `widget`
    ADD `id` INTEGER NOT NULL AUTO_INCREMENT FIRST,
    ADD `pos_id` VARCHAR(20) NOT NULL AFTER `id`,
    ADD `data` TEXT AFTER `pos_id`,
    ADD `class_key` INTEGER AFTER `data`;

ALTER TABLE `widget` DROP `name`;

ALTER TABLE `widget` ADD PRIMARY KEY (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}