<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1407501488.
 * Generated on 2014-08-08 13:38:08 by chris
 */
class PropelMigration_1407501488
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

ALTER TABLE `screen`
    ADD `template_id` INTEGER NOT NULL AFTER `mac`;

CREATE INDEX `screen_FI_1` ON `screen` (`template_id`);

ALTER TABLE `screen` ADD CONSTRAINT `screen_FK_1`
    FOREIGN KEY (`template_id`)
    REFERENCES `template` (`id`);

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

ALTER TABLE `screen` DROP FOREIGN KEY `screen_FK_1`;

DROP INDEX `screen_FI_1` ON `screen`;

ALTER TABLE `screen` DROP `template_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}