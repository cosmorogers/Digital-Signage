<?php


/**
 * Base class that represents a query for the 'display' table.
 *
 *
 *
 * @method DisplayQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DisplayQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method DisplayQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method DisplayQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method DisplayQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method DisplayQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method DisplayQuery orderByLastSeen($order = Criteria::ASC) Order by the last_seen column
 *
 * @method DisplayQuery groupById() Group by the id column
 * @method DisplayQuery groupByName() Group by the name column
 * @method DisplayQuery groupByIp() Group by the ip column
 * @method DisplayQuery groupByKey() Group by the key column
 * @method DisplayQuery groupByWidth() Group by the width column
 * @method DisplayQuery groupByHeight() Group by the height column
 * @method DisplayQuery groupByLastSeen() Group by the last_seen column
 *
 * @method DisplayQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DisplayQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DisplayQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DisplayQuery leftJoinDisplayMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the DisplayMessage relation
 * @method DisplayQuery rightJoinDisplayMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DisplayMessage relation
 * @method DisplayQuery innerJoinDisplayMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the DisplayMessage relation
 *
 * @method Display findOne(PropelPDO $con = null) Return the first Display matching the query
 * @method Display findOneOrCreate(PropelPDO $con = null) Return the first Display matching the query, or a new Display object populated from the query conditions when no match is found
 *
 * @method Display findOneByName(string $name) Return the first Display filtered by the name column
 * @method Display findOneByIp(string $ip) Return the first Display filtered by the ip column
 * @method Display findOneByKey(int $key) Return the first Display filtered by the key column
 * @method Display findOneByWidth(int $width) Return the first Display filtered by the width column
 * @method Display findOneByHeight(int $height) Return the first Display filtered by the height column
 * @method Display findOneByLastSeen(string $last_seen) Return the first Display filtered by the last_seen column
 *
 * @method array findById(int $id) Return Display objects filtered by the id column
 * @method array findByName(string $name) Return Display objects filtered by the name column
 * @method array findByIp(string $ip) Return Display objects filtered by the ip column
 * @method array findByKey(int $key) Return Display objects filtered by the key column
 * @method array findByWidth(int $width) Return Display objects filtered by the width column
 * @method array findByHeight(int $height) Return Display objects filtered by the height column
 * @method array findByLastSeen(string $last_seen) Return Display objects filtered by the last_seen column
 *
 * @package    propel.generator..om
 */
abstract class BaseDisplayQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDisplayQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'signage', $modelName = 'Display', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DisplayQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DisplayQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DisplayQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DisplayQuery) {
            return $criteria;
        }
        $query = new DisplayQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
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
     * @return   Display|Display[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DisplayPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DisplayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Display A model object, or null if the key is not found
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
     * @return                 Display A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `ip`, `key`, `width`, `height`, `last_seen` FROM `display` WHERE `id` = :p0';
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
            $obj = new Display();
            $obj->hydrate($row);
            DisplayPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Display|Display[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Display[]|mixed the list of results, formatted by the current formatter
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
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DisplayPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DisplayPeer::ID, $keys, Criteria::IN);
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
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DisplayPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DisplayPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayPeer::ID, $id, $comparison);
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
     * @return DisplayQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DisplayPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DisplayPeer::IP, $ip, $comparison);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey(1234); // WHERE key = 1234
     * $query->filterByKey(array(12, 34)); // WHERE key IN (12, 34)
     * $query->filterByKey(array('min' => 12)); // WHERE key >= 12
     * $query->filterByKey(array('max' => 12)); // WHERE key <= 12
     * </code>
     *
     * @param     mixed $key The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByKey($key = null, $comparison = null)
    {
        if (is_array($key)) {
            $useMinMax = false;
            if (isset($key['min'])) {
                $this->addUsingAlias(DisplayPeer::KEY, $key['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($key['max'])) {
                $this->addUsingAlias(DisplayPeer::KEY, $key['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayPeer::KEY, $key, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE width >= 12
     * $query->filterByWidth(array('max' => 12)); // WHERE width <= 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(DisplayPeer::WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(DisplayPeer::WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayPeer::WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight(1234); // WHERE height = 1234
     * $query->filterByHeight(array(12, 34)); // WHERE height IN (12, 34)
     * $query->filterByHeight(array('min' => 12)); // WHERE height >= 12
     * $query->filterByHeight(array('max' => 12)); // WHERE height <= 12
     * </code>
     *
     * @param     mixed $height The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(DisplayPeer::HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(DisplayPeer::HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the last_seen column
     *
     * Example usage:
     * <code>
     * $query->filterByLastSeen('2011-03-14'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen('now'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen(array('max' => 'yesterday')); // WHERE last_seen > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastSeen The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function filterByLastSeen($lastSeen = null, $comparison = null)
    {
        if (is_array($lastSeen)) {
            $useMinMax = false;
            if (isset($lastSeen['min'])) {
                $this->addUsingAlias(DisplayPeer::LAST_SEEN, $lastSeen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastSeen['max'])) {
                $this->addUsingAlias(DisplayPeer::LAST_SEEN, $lastSeen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayPeer::LAST_SEEN, $lastSeen, $comparison);
    }

    /**
     * Filter the query by a related DisplayMessage object
     *
     * @param   DisplayMessage|PropelObjectCollection $displayMessage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DisplayQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDisplayMessage($displayMessage, $comparison = null)
    {
        if ($displayMessage instanceof DisplayMessage) {
            return $this
                ->addUsingAlias(DisplayPeer::ID, $displayMessage->getDisplayId(), $comparison);
        } elseif ($displayMessage instanceof PropelObjectCollection) {
            return $this
                ->useDisplayMessageQuery()
                ->filterByPrimaryKeys($displayMessage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDisplayMessage() only accepts arguments of type DisplayMessage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DisplayMessage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function joinDisplayMessage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DisplayMessage');

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
            $this->addJoinObject($join, 'DisplayMessage');
        }

        return $this;
    }

    /**
     * Use the DisplayMessage relation DisplayMessage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   DisplayMessageQuery A secondary query class using the current class as primary query
     */
    public function useDisplayMessageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDisplayMessage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DisplayMessage', 'DisplayMessageQuery');
    }

    /**
     * Filter the query by a related Message object
     * using the display_message table as cross reference
     *
     * @param   Message $message the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DisplayQuery The current query, for fluid interface
     */
    public function filterByMessage($message, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useDisplayMessageQuery()
            ->filterByMessage($message, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Display $display Object to remove from the list of results
     *
     * @return DisplayQuery The current query, for fluid interface
     */
    public function prune($display = null)
    {
        if ($display) {
            $this->addUsingAlias(DisplayPeer::ID, $display->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
