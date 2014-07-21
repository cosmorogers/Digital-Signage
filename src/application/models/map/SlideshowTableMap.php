<?php



/**
 * This class defines the structure of the 'slideshow' table.
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
class SlideshowTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.SlideshowTableMap';

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
        $this->setName('slideshow');
        $this->setPhpName('Slideshow');
        $this->setClassname('Slideshow');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('width', 'Width', 'INTEGER', true, null, null);
        $this->addColumn('height', 'Height', 'INTEGER', true, null, null);
        $this->addColumn('delay', 'Delay', 'INTEGER', true, null, null);
        $this->addColumn('effect', 'Effect', 'ENUM', true, null, null);
        $this->getColumn('effect', false)->setValueSet(array (
  0 => 'blindX',
  1 => 'blindY',
  2 => 'blindZ',
  3 => 'cover',
  4 => 'curtainX',
  5 => 'curtainY',
  6 => 'fade',
  7 => 'fadeZoom',
  8 => 'growX',
  9 => 'growY',
  10 => 'none',
  11 => 'scrollUp',
  12 => 'scrollDown',
  13 => 'scrollLeft',
  14 => 'scrollRight',
  15 => 'scrollHorz',
  16 => 'scrollVert',
  17 => 'shuffle',
  18 => 'slideX',
  19 => 'slideY',
  20 => 'toss',
  21 => 'turnUp',
  22 => 'turnDown',
  23 => 'turnLeft',
  24 => 'turnRight',
  25 => 'uncover',
  26 => 'wipe',
  27 => 'zoom',
));
        // validators
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'Name is required.');
        $this->addValidator('width', 'required', 'propel.validator.RequiredValidator', '', 'Width is required.');
        $this->addValidator('width', 'type', 'propel.validator.TypeValidator', 'integer', 'Width must be a number');
        $this->addValidator('width', 'minValue', 'propel.validator.MinValueValidator', '0', 'Width cannot be negative');
        $this->addValidator('height', 'required', 'propel.validator.RequiredValidator', '', 'Height is required.');
        $this->addValidator('height', 'type', 'propel.validator.TypeValidator', 'integer', 'Height must be a number');
        $this->addValidator('height', 'minValue', 'propel.validator.MinValueValidator', '0', 'Height cannot be negative');
        $this->addValidator('delay', 'required', 'propel.validator.RequiredValidator', '', 'Delay is required.');
        $this->addValidator('delay', 'type', 'propel.validator.TypeValidator', 'integer', 'Delay must be a number');
        $this->addValidator('delay', 'minValue', 'propel.validator.MinValueValidator', '0', 'Delay cannot be negative');
        $this->addValidator('effect', 'required', 'propel.validator.RequiredValidator', '', 'Effect is required.');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SlideshowImage', 'SlideshowImage', RelationMap::ONE_TO_MANY, array('id' => 'slideshow_id', ), 'CASCADE', null, 'SlideshowImages');
        $this->addRelation('Image', 'Image', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Images');
    } // buildRelations()

} // SlideshowTableMap
