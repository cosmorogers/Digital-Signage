<?php


/**
 * Base class that represents a query for the 'widget' table.
 *
 *
 *
 * @method WidgetQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method WidgetQuery groupByName() Group by the name column
 *
 * @method WidgetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method WidgetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method WidgetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method WidgetQuery leftJoinTemplateWidget($relationAlias = null) Adds a LEFT JOIN clause to the query using the TemplateWidget relation
 * @method WidgetQuery rightJoinTemplateWidget($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TemplateWidget relation
 * @method WidgetQuery innerJoinTemplateWidget($relationAlias = null) Adds a INNER JOIN clause to the query using the TemplateWidget relation
 *
 * @method Widget findOne(PropelPDO $con = null) Return the first Widget matching the query
 * @method Widget findOneOrCreate(PropelPDO $con = null) Return the first Widget matching the query, or a new Widget object populated from the query conditions when no match is found
 *
 *
 * @method array findByName(string $name) Return Widget objects filtered by the name column
 *
 * @package    propel.generator..om
 */
abstract class BaseWidgetQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseWidgetQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'signage';
        }
        if (null === $modelName) {
            $modelName = 'Widget';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new WidgetQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   WidgetQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return WidgetQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof WidgetQuery) {
            return $criteria;
        }
        $query = new WidgetQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Widget|Widget[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WidgetPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(WidgetPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Widget A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByName($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Widget A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `name` FROM `widget` WHERE `name` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Widget();
            $obj->hydrate($row);
            WidgetPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Widget|Widget[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Widget[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WidgetPeer::NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WidgetPeer::NAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WidgetPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related TemplateWidget object
     *
     * @param   TemplateWidget|PropelObjectCollection $templateWidget  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 WidgetQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplateWidget($templateWidget, $comparison = null)
    {
        if ($templateWidget instanceof TemplateWidget) {
            return $this
                ->addUsingAlias(WidgetPeer::NAME, $templateWidget->getWidgetName(), $comparison);
        } elseif ($templateWidget instanceof PropelObjectCollection) {
            return $this
                ->useTemplateWidgetQuery()
                ->filterByPrimaryKeys($templateWidget->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTemplateWidget() only accepts arguments of type TemplateWidget or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TemplateWidget relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function joinTemplateWidget($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TemplateWidget');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TemplateWidget');
        }

        return $this;
    }

    /**
     * Use the TemplateWidget relation TemplateWidget object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TemplateWidgetQuery A secondary query class using the current class as primary query
     */
    public function useTemplateWidgetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTemplateWidget($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TemplateWidget', 'TemplateWidgetQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Widget $widget Object to remove from the list of results
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function prune($widget = null)
    {
        if ($widget) {
            $this->addUsingAlias(WidgetPeer::NAME, $widget->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
