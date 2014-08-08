<?php


/**
 * Base class that represents a query for the 'screen' table.
 *
 *
 *
 * @method ScreenQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ScreenQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method ScreenQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method ScreenQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method ScreenQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method ScreenQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method ScreenQuery orderByLastSeen($order = Criteria::ASC) Order by the last_seen column
 * @method ScreenQuery orderByMac($order = Criteria::ASC) Order by the mac column
 *
 * @method ScreenQuery groupById() Group by the id column
 * @method ScreenQuery groupByName() Group by the name column
 * @method ScreenQuery groupByIp() Group by the ip column
 * @method ScreenQuery groupByKey() Group by the key column
 * @method ScreenQuery groupByWidth() Group by the width column
 * @method ScreenQuery groupByHeight() Group by the height column
 * @method ScreenQuery groupByLastSeen() Group by the last_seen column
 * @method ScreenQuery groupByMac() Group by the mac column
 *
 * @method ScreenQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ScreenQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ScreenQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ScreenQuery leftJoinScreenMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScreenMessage relation
 * @method ScreenQuery rightJoinScreenMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScreenMessage relation
 * @method ScreenQuery innerJoinScreenMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the ScreenMessage relation
 *
 * @method Screen findOne(PropelPDO $con = null) Return the first Screen matching the query
 * @method Screen findOneOrCreate(PropelPDO $con = null) Return the first Screen matching the query, or a new Screen object populated from the query conditions when no match is found
 *
 * @method Screen findOneByName(string $name) Return the first Screen filtered by the name column
 * @method Screen findOneByIp(string $ip) Return the first Screen filtered by the ip column
 * @method Screen findOneByKey(int $key) Return the first Screen filtered by the key column
 * @method Screen findOneByWidth(int $width) Return the first Screen filtered by the width column
 * @method Screen findOneByHeight(int $height) Return the first Screen filtered by the height column
 * @method Screen findOneByLastSeen(string $last_seen) Return the first Screen filtered by the last_seen column
 * @method Screen findOneByMac(string $mac) Return the first Screen filtered by the mac column
 *
 * @method array findById(int $id) Return Screen objects filtered by the id column
 * @method array findByName(string $name) Return Screen objects filtered by the name column
 * @method array findByIp(string $ip) Return Screen objects filtered by the ip column
 * @method array findByKey(int $key) Return Screen objects filtered by the key column
 * @method array findByWidth(int $width) Return Screen objects filtered by the width column
 * @method array findByHeight(int $height) Return Screen objects filtered by the height column
 * @method array findByLastSeen(string $last_seen) Return Screen objects filtered by the last_seen column
 * @method array findByMac(string $mac) Return Screen objects filtered by the mac column
 *
 * @package    propel.generator..om
 */
abstract class BaseScreenQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseScreenQuery object.
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
            $modelName = 'Screen';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ScreenQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ScreenQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ScreenQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ScreenQuery) {
            return $criteria;
        }
        $query = new ScreenQuery(null, null, $modelAlias);

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
     * @return   Screen|Screen[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScreenPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ScreenPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Screen A model object, or null if the key is not found
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
     * @return                 Screen A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `ip`, `key`, `width`, `height`, `last_seen`, `mac` FROM `screen` WHERE `id` = :p0';
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
            $obj = new Screen();
            $obj->hydrate($row);
            ScreenPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Screen|Screen[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Screen[]|mixed the list of results, formatted by the current formatter
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ScreenPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ScreenPeer::ID, $keys, Criteria::IN);
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ScreenPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ScreenPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenPeer::ID, $id, $comparison);
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
     * @return ScreenQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ScreenPeer::NAME, $name, $comparison);
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
     * @return ScreenQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ScreenPeer::IP, $ip, $comparison);
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByKey($key = null, $comparison = null)
    {
        if (is_array($key)) {
            $useMinMax = false;
            if (isset($key['min'])) {
                $this->addUsingAlias(ScreenPeer::KEY, $key['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($key['max'])) {
                $this->addUsingAlias(ScreenPeer::KEY, $key['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenPeer::KEY, $key, $comparison);
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(ScreenPeer::WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(ScreenPeer::WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenPeer::WIDTH, $width, $comparison);
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(ScreenPeer::HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(ScreenPeer::HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the last_seen column
     *
     * Example usage:
     * <code>
     * $query->filterByLastSeen('2011-03-14'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen('now'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen(array('max' => 'yesterday')); // WHERE last_seen < '2011-03-13'
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
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByLastSeen($lastSeen = null, $comparison = null)
    {
        if (is_array($lastSeen)) {
            $useMinMax = false;
            if (isset($lastSeen['min'])) {
                $this->addUsingAlias(ScreenPeer::LAST_SEEN, $lastSeen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastSeen['max'])) {
                $this->addUsingAlias(ScreenPeer::LAST_SEEN, $lastSeen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenPeer::LAST_SEEN, $lastSeen, $comparison);
    }

    /**
     * Filter the query on the mac column
     *
     * Example usage:
     * <code>
     * $query->filterByMac('fooValue');   // WHERE mac = 'fooValue'
     * $query->filterByMac('%fooValue%'); // WHERE mac LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mac The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ScreenQuery The current query, for fluid interface
     */
    public function filterByMac($mac = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mac)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mac)) {
                $mac = str_replace('*', '%', $mac);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ScreenPeer::MAC, $mac, $comparison);
    }

    /**
     * Filter the query by a related ScreenMessage object
     *
     * @param   ScreenMessage|PropelObjectCollection $screenMessage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ScreenQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByScreenMessage($screenMessage, $comparison = null)
    {
        if ($screenMessage instanceof ScreenMessage) {
            return $this
                ->addUsingAlias(ScreenPeer::ID, $screenMessage->getScreenId(), $comparison);
        } elseif ($screenMessage instanceof PropelObjectCollection) {
            return $this
                ->useScreenMessageQuery()
                ->filterByPrimaryKeys($screenMessage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByScreenMessage() only accepts arguments of type ScreenMessage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScreenMessage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ScreenQuery The current query, for fluid interface
     */
    public function joinScreenMessage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScreenMessage');

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
            $this->addJoinObject($join, 'ScreenMessage');
        }

        return $this;
    }

    /**
     * Use the ScreenMessage relation ScreenMessage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ScreenMessageQuery A secondary query class using the current class as primary query
     */
    public function useScreenMessageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScreenMessage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScreenMessage', 'ScreenMessageQuery');
    }

    /**
     * Filter the query by a related Message object
     * using the screen_message table as cross reference
     *
     * @param   Message $message the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ScreenQuery The current query, for fluid interface
     */
    public function filterByMessage($message, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useScreenMessageQuery()
            ->filterByMessage($message, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Screen $screen Object to remove from the list of results
     *
     * @return ScreenQuery The current query, for fluid interface
     */
    public function prune($screen = null)
    {
        if ($screen) {
            $this->addUsingAlias(ScreenPeer::ID, $screen->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
