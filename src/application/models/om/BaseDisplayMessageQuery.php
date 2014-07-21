<?php


/**
 * Base class that represents a query for the 'display_message' table.
 *
 *
 *
 * @method DisplayMessageQuery orderByDisplayId($order = Criteria::ASC) Order by the display_id column
 * @method DisplayMessageQuery orderByMessageId($order = Criteria::ASC) Order by the message_id column
 *
 * @method DisplayMessageQuery groupByDisplayId() Group by the display_id column
 * @method DisplayMessageQuery groupByMessageId() Group by the message_id column
 *
 * @method DisplayMessageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DisplayMessageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DisplayMessageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DisplayMessageQuery leftJoinDisplay($relationAlias = null) Adds a LEFT JOIN clause to the query using the Display relation
 * @method DisplayMessageQuery rightJoinDisplay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Display relation
 * @method DisplayMessageQuery innerJoinDisplay($relationAlias = null) Adds a INNER JOIN clause to the query using the Display relation
 *
 * @method DisplayMessageQuery leftJoinMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Message relation
 * @method DisplayMessageQuery rightJoinMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Message relation
 * @method DisplayMessageQuery innerJoinMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the Message relation
 *
 * @method DisplayMessage findOne(PropelPDO $con = null) Return the first DisplayMessage matching the query
 * @method DisplayMessage findOneOrCreate(PropelPDO $con = null) Return the first DisplayMessage matching the query, or a new DisplayMessage object populated from the query conditions when no match is found
 *
 * @method DisplayMessage findOneByDisplayId(int $display_id) Return the first DisplayMessage filtered by the display_id column
 * @method DisplayMessage findOneByMessageId(int $message_id) Return the first DisplayMessage filtered by the message_id column
 *
 * @method array findByDisplayId(int $display_id) Return DisplayMessage objects filtered by the display_id column
 * @method array findByMessageId(int $message_id) Return DisplayMessage objects filtered by the message_id column
 *
 * @package    propel.generator..om
 */
abstract class BaseDisplayMessageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDisplayMessageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'signage', $modelName = 'DisplayMessage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DisplayMessageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DisplayMessageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DisplayMessageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DisplayMessageQuery) {
            return $criteria;
        }
        $query = new DisplayMessageQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$display_id, $message_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   DisplayMessage|DisplayMessage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DisplayMessagePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DisplayMessagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 DisplayMessage A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `display_id`, `message_id` FROM `display_message` WHERE `display_id` = :p0 AND `message_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new DisplayMessage();
            $obj->hydrate($row);
            DisplayMessagePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return DisplayMessage|DisplayMessage[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DisplayMessage[]|mixed the list of results, formatted by the current formatter
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
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DisplayMessagePeer::DISPLAY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DisplayMessagePeer::MESSAGE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the display_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayId(1234); // WHERE display_id = 1234
     * $query->filterByDisplayId(array(12, 34)); // WHERE display_id IN (12, 34)
     * $query->filterByDisplayId(array('min' => 12)); // WHERE display_id >= 12
     * $query->filterByDisplayId(array('max' => 12)); // WHERE display_id <= 12
     * </code>
     *
     * @see       filterByDisplay()
     *
     * @param     mixed $displayId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function filterByDisplayId($displayId = null, $comparison = null)
    {
        if (is_array($displayId)) {
            $useMinMax = false;
            if (isset($displayId['min'])) {
                $this->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $displayId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($displayId['max'])) {
                $this->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $displayId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $displayId, $comparison);
    }

    /**
     * Filter the query on the message_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageId(1234); // WHERE message_id = 1234
     * $query->filterByMessageId(array(12, 34)); // WHERE message_id IN (12, 34)
     * $query->filterByMessageId(array('min' => 12)); // WHERE message_id >= 12
     * $query->filterByMessageId(array('max' => 12)); // WHERE message_id <= 12
     * </code>
     *
     * @see       filterByMessage()
     *
     * @param     mixed $messageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function filterByMessageId($messageId = null, $comparison = null)
    {
        if (is_array($messageId)) {
            $useMinMax = false;
            if (isset($messageId['min'])) {
                $this->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $messageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageId['max'])) {
                $this->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $messageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $messageId, $comparison);
    }

    /**
     * Filter the query by a related Display object
     *
     * @param   Display|PropelObjectCollection $display The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DisplayMessageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDisplay($display, $comparison = null)
    {
        if ($display instanceof Display) {
            return $this
                ->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $display->getId(), $comparison);
        } elseif ($display instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DisplayMessagePeer::DISPLAY_ID, $display->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDisplay() only accepts arguments of type Display or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Display relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function joinDisplay($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Display');

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
            $this->addJoinObject($join, 'Display');
        }

        return $this;
    }

    /**
     * Use the Display relation Display object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   DisplayQuery A secondary query class using the current class as primary query
     */
    public function useDisplayQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDisplay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Display', 'DisplayQuery');
    }

    /**
     * Filter the query by a related Message object
     *
     * @param   Message|PropelObjectCollection $message The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DisplayMessageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMessage($message, $comparison = null)
    {
        if ($message instanceof Message) {
            return $this
                ->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $message->getId(), $comparison);
        } elseif ($message instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DisplayMessagePeer::MESSAGE_ID, $message->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMessage() only accepts arguments of type Message or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Message relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function joinMessage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Message');

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
            $this->addJoinObject($join, 'Message');
        }

        return $this;
    }

    /**
     * Use the Message relation Message object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MessageQuery A secondary query class using the current class as primary query
     */
    public function useMessageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMessage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Message', 'MessageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DisplayMessage $displayMessage Object to remove from the list of results
     *
     * @return DisplayMessageQuery The current query, for fluid interface
     */
    public function prune($displayMessage = null)
    {
        if ($displayMessage) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DisplayMessagePeer::DISPLAY_ID), $displayMessage->getDisplayId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DisplayMessagePeer::MESSAGE_ID), $displayMessage->getMessageId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
