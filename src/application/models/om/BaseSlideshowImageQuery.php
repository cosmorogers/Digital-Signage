<?php


/**
 * Base class that represents a query for the 'slideshow_image' table.
 *
 *
 *
 * @method SlideshowImageQuery orderBySlideshowId($order = Criteria::ASC) Order by the slideshow_id column
 * @method SlideshowImageQuery orderByImageId($order = Criteria::ASC) Order by the image_id column
 * @method SlideshowImageQuery orderByOrder($order = Criteria::ASC) Order by the order column
 *
 * @method SlideshowImageQuery groupBySlideshowId() Group by the slideshow_id column
 * @method SlideshowImageQuery groupByImageId() Group by the image_id column
 * @method SlideshowImageQuery groupByOrder() Group by the order column
 *
 * @method SlideshowImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SlideshowImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SlideshowImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SlideshowImageQuery leftJoinSlideshow($relationAlias = null) Adds a LEFT JOIN clause to the query using the Slideshow relation
 * @method SlideshowImageQuery rightJoinSlideshow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Slideshow relation
 * @method SlideshowImageQuery innerJoinSlideshow($relationAlias = null) Adds a INNER JOIN clause to the query using the Slideshow relation
 *
 * @method SlideshowImageQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method SlideshowImageQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method SlideshowImageQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method SlideshowImage findOne(PropelPDO $con = null) Return the first SlideshowImage matching the query
 * @method SlideshowImage findOneOrCreate(PropelPDO $con = null) Return the first SlideshowImage matching the query, or a new SlideshowImage object populated from the query conditions when no match is found
 *
 * @method SlideshowImage findOneBySlideshowId(int $slideshow_id) Return the first SlideshowImage filtered by the slideshow_id column
 * @method SlideshowImage findOneByImageId(int $image_id) Return the first SlideshowImage filtered by the image_id column
 * @method SlideshowImage findOneByOrder(int $order) Return the first SlideshowImage filtered by the order column
 *
 * @method array findBySlideshowId(int $slideshow_id) Return SlideshowImage objects filtered by the slideshow_id column
 * @method array findByImageId(int $image_id) Return SlideshowImage objects filtered by the image_id column
 * @method array findByOrder(int $order) Return SlideshowImage objects filtered by the order column
 *
 * @package    propel.generator..om
 */
abstract class BaseSlideshowImageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSlideshowImageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'signage', $modelName = 'SlideshowImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SlideshowImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SlideshowImageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SlideshowImageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SlideshowImageQuery) {
            return $criteria;
        }
        $query = new SlideshowImageQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$slideshow_id, $image_id, $order]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   SlideshowImage|SlideshowImage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SlideshowImagePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SlideshowImagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 SlideshowImage A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `slideshow_id`, `image_id`, `order` FROM `slideshow_image` WHERE `slideshow_id` = :p0 AND `image_id` = :p1 AND `order` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SlideshowImage();
            $obj->hydrate($row);
            SlideshowImagePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return SlideshowImage|SlideshowImage[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|SlideshowImage[]|mixed the list of results, formatted by the current formatter
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
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(SlideshowImagePeer::ORDER, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SlideshowImagePeer::SLIDESHOW_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SlideshowImagePeer::IMAGE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(SlideshowImagePeer::ORDER, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the slideshow_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySlideshowId(1234); // WHERE slideshow_id = 1234
     * $query->filterBySlideshowId(array(12, 34)); // WHERE slideshow_id IN (12, 34)
     * $query->filterBySlideshowId(array('min' => 12)); // WHERE slideshow_id >= 12
     * $query->filterBySlideshowId(array('max' => 12)); // WHERE slideshow_id <= 12
     * </code>
     *
     * @see       filterBySlideshow()
     *
     * @param     mixed $slideshowId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function filterBySlideshowId($slideshowId = null, $comparison = null)
    {
        if (is_array($slideshowId)) {
            $useMinMax = false;
            if (isset($slideshowId['min'])) {
                $this->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $slideshowId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($slideshowId['max'])) {
                $this->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $slideshowId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $slideshowId, $comparison);
    }

    /**
     * Filter the query on the image_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImageId(1234); // WHERE image_id = 1234
     * $query->filterByImageId(array(12, 34)); // WHERE image_id IN (12, 34)
     * $query->filterByImageId(array('min' => 12)); // WHERE image_id >= 12
     * $query->filterByImageId(array('max' => 12)); // WHERE image_id <= 12
     * </code>
     *
     * @see       filterByImage()
     *
     * @param     mixed $imageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function filterByImageId($imageId = null, $comparison = null)
    {
        if (is_array($imageId)) {
            $useMinMax = false;
            if (isset($imageId['min'])) {
                $this->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $imageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imageId['max'])) {
                $this->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $imageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $imageId, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order >= 12
     * $query->filterByOrder(array('max' => 12)); // WHERE order <= 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(SlideshowImagePeer::ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(SlideshowImagePeer::ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SlideshowImagePeer::ORDER, $order, $comparison);
    }

    /**
     * Filter the query by a related Slideshow object
     *
     * @param   Slideshow|PropelObjectCollection $slideshow The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SlideshowImageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySlideshow($slideshow, $comparison = null)
    {
        if ($slideshow instanceof Slideshow) {
            return $this
                ->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $slideshow->getId(), $comparison);
        } elseif ($slideshow instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SlideshowImagePeer::SLIDESHOW_ID, $slideshow->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySlideshow() only accepts arguments of type Slideshow or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Slideshow relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function joinSlideshow($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Slideshow');

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
            $this->addJoinObject($join, 'Slideshow');
        }

        return $this;
    }

    /**
     * Use the Slideshow relation Slideshow object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SlideshowQuery A secondary query class using the current class as primary query
     */
    public function useSlideshowQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSlideshow($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Slideshow', 'SlideshowQuery');
    }

    /**
     * Filter the query by a related Image object
     *
     * @param   Image|PropelObjectCollection $image The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SlideshowImageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByImage($image, $comparison = null)
    {
        if ($image instanceof Image) {
            return $this
                ->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $image->getId(), $comparison);
        } elseif ($image instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SlideshowImagePeer::IMAGE_ID, $image->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByImage() only accepts arguments of type Image or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Image relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function joinImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Image');

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
            $this->addJoinObject($join, 'Image');
        }

        return $this;
    }

    /**
     * Use the Image relation Image object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ImageQuery A secondary query class using the current class as primary query
     */
    public function useImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Image', 'ImageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SlideshowImage $slideshowImage Object to remove from the list of results
     *
     * @return SlideshowImageQuery The current query, for fluid interface
     */
    public function prune($slideshowImage = null)
    {
        if ($slideshowImage) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SlideshowImagePeer::SLIDESHOW_ID), $slideshowImage->getSlideshowId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SlideshowImagePeer::IMAGE_ID), $slideshowImage->getImageId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(SlideshowImagePeer::ORDER), $slideshowImage->getOrder(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
