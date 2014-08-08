<?php


/**
 * Base class that represents a query for the 'template_widget' table.
 *
 *
 *
 * @method TemplateWidgetQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TemplateWidgetQuery orderByTemplateId($order = Criteria::ASC) Order by the template_id column
 * @method TemplateWidgetQuery orderByWidgetName($order = Criteria::ASC) Order by the widget_name column
 * @method TemplateWidgetQuery orderByContainer($order = Criteria::ASC) Order by the container column
 * @method TemplateWidgetQuery orderByData($order = Criteria::ASC) Order by the data column
 *
 * @method TemplateWidgetQuery groupById() Group by the id column
 * @method TemplateWidgetQuery groupByTemplateId() Group by the template_id column
 * @method TemplateWidgetQuery groupByWidgetName() Group by the widget_name column
 * @method TemplateWidgetQuery groupByContainer() Group by the container column
 * @method TemplateWidgetQuery groupByData() Group by the data column
 *
 * @method TemplateWidgetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TemplateWidgetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TemplateWidgetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TemplateWidgetQuery leftJoinTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Template relation
 * @method TemplateWidgetQuery rightJoinTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Template relation
 * @method TemplateWidgetQuery innerJoinTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the Template relation
 *
 * @method TemplateWidgetQuery leftJoinWidget($relationAlias = null) Adds a LEFT JOIN clause to the query using the Widget relation
 * @method TemplateWidgetQuery rightJoinWidget($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Widget relation
 * @method TemplateWidgetQuery innerJoinWidget($relationAlias = null) Adds a INNER JOIN clause to the query using the Widget relation
 *
 * @method TemplateWidget findOne(PropelPDO $con = null) Return the first TemplateWidget matching the query
 * @method TemplateWidget findOneOrCreate(PropelPDO $con = null) Return the first TemplateWidget matching the query, or a new TemplateWidget object populated from the query conditions when no match is found
 *
 * @method TemplateWidget findOneByTemplateId(int $template_id) Return the first TemplateWidget filtered by the template_id column
 * @method TemplateWidget findOneByWidgetName(string $widget_name) Return the first TemplateWidget filtered by the widget_name column
 * @method TemplateWidget findOneByContainer(string $container) Return the first TemplateWidget filtered by the container column
 * @method TemplateWidget findOneByData(string $data) Return the first TemplateWidget filtered by the data column
 *
 * @method array findById(int $id) Return TemplateWidget objects filtered by the id column
 * @method array findByTemplateId(int $template_id) Return TemplateWidget objects filtered by the template_id column
 * @method array findByWidgetName(string $widget_name) Return TemplateWidget objects filtered by the widget_name column
 * @method array findByContainer(string $container) Return TemplateWidget objects filtered by the container column
 * @method array findByData(string $data) Return TemplateWidget objects filtered by the data column
 *
 * @package    propel.generator..om
 */
