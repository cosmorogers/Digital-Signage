<?php



/**
 * This class defines the structure of the 'display_message' table.
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
class DisplayMessageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.DisplayMessageTableMap';

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
        $this->setName('display_message');
        $this->setPhpName('DisplayMessage');
        $this->setClassname('DisplayMessage');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('display_id', 'DisplayId', 'INTEGER' , 'display', 'id', true, null, null);
        $this->addForeignPrimaryKey('message_id', 'MessageId', 'INTEGER' , 'message', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Display', 'Display', RelationMap::MANY_TO_ONE, array('display_id' => 'id', ), null, null);
        $this->addRelation('Message', 'Message', RelationMap::MANY_TO_ONE, array('message_id' => 'id', ), null, null);
    } // buildRelations()

} // DisplayMessageTableMap
