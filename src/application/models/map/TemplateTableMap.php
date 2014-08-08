<?php



/**
 * This class defines the structure of the 'template' table.
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
class TemplateTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.TemplateTableMap';

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
        $this->setName('template');
        $this->setPhpName('Template');
        $this->setClassname('Template');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('layout', 'Layout', 'VARCHAR', true, 100, null);
        // validators
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'Name is required.');
        $this->addValidator('layout', 'required', 'propel.validator.RequiredValidator', '', 'A layout is required.');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TemplateWidget', 'TemplateWidget', RelationMap::ONE_TO_MANY, array('id' => 'template_id', ), 'CASCADE', null, 'TemplateWidgets');
    } // buildRelations()

} // TemplateTableMap
