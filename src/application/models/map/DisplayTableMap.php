<?php



/**
 * This class defines the structure of the 'display' table.
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
class DisplayTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.DisplayTableMap';

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
        $this->setName('display');
        $this->setPhpName('Display');
        $this->setClassname('Display');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('ip', 'Ip', 'VARCHAR', true, 24, null);
        $this->addColumn('key', 'Key', 'INTEGER', true, null, null);
        $this->addColumn('width', 'Width', 'INTEGER', true, null, null);
        $this->addColumn('height', 'Height', 'INTEGER', true, null, null);
        $this->addColumn('last_seen', 'LastSeen', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DisplayMessage', 'DisplayMessage', RelationMap::ONE_TO_MANY, array('id' => 'display_id', ), null, null, 'DisplayMessages');
        $this->addRelation('Message', 'Message', RelationMap::MANY_TO_MANY, array(), null, null, 'Messages');
    } // buildRelations()

} // DisplayTableMap
