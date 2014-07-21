<?php



/**
 * This class defines the structure of the 'message' table.
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
class MessageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.MessageTableMap';

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
        $this->setName('message');
        $this->setPhpName('Message');
        $this->setClassname('Message');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'user', 'id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('author', 'Author', 'VARCHAR', true, 255, null);
        $this->addColumn('message', 'Message', 'LONGVARCHAR', true, null, null);
        $this->addColumn('start', 'Start', 'DATE', true, null, null);
        $this->addColumn('end', 'End', 'DATE', true, null, null);
        // validators
        $this->addValidator('title', 'required', 'propel.validator.RequiredValidator', '', 'Title is required.');
        $this->addValidator('title', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Title can be no larger than 255 charactors in length');
        $this->addValidator('author', 'required', 'propel.validator.RequiredValidator', '', 'Author is required.');
        $this->addValidator('author', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Author can be no larger than 255 charactors in length');
        $this->addValidator('message', 'required', 'propel.validator.RequiredValidator', '', 'Message is required.');
        $this->addValidator('message', 'maxLength', 'propel.validator.MaxLengthValidator', '500', 'Message can be no larger than 500 charactors in length');
        $this->addValidator('start', 'required', 'propel.validator.RequiredValidator', '', 'Start date is required.');
        $this->addValidator('end', 'required', 'propel.validator.RequiredValidator', '', 'End date is required.');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
        $this->addRelation('ScreenMessage', 'ScreenMessage', RelationMap::ONE_TO_MANY, array('id' => 'message_id', ), 'CASCADE', null, 'ScreenMessages');
        $this->addRelation('Screen', 'Screen', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Screens');
    } // buildRelations()

} // MessageTableMap
