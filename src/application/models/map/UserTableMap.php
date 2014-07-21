<?php



/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.UserTableMap';

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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('User');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 254, null);
        $this->addColumn('use_ad', 'UseAd', 'BOOLEAN', true, 1, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 254, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 254, null);
        // validators
        $this->addValidator('username', 'required', 'propel.validator.RequiredValidator', '', 'Username is required.');
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'Name is required.');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Message', 'Message', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Messages');
        $this->addRelation('Image', 'Image', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'Images');
    } // buildRelations()

} // UserTableMap
