<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1368888022.
 * Generated on 2013-05-18 15:40:22 by chris
 */
class PropelMigration_1368888022
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

ALTER TABLE `slideshow_image` DROP PRIMARY KEY;

ALTER TABLE `slideshow_image`
    ADD `order` INTEGER NOT NULL AFTER `image_id`;

ALTER TABLE `slideshow_image` ADD PRIMARY KEY (`slideshow_id`,`image_id`,`order`);

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

ALTER TABLE `slideshow_image` DROP PRIMARY KEY;

ALTER TABLE `slideshow_image` DROP `order`;

ALTER TABLE `slideshow_image` ADD PRIMARY KEY (`slideshow_id`,`image_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}