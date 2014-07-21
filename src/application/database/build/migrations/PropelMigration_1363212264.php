<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1363212264.
 * Generated on 2013-03-13 22:04:24 by chris
 */
class PropelMigration_1363212264
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

ALTER TABLE `screen_message` DROP FOREIGN KEY `screen_message_FK_1`;

ALTER TABLE `screen_message` DROP FOREIGN KEY `screen_message_FK_2`;

ALTER TABLE `screen_message` ADD CONSTRAINT `screen_message_FK_1`
    FOREIGN KEY (`screen_id`)
    REFERENCES `screen` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `screen_message` ADD CONSTRAINT `screen_message_FK_2`
    FOREIGN KEY (`message_id`)
    REFERENCES `message` (`id`)
    ON DELETE CASCADE;

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

ALTER TABLE `screen_message` DROP FOREIGN KEY `screen_message_FK_1`;

ALTER TABLE `screen_message` DROP FOREIGN KEY `screen_message_FK_2`;

ALTER TABLE `screen_message` ADD CONSTRAINT `screen_message_FK_1`
    FOREIGN KEY (`screen_id`)
    REFERENCES `screen` (`id`);

ALTER TABLE `screen_message` ADD CONSTRAINT `screen_message_FK_2`
    FOREIGN KEY (`message_id`)
    REFERENCES `message` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}