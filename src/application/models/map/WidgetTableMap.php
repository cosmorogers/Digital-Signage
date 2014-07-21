<?php



/**
 * This class defines the structure of the 'widget' table.
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
class WidgetTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.WidgetTableMap';

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
        $this->setName('widget');
        $this->setPhpName('Widget');
        $this->setClassname('Widget');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setSingleTableInheritance(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('pos_x', 'PosX', 'INTEGER', true, null, null);
        $this->addColumn('pos_y', 'PosY', 'INTEGER', true, null, null);
        $this->addColumn('width', 'Width', 'INTEGER', true, null, null);
        $this->addColumn('height', 'Height', 'INTEGER', true, null, null);
        $this->addColumn('class_key', 'ClassKey', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // WidgetTableMap
