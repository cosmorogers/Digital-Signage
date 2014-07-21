<?php



/**
 * This class defines the structure of the 'slideshow_image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class SlideshowImageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.SlideshowImageTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('slideshow_image');
        $this->setPhpName('SlideshowImage');
        $this->setClassname('SlideshowImage');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('slideshow_id', 'SlideshowId', 'INTEGER' , 'slideshow', 'id', true, null, null);
        $this->addForeignPrimaryKey('image_id', 'ImageId', 'INTEGER' , 'image', 'id', true, null, null);
        $this->addPrimaryKey('order', 'Order', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Slideshow', 'Slideshow', RelationMap::MANY_TO_ONE, array('slideshow_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Image', 'Image', RelationMap::MANY_TO_ONE, array('image_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // SlideshowImageTableMap
