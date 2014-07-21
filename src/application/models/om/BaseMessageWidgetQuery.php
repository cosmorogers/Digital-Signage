<?php


/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'widget' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator..om
 */
class BaseMessageWidgetQuery extends WidgetQuery {

    /**
     * Returns a new MessageWidgetQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return MessageWidgetQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MessageWidgetQuery) {
            return $criteria;
        }
        $query = new MessageWidgetQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Filters the query to target only MessageWidget objects.
     */
    public function preSelect(PropelPDO $con)
    {
        $this->addUsingAlias(WidgetPeer::CLASS_KEY, WidgetPeer::CLASSKEY_2);
    }

    /**
     * Filters the query to target only MessageWidget objects.
     */
    public function preUpdate(&$values, PropelPDO $con, $forceIndividualSaves = false)
    {
        $this->addUsingAlias(WidgetPeer::CLASS_KEY, WidgetPeer::CLASSKEY_2);
    }

    /**
     * Filters the query to target only MessageWidget objects.
     */
    public function preDelete(PropelPDO $con)
    {
        $this->addUsingAlias(WidgetPeer::CLASS_KEY, WidgetPeer::CLASSKEY_2);
    }

    /**
     * Issue a DELETE query based on the current ModelCriteria deleting all rows in the table
     * Having the MessageWidget class.
     * This method is called by ModelCriteria::deleteAll() inside a transaction
     *
     * @param PropelPDO $con a connection object
     *
     * @return integer the number of deleted rows
     */
    public function doDeleteAll($con)
    {
        // condition on class key is already added in preDelete()
        return parent::doDelete($con);
    }


    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object
     *
     * @param PropelPDO $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     *
     * @throws PropelException
     */
    public function findOneOrCreate($con = null)
    {
        if ($this->joins) {
            throw new PropelException('findOneOrCreate() cannot be used on a query with a join, because Propel cannot transform a SQL JOIN into a subquery. You should split the query in two queries to avoid joins.');
        }
        if (!$ret = $this->findOne($con)) {
            $class = WidgetPeer::CLASSNAME_2;
            $obj = new $class;
            foreach ($this->keys() as $key) {
                $obj->setByName($key, $this->getValue($key), BasePeer::TYPE_COLNAME);
            }
            $ret = $this->getFormatter()->formatRecord($obj);
        }

        return $ret;
    }

} // BaseMessageWidgetQuery
