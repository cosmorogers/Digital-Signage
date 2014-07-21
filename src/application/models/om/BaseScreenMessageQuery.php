<?php


/**
 * Base class that represents a query for the 'screen_message' table.
 *
 *
 *
 * @method ScreenMessageQuery orderByScreenId($order = Criteria::ASC) Order by the screen_id column
 * @method ScreenMessageQuery orderByMessageId($order = Criteria::ASC) Order by the message_id column
 *
 * @method ScreenMessageQuery groupByScreenId() Group by the screen_id column
 * @method ScreenMessageQuery groupByMessageId() Group by the message_id column
 *
 * @method ScreenMessageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ScreenMessageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ScreenMessageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ScreenMessageQuery leftJoinScreen($relationAlias = null) Adds a LEFT JOIN clause to the query using the Screen relation
 * @method ScreenMessageQuery rightJoinScreen($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Screen relation
 * @method ScreenMessageQuery innerJoinScreen($relationAlias = null) Adds a INNER JOIN clause to the query using the Screen relation
 *
 * @method ScreenMessageQuery leftJoinMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Message relation
 * @method ScreenMessageQuery rightJoinMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Message relation
 * @method ScreenMessageQuery innerJoinMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the Message relation
 *
 * @method ScreenMessage findOne(PropelPDO $con = null) Return the first ScreenMessage matching the query
 * @method ScreenMessage findOneOrCreate(PropelPDO $con = null) Return the first ScreenMessage matching the query, or a new ScreenMessage object populated from the query conditions when no match is found
 *
 * @method ScreenMessage findOneByScreenId(int $screen_id) Return the first ScreenMessage filtered by the screen_id column
 * @method ScreenMessage findOneByMessageId(int $message_id) Return the first ScreenMessage filtered by the message_id column
 *
 * @method array findByScreenId(int $screen_id) Return ScreenMessage objects filtered by the screen_id column
 * @method array findByMessageId(int $message_id) Return ScreenMessage objects filtered by the message_id column
 *
 * @package    propel.generator..om
 */
abstract class BaseScreenMessageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseScreenMessageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'signage', $modelName = 'ScreenMessage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ScreenMessageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ScreenMessageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ScreenMessageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ScreenMessageQuery) {
            return $criteria;
        }
        $query = new ScreenMessageQuery();
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
                         A Primary key composition: [$screen_id, $message_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ScreenMessage|ScreenMessage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScreenMessagePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ScreenMessagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 ScreenMessage A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `screen_id`, `message_id` FROM `screen_message` WHERE `screen_id` = :p0 AND `message_id` = :p1';
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
            $obj = new ScreenMessage();
            $obj->hydrate($row);
            ScreenMessagePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ScreenMessage|ScreenMessage[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ScreenMessage[]|mixed the list of results, formatted by the current formatter
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
     * @return ScreenMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ScreenMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ScreenMessagePeer::SCREEN_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ScreenMessagePeer::MESSAGE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the screen_id column
     *
     * Example usage:
     * <code>
     * $query->filterByScreenId(1234); // WHERE screen_id = 1234
     * $query->filterByScreenId(array(12, 34)); // WHERE screen_id IN (12, 34)
     * $query->filterByScreenId(array('min' => 12)); // WHERE screen_id >= 12
     * $query->filterByScreenId(array('max' => 12)); // WHERE screen_id <= 12
     * </code>
     *
     * @see       filterByScreen()
     *
     * @param     mixed $screenId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ScreenMessageQuery The current query, for fluid interface
     */
    public function filterByScreenId($screenId = null, $comparison = null)
    {
        if (is_array($screenId)) {
            $useMinMax = false;
            if (isset($screenId['min'])) {
                $this->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $screenId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($screenId['max'])) {
                $this->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $screenId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $screenId, $comparison);
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
     * @return ScreenMessageQuery The current query, for fluid interface
     */
    public function filterByMessageId($messageId = null, $comparison = null)
    {
        if (is_array($messageId)) {
            $useMinMax = false;
            if (isset($messageId['min'])) {
                $this->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $messageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageId['max'])) {
                $this->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $messageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $messageId, $comparison);
    }

    /**
     * Filter the query by a related Screen object
     *
     * @param   Screen|PropelObjectCollection $screen The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ScreenMessageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByScreen($screen, $comparison = null)
    {
        if ($screen instanceof Screen) {
            return $this
                ->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $screen->getId(), $comparison);
        } elseif ($screen instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScreenMessagePeer::SCREEN_ID, $screen->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ScreenMessageQuery The current query, for fluid interface
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
     * Filter the query by a related Message object
     *
     * @param   Message|PropelObjectCollection $message The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ScreenMessageQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMessage($message, $comparison = null)
    {
        if ($message instanceof Message) {
            return $this
                ->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $message->getId(), $comparison);
        } elseif ($message instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScreenMessagePeer::MESSAGE_ID, $message->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ScreenMessageQuery The current query, for fluid interface
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
     * @param   ScreenMessage $screenMessage Object to remove from the list of results
     *
     * @return ScreenMessageQuery The current query, for fluid interface
     */
    public function prune($screenMessage = null)
    {
        if ($screenMessage) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ScreenMessagePeer::SCREEN_ID), $screenMessage->getScreenId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ScreenMessagePeer::MESSAGE_ID), $screenMessage->getMessageId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
