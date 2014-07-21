<?php


/**
 * Base class that represents a query for the 'widget' table.
 *
 *
 *
 * @method WidgetQuery orderById($order = Criteria::ASC) Order by the id column
 * @method WidgetQuery orderByPosX($order = Criteria::ASC) Order by the pos_x column
 * @method WidgetQuery orderByPosY($order = Criteria::ASC) Order by the pos_y column
 * @method WidgetQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method WidgetQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method WidgetQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 *
 * @method WidgetQuery groupById() Group by the id column
 * @method WidgetQuery groupByPosX() Group by the pos_x column
 * @method WidgetQuery groupByPosY() Group by the pos_y column
 * @method WidgetQuery groupByWidth() Group by the width column
 * @method WidgetQuery groupByHeight() Group by the height column
 * @method WidgetQuery groupByClassKey() Group by the class_key column
 *
 * @method WidgetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method WidgetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method WidgetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Widget findOne(PropelPDO $con = null) Return the first Widget matching the query
 * @method Widget findOneOrCreate(PropelPDO $con = null) Return the first Widget matching the query, or a new Widget object populated from the query conditions when no match is found
 *
 * @method Widget findOneByPosX(int $pos_x) Return the first Widget filtered by the pos_x column
 * @method Widget findOneByPosY(int $pos_y) Return the first Widget filtered by the pos_y column
 * @method Widget findOneByWidth(int $width) Return the first Widget filtered by the width column
 * @method Widget findOneByHeight(int $height) Return the first Widget filtered by the height column
 * @method Widget findOneByClassKey(int $class_key) Return the first Widget filtered by the class_key column
 *
 * @method array findById(int $id) Return Widget objects filtered by the id column
 * @method array findByPosX(int $pos_x) Return Widget objects filtered by the pos_x column
 * @method array findByPosY(int $pos_y) Return Widget objects filtered by the pos_y column
 * @method array findByWidth(int $width) Return Widget objects filtered by the width column
 * @method array findByHeight(int $height) Return Widget objects filtered by the height column
 * @method array findByClassKey(int $class_key) Return Widget objects filtered by the class_key column
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
    public function __construct($dbName = 'signage', $modelName = 'Widget', $modelAlias = null)
    {
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
        $query = new WidgetQuery();
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
     * @return   Widget|Widget[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WidgetPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
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
     * @return                 Widget A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `pos_x`, `pos_y`, `width`, `height`, `class_key` FROM `widget` WHERE `id` = :p0';
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
            $cls = WidgetPeer::getOMClass($row, 0);
            $obj = new $cls();
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

        return $this->addUsingAlias(WidgetPeer::ID, $key, Criteria::EQUAL);
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

        return $this->addUsingAlias(WidgetPeer::ID, $keys, Criteria::IN);
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
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WidgetPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WidgetPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the pos_x column
     *
     * Example usage:
     * <code>
     * $query->filterByPosX(1234); // WHERE pos_x = 1234
     * $query->filterByPosX(array(12, 34)); // WHERE pos_x IN (12, 34)
     * $query->filterByPosX(array('min' => 12)); // WHERE pos_x >= 12
     * $query->filterByPosX(array('max' => 12)); // WHERE pos_x <= 12
     * </code>
     *
     * @param     mixed $posX The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByPosX($posX = null, $comparison = null)
    {
        if (is_array($posX)) {
            $useMinMax = false;
            if (isset($posX['min'])) {
                $this->addUsingAlias(WidgetPeer::POS_X, $posX['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($posX['max'])) {
                $this->addUsingAlias(WidgetPeer::POS_X, $posX['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::POS_X, $posX, $comparison);
    }

    /**
     * Filter the query on the pos_y column
     *
     * Example usage:
     * <code>
     * $query->filterByPosY(1234); // WHERE pos_y = 1234
     * $query->filterByPosY(array(12, 34)); // WHERE pos_y IN (12, 34)
     * $query->filterByPosY(array('min' => 12)); // WHERE pos_y >= 12
     * $query->filterByPosY(array('max' => 12)); // WHERE pos_y <= 12
     * </code>
     *
     * @param     mixed $posY The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByPosY($posY = null, $comparison = null)
    {
        if (is_array($posY)) {
            $useMinMax = false;
            if (isset($posY['min'])) {
                $this->addUsingAlias(WidgetPeer::POS_Y, $posY['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($posY['max'])) {
                $this->addUsingAlias(WidgetPeer::POS_Y, $posY['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::POS_Y, $posY, $comparison);
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
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(WidgetPeer::WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(WidgetPeer::WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::WIDTH, $width, $comparison);
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
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(WidgetPeer::HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(WidgetPeer::HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the class_key column
     *
     * Example usage:
     * <code>
     * $query->filterByClassKey(1234); // WHERE class_key = 1234
     * $query->filterByClassKey(array(12, 34)); // WHERE class_key IN (12, 34)
     * $query->filterByClassKey(array('min' => 12)); // WHERE class_key >= 12
     * $query->filterByClassKey(array('max' => 12)); // WHERE class_key <= 12
     * </code>
     *
     * @param     mixed $classKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return WidgetQuery The current query, for fluid interface
     */
    public function filterByClassKey($classKey = null, $comparison = null)
    {
        if (is_array($classKey)) {
            $useMinMax = false;
            if (isset($classKey['min'])) {
                $this->addUsingAlias(WidgetPeer::CLASS_KEY, $classKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($classKey['max'])) {
                $this->addUsingAlias(WidgetPeer::CLASS_KEY, $classKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WidgetPeer::CLASS_KEY, $classKey, $comparison);
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
            $this->addUsingAlias(WidgetPeer::ID, $widget->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
