<?php


/**
 * Base class that represents a query for the 'slideshow' table.
 *
 *
 *
 * @method SlideshowQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SlideshowQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method SlideshowQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method SlideshowQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method SlideshowQuery orderByDelay($order = Criteria::ASC) Order by the delay column
 * @method SlideshowQuery orderByEffect($order = Criteria::ASC) Order by the effect column
 *
 * @method SlideshowQuery groupById() Group by the id column
 * @method SlideshowQuery groupByName() Group by the name column
 * @method SlideshowQuery groupByWidth() Group by the width column
 * @method SlideshowQuery groupByHeight() Group by the height column
 * @method SlideshowQuery groupByDelay() Group by the delay column
 * @method SlideshowQuery groupByEffect() Group by the effect column
 *
 * @method SlideshowQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SlideshowQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SlideshowQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SlideshowQuery leftJoinSlideshowImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the SlideshowImage relation
 * @method SlideshowQuery rightJoinSlideshowImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SlideshowImage relation
 * @method SlideshowQuery innerJoinSlideshowImage($relationAlias = null) Adds a INNER JOIN clause to the query using the SlideshowImage relation
 *
 * @method Slideshow findOne(PropelPDO $con = null) Return the first Slideshow matching the query
 * @method Slideshow findOneOrCreate(PropelPDO $con = null) Return the first Slideshow matching the query, or a new Slideshow object populated from the query conditions when no match is found
 *
 * @method Slideshow findOneByName(string $name) Return the first Slideshow filtered by the name column
 * @method Slideshow findOneByWidth(int $width) Return the first Slideshow filtered by the width column
 * @method Slideshow findOneByHeight(int $height) Return the first Slideshow filtered by the height column
 * @method Slideshow findOneByDelay(int $delay) Return the first Slideshow filtered by the delay column
 * @method Slideshow findOneByEffect(int $effect) Return the first Slideshow filtered by the effect column
 *
 * @method array findById(int $id) Return Slideshow objects filtered by the id column
 * @method array findByName(string $name) Return Slideshow objects filtered by the name column
 * @method array findByWidth(int $width) Return Slideshow objects filtered by the width column
 * @method array findByHeight(int $height) Return Slideshow objects filtered by the height column
 * @method array findByDelay(int $delay) Return Slideshow objects filtered by the delay column
 * @method array findByEffect(int $effect) Return Slideshow objects filtered by the effect column
 *
 * @package    propel.generator..om
 */
abstract class BaseSlideshowQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSlideshowQuery object.
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
            $modelName = 'Slideshow';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SlideshowQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SlideshowQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SlideshowQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SlideshowQuery) {
            return $criteria;
        }
        $query = new SlideshowQuery(null, null, $modelAlias);

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
     * @return   Slideshow|Slideshow[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SlideshowPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SlideshowPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Slideshow A model object, or null if the key is not found
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
     * @return                 Slideshow A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `width`, `height`, `delay`, `effect` FROM `slideshow` WHERE `id` = :p0';
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
            $obj = new Slideshow();
            $obj->hydrate($row);
            SlideshowPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Slideshow|Slideshow[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Slideshow[]|mixed the list of results, formatted by the current formatter
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
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SlideshowPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SlideshowPeer::ID, $keys, Criteria::IN);
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
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SlideshowPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SlideshowPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowPeer::ID, $id, $comparison);
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
     * @return SlideshowQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SlideshowPeer::NAME, $name, $comparison);
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
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(SlideshowPeer::WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(SlideshowPeer::WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowPeer::WIDTH, $width, $comparison);
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
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(SlideshowPeer::HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(SlideshowPeer::HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the delay column
     *
     * Example usage:
     * <code>
     * $query->filterByDelay(1234); // WHERE delay = 1234
     * $query->filterByDelay(array(12, 34)); // WHERE delay IN (12, 34)
     * $query->filterByDelay(array('min' => 12)); // WHERE delay >= 12
     * $query->filterByDelay(array('max' => 12)); // WHERE delay <= 12
     * </code>
     *
     * @param     mixed $delay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function filterByDelay($delay = null, $comparison = null)
    {
        if (is_array($delay)) {
            $useMinMax = false;
            if (isset($delay['min'])) {
                $this->addUsingAlias(SlideshowPeer::DELAY, $delay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($delay['max'])) {
                $this->addUsingAlias(SlideshowPeer::DELAY, $delay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowPeer::DELAY, $delay, $comparison);
    }

    /**
     * Filter the query on the effect column
     *
     * @param     mixed $effect The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SlideshowQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByEffect($effect = null, $comparison = null)
    {
        if (is_scalar($effect)) {
            $effect = SlideshowPeer::getSqlValueForEnum(SlideshowPeer::EFFECT, $effect);
        } elseif (is_array($effect)) {
            $convertedValues = array();
            foreach ($effect as $value) {
                $convertedValues[] = SlideshowPeer::getSqlValueForEnum(SlideshowPeer::EFFECT, $value);
            }
            $effect = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowPeer::EFFECT, $effect, $comparison);
    }

    /**
     * Filter the query by a related SlideshowImage object
     *
     * @param   SlideshowImage|PropelObjectCollection $slideshowImage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SlideshowQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySlideshowImage($slideshowImage, $comparison = null)
    {
        if ($slideshowImage instanceof SlideshowImage) {
            return $this
                ->addUsingAlias(SlideshowPeer::ID, $slideshowImage->getSlideshowId(), $comparison);
        } elseif ($slideshowImage instanceof PropelObjectCollection) {
            return $this
                ->useSlideshowImageQuery()
                ->filterByPrimaryKeys($slideshowImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySlideshowImage() only accepts arguments of type SlideshowImage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SlideshowImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function joinSlideshowImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SlideshowImage');

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
            $this->addJoinObject($join, 'SlideshowImage');
        }

        return $this;
    }

    /**
     * Use the SlideshowImage relation SlideshowImage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SlideshowImageQuery A secondary query class using the current class as primary query
     */
    public function useSlideshowImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSlideshowImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SlideshowImage', 'SlideshowImageQuery');
    }

    /**
     * Filter the query by a related Image object
     * using the slideshow_image table as cross reference
     *
     * @param   Image $image the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SlideshowQuery The current query, for fluid interface
     */
    public function filterByImage($image, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useSlideshowImageQuery()
            ->filterByImage($image, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Slideshow $slideshow Object to remove from the list of results
     *
     * @return SlideshowQuery The current query, for fluid interface
     */
    public function prune($slideshow = null)
    {
        if ($slideshow) {
            $this->addUsingAlias(SlideshowPeer::ID, $slideshow->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
