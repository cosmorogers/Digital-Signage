<?php



/**
 * This class defines the structure of the 'screen' table.
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
class ScreenTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ScreenTableMap';

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
        $this->setName('screen');
        $this->setPhpName('Screen');
        $this->setClassname('Screen');
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
        $this->addColumn('mac', 'Mac', 'VARCHAR', true, 24, null);
        $this->addForeignKey('template_id', 'TemplateId', 'INTEGER', 'template', 'id', true, null, null);
        // validators
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'Name is required.');
        $this->addValidator('name', 'maxLength', 'propel.validator.MaxLengthValidator', '255', 'Name can be no larger than 255 charactors in length');
        $this->addValidator('ip', 'required', 'propel.validator.RequiredValidator', '', 'IP address is required.');
        $this->addValidator('ip', 'class', 'application.libraries.propel.validator.IpValidator', '', 'IP address must be a valid IP address (IPv4 or IPv6).');
        $this->addValidator('mac', 'required', 'propel.validator.RequiredValidator', '', 'MAC address is required.');
        $this->addValidator('mac', 'class', 'application.libraries.propel.validator.MacValidator', '', 'MAC address must be a valid MAC address, seperated with a colon (:).');
        $this->addValidator('width', 'type', 'propel.validator.TypeValidator', 'integer', 'Width must be an integer.');
        $this->addValidator('height', 'type', 'propel.validator.TypeValidator', 'integer', 'Height must be an integer.');
        $this->addValidator('template_id', 'required', 'propel.validator.RequiredValidator', '', 'A Template for this screen to use is required');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Template', 'Template', RelationMap::MANY_TO_ONE, array('template_id' => 'id', ), null, null);
        $this->addRelation('ScreenMessage', 'ScreenMessage', RelationMap::ONE_TO_MANY, array('id' => 'screen_id', ), 'CASCADE', null, 'ScreenMessages');
        $this->addRelation('Message', 'Message', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Messages');
    } // buildRelations()

} // ScreenTableMap