abstract class BaseTemplateWidgetQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTemplateWidgetQuery object.
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
            $modelName = 'TemplateWidget';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TemplateWidgetQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TemplateWidgetQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TemplateWidgetQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TemplateWidgetQuery) {
            return $criteria;
        }
        $query = new TemplateWidgetQuery(null, null, $modelAlias);

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
     * @return   TemplateWidget|TemplateWidget[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TemplateWidgetPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TemplateWidgetPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TemplateWidget A model object, or null if the key is not found
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
     * @return                 TemplateWidget A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `template_id`, `widget_name`, `container`, `data` FROM `template_widget` WHERE `id` = :p0';
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
            $obj = new TemplateWidget();
            $obj->hydrate($row);
            TemplateWidgetPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TemplateWidget|TemplateWidget[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TemplateWidget[]|mixed the list of results, formatted by the current formatter
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
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TemplateWidgetPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TemplateWidgetPeer::ID, $keys, Criteria::IN);
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
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TemplateWidgetPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TemplateWidgetPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TemplateWidgetPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the template_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateId(1234); // WHERE template_id = 1234
     * $query->filterByTemplateId(array(12, 34)); // WHERE template_id IN (12, 34)
     * $query->filterByTemplateId(array('min' => 12)); // WHERE template_id >= 12
     * $query->filterByTemplateId(array('max' => 12)); // WHERE template_id <= 12
     * </code>
     *
     * @see       filterByTemplate()
     *
     * @param     mixed $templateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByTemplateId($templateId = null, $comparison = null)
    {
        if (is_array($templateId)) {
            $useMinMax = false;
            if (isset($templateId['min'])) {
                $this->addUsingAlias(TemplateWidgetPeer::TEMPLATE_ID, $templateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($templateId['max'])) {
                $this->addUsingAlias(TemplateWidgetPeer::TEMPLATE_ID, $templateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TemplateWidgetPeer::TEMPLATE_ID, $templateId, $comparison);
    }

    /**
     * Filter the query on the widget_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWidgetName('fooValue');   // WHERE widget_name = 'fooValue'
     * $query->filterByWidgetName('%fooValue%'); // WHERE widget_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $widgetName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByWidgetName($widgetName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($widgetName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $widgetName)) {
                $widgetName = str_replace('*', '%', $widgetName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TemplateWidgetPeer::WIDGET_NAME, $widgetName, $comparison);
    }

    /**
     * Filter the query on the container column
     *
     * Example usage:
     * <code>
     * $query->filterByContainer('fooValue');   // WHERE container = 'fooValue'
     * $query->filterByContainer('%fooValue%'); // WHERE container LIKE '%fooValue%'
     * </code>
     *
     * @param     string $container The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByContainer($container = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($container)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $container)) {
                $container = str_replace('*', '%', $container);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TemplateWidgetPeer::CONTAINER, $container, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%'); // WHERE data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $data)) {
                $data = str_replace('*', '%', $data);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TemplateWidgetPeer::DATA, $data, $comparison);
    }

    /**
     * Filter the query by a related Template object
     *
     * @param   Template|PropelObjectCollection $template The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TemplateWidgetQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplate($template, $comparison = null)
    {
        if ($template instanceof Template) {
            return $this
                ->addUsingAlias(TemplateWidgetPeer::TEMPLATE_ID, $template->getId(), $comparison);
        } elseif ($template instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TemplateWidgetPeer::TEMPLATE_ID, $template->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTemplate() only accepts arguments of type Template or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Template relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function joinTemplate($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Template');

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
            $this->addJoinObject($join, 'Template');
        }

        return $this;
    }

    /**
     * Use the Template relation Template object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TemplateQuery A secondary query class using the current class as primary query
     */
    public function useTemplateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Template', 'TemplateQuery');
    }

    /**
     * Filter the query by a related Widget object
     *
     * @param   Widget|PropelObjectCollection $widget The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TemplateWidgetQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByWidget($widget, $comparison = null)
    {
        if ($widget instanceof Widget) {
            return $this
                ->addUsingAlias(TemplateWidgetPeer::WIDGET_NAME, $widget->getName(), $comparison);
        } elseif ($widget instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TemplateWidgetPeer::WIDGET_NAME, $widget->toKeyValue('PrimaryKey', 'Name'), $comparison);
        } else {
            throw new PropelException('filterByWidget() only accepts arguments of type Widget or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Widget relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function joinWidget($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Widget');

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
            $this->addJoinObject($join, 'Widget');
        }

        return $this;
    }

    /**
     * Use the Widget relation Widget object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   WidgetQuery A secondary query class using the current class as primary query
     */
    public function useWidgetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWidget($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Widget', 'WidgetQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TemplateWidget $templateWidget Object to remove from the list of results
     *
     * @return TemplateWidgetQuery The current query, for fluid interface
     */
    public function prune($templateWidget = null)
    {
        if ($templateWidget) {
            $this->addUsingAlias(TemplateWidgetPeer::ID, $templateWidget->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
