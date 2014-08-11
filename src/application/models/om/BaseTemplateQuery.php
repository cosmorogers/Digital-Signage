<?php


/**
 * Base class that represents a query for the 'template' table.
 *
 *
 *
 * @method TemplateQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TemplateQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method TemplateQuery orderByLayout($order = Criteria::ASC) Order by the layout column
 *
 * @method TemplateQuery groupById() Group by the id column
 * @method TemplateQuery groupByName() Group by the name column
 * @method TemplateQuery groupByLayout() Group by the layout column
 *
 * @method TemplateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TemplateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TemplateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TemplateQuery leftJoinScreen($relationAlias = null) Adds a LEFT JOIN clause to the query using the Screen relation
 * @method TemplateQuery rightJoinScreen($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Screen relation
 * @method TemplateQuery innerJoinScreen($relationAlias = null) Adds a INNER JOIN clause to the query using the Screen relation
 *
 * @method TemplateQuery leftJoinTemplateWidget($relationAlias = null) Adds a LEFT JOIN clause to the query using the TemplateWidget relation
 * @method TemplateQuery rightJoinTemplateWidget($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TemplateWidget relation
 * @method TemplateQuery innerJoinTemplateWidget($relationAlias = null) Adds a INNER JOIN clause to the query using the TemplateWidget relation
 *
 * @method Template findOne(PropelPDO $con = null) Return the first Template matching the query
 * @method Template findOneOrCreate(PropelPDO $con = null) Return the first Template matching the query, or a new Template object populated from the query conditions when no match is found
 *
 * @method Template findOneByName(string $name) Return the first Template filtered by the name column
 * @method Template findOneByLayout(string $layout) Return the first Template filtered by the layout column
 *
 * @method array findById(int $id) Return Template objects filtered by the id column
 * @method array findByName(string $name) Return Template objects filtered by the name column
 * @method array findByLayout(string $layout) Return Template objects filtered by the layout column
 *
 * @package    propel.generator..om
 */
abstract class BaseTemplateQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTemplateQuery object.
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
            $modelName = 'Template';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TemplateQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TemplateQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TemplateQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TemplateQuery) {
            return $criteria;
        }
        $query = new TemplateQuery(null, null, $modelAlias);

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
     * @return   Template|Template[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TemplatePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TemplatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Template A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
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
     * @return                 Template A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `layout` FROM `template` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Template();
            $obj->hydrate($row);
            TemplatePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Template|Template[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Template[]|mixed the list of results, formatted by the current formatter
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
     * @return TemplateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TemplatePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TemplateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TemplatePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TemplatePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TemplatePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TemplatePeer::ID, $id, $comparison);
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
     * @return TemplateQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TemplatePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the layout column
     *
     * Example usage:
     * <code>
     * $query->filterByLayout('fooValue');   // WHERE layout = 'fooValue'
     * $query->filterByLayout('%fooValue%'); // WHERE layout LIKE '%fooValue%'
     * </code>
     *
     * @param     string $layout The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateQuery The current query, for fluid interface
     */
    public function filterByLayout($layout = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($layout)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $layout)) {
                $layout = str_replace('*', '%', $layout);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TemplatePeer::LAYOUT, $layout, $comparison);
    }

    /**
     * Filter the query by a related Screen object
     *
     * @param   Screen|PropelObjectCollection $screen  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TemplateQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByScreen($screen, $comparison = null)
    {
        if ($screen instanceof Screen) {
            return $this
                ->addUsingAlias(TemplatePeer::ID, $screen->getTemplateId(), $comparison);
        } elseif ($screen instanceof PropelObjectCollection) {
            return $this
                ->useScreenQuery()
                ->filterByPrimaryKeys($screen->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByScreen() only accepts arguments of type Screen or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Screen relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TemplateQuery The current query, for fluid interface
     */
    public function joinScreen($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Screen');

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
            $this->addJoinObject($join, 'Screen');
        }

        return $this;
    }

    /**
     * Use the Screen relation Screen object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ScreenQuery A secondary query class using the current class as primary query
     */
    public function useScreenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScreen($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Screen', 'ScreenQuery');
    }

    /**
     * Filter the query by a related TemplateWidget object
     *
     * @param   TemplateWidget|PropelObjectCollection $templateWidget  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TemplateQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplateWidget($templateWidget, $comparison = null)
    {
        if ($templateWidget instanceof TemplateWidget) {
            return $this
                ->addUsingAlias(TemplatePeer::ID, $templateWidget->getTemplateId(), $comparison);
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
     * @return TemplateQuery The current query, for fluid interface
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
     * @param   Template $template Object to remove from the list of results
     *
     * @return TemplateQuery The current query, for fluid interface
     */
    public function prune($template = null)
    {
        if ($template) {
            $this->addUsingAlias(TemplatePeer::ID, $template->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
