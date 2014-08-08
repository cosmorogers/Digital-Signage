<?php



/**
 * This class defines the structure of the 'template_widget' table.
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
class TemplateWidgetTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.TemplateWidgetTableMap';

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
        $this->setName('template_widget');
        $this->setPhpName('TemplateWidget');
        $this->setClassname('TemplateWidget');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('template_id', 'TemplateId', 'INTEGER', 'template', 'id', false, null, null);
        $this->addForeignKey('widget_name', 'WidgetName', 'VARCHAR', 'widget', 'name', false, 25, null);
        $this->addColumn('container', 'Container', 'VARCHAR', false, 100, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Template', 'Template', RelationMap::MANY_TO_ONE, array('template_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Widget', 'Widget', RelationMap::MANY_TO_ONE, array('widget_name' => 'name', ), null, null);
    } // buildRelations()

} // TemplateWidgetTableMap
