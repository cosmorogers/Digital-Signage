<?php


/**
 * Base class that represents a row from the 'screen' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseScreen extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ScreenPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ScreenPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the ip field.
     * @var        string
     */
    protected $ip;

    /**
     * The value for the key field.
     * @var        int
     */
    protected $key;

    /**
     * The value for the width field.
     * @var        int
     */
    protected $width;

    /**
     * The value for the height field.
     * @var        int
     */
    protected $height;

    /**
     * The value for the last_seen field.
     * @var        string
     */
    protected $last_seen;

    /**
     * The value for the mac field.
     * @var        string
     */
    protected $mac;

    /**
     * @var        PropelObjectCollection|ScreenMessage[] Collection to store aggregation of ScreenMessage objects.
     */
    protected $collScreenMessages;
    protected $collScreenMessagesPartial;

    /**
     * @var        PropelObjectCollection|Message[] Collection to store aggregation of Message objects.
     */
    protected $collMessages;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $screenMessagesScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [ip] column value.
     *
     * @return string
     */
    public function getIp()
    {

        return $this->ip;
    }

    /**
     * Get the [key] column value.
     *
     * @return int
     */
    public function getKey()
    {

        return $this->key;
    }

    /**
     * Get the [width] column value.
     *
     * @return int
     */
    public function getWidth()
    {

        return $this->width;
    }

    /**
     * Get the [height] column value.
     *
     * @return int
     */
    public function getHeight()
    {

        return $this->height;
    }

    /**
     * Get the [optionally formatted] temporal [last_seen] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastSeen($format = 'Y-m-d H:i:s')
    {
        if ($this->last_seen === null) {
            return null;
        }

        if ($this->last_seen === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->last_seen);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_seen, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [mac] column value.
     *
     * @return string
     */
    public function getMac()
    {

        return $this->mac;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ScreenPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ScreenPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [ip] column.
     *
     * @param  string $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip !== $v) {
            $this->ip = $v;
            $this->modifiedColumns[] = ScreenPeer::IP;
        }


        return $this;
    } // setIp()

    /**
     * Set the value of [key] column.
     *
     * @param  int $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setKey($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->key !== $v) {
            $this->key = $v;
            $this->modifiedColumns[] = ScreenPeer::KEY;
        }


        return $this;
    } // setKey()

    /**
     * Set the value of [width] column.
     *
     * @param  int $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setWidth($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->width !== $v) {
            $this->width = $v;
            $this->modifiedColumns[] = ScreenPeer::WIDTH;
        }


        return $this;
    } // setWidth()

    /**
     * Set the value of [height] column.
     *
     * @param  int $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[] = ScreenPeer::HEIGHT;
        }


        return $this;
    } // setHeight()

    /**
     * Sets the value of [last_seen] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Screen The current object (for fluent API support)
     */
    public function setLastSeen($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_seen !== null || $dt !== null) {
            $currentDateAsString = ($this->last_seen !== null && $tmpDt = new DateTime($this->last_seen)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->last_seen = $newDateAsString;
                $this->modifiedColumns[] = ScreenPeer::LAST_SEEN;
            }
        } // if either are not null


        return $this;
    } // setLastSeen()

    /**
     * Set the value of [mac] column.
     *
     * @param  string $v new value
     * @return Screen The current object (for fluent API support)
     */
    public function setMac($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mac !== $v) {
            $this->mac = $v;
            $this->modifiedColumns[] = ScreenPeer::MAC;
        }


        return $this;
    } // setMac()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->ip = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->key = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->width = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->height = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->last_seen = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->mac = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = ScreenPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Screen object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ScreenPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ScreenPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collScreenMessages = null;

            $this->collMessages = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ScreenPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ScreenQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ScreenPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ScreenPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->messagesScheduledForDeletion !== null) {
                if (!$this->messagesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->messagesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ScreenMessageQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->messagesScheduledForDeletion = null;
                }

                foreach ($this->getMessages() as $message) {
                    if ($message->isModified()) {
                        $message->save($con);
                    }
                }
            } elseif ($this->collMessages) {
                foreach ($this->collMessages as $message) {
                    if ($message->isModified()) {
                        $message->save($con);
                    }
                }
            }

            if ($this->screenMessagesScheduledForDeletion !== null) {
                if (!$this->screenMessagesScheduledForDeletion->isEmpty()) {
                    ScreenMessageQuery::create()
                        ->filterByPrimaryKeys($this->screenMessagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->screenMessagesScheduledForDeletion = null;
                }
            }

            if ($this->collScreenMessages !== null) {
                foreach ($this->collScreenMessages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = ScreenPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ScreenPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ScreenPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ScreenPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(ScreenPeer::IP)) {
            $modifiedColumns[':p' . $index++]  = '`ip`';
        }
        if ($this->isColumnModified(ScreenPeer::KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(ScreenPeer::WIDTH)) {
            $modifiedColumns[':p' . $index++]  = '`width`';
        }
        if ($this->isColumnModified(ScreenPeer::HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`height`';
        }
        if ($this->isColumnModified(ScreenPeer::LAST_SEEN)) {
            $modifiedColumns[':p' . $index++]  = '`last_seen`';
        }
        if ($this->isColumnModified(ScreenPeer::MAC)) {
            $modifiedColumns[':p' . $index++]  = '`mac`';
        }

        $sql = sprintf(
            'INSERT INTO `screen` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`ip`':
                        $stmt->bindValue($identifier, $this->ip, PDO::PARAM_STR);
                        break;
                    case '`key`':
                        $stmt->bindValue($identifier, $this->key, PDO::PARAM_INT);
                        break;
                    case '`width`':
                        $stmt->bindValue($identifier, $this->width, PDO::PARAM_INT);
                        break;
                    case '`height`':
                        $stmt->bindValue($identifier, $this->height, PDO::PARAM_INT);
                        break;
                    case '`last_seen`':
                        $stmt->bindValue($identifier, $this->last_seen, PDO::PARAM_STR);
                        break;
                    case '`mac`':
                        $stmt->bindValue($identifier, $this->mac, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = ScreenPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collScreenMessages !== null) {
                    foreach ($this->collScreenMessages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ScreenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getIp();
                break;
            case 3:
                return $this->getKey();
                break;
            case 4:
                return $this->getWidth();
                break;
            case 5:
                return $this->getHeight();
                break;
            case 6:
                return $this->getLastSeen();
                break;
            case 7:
                return $this->getMac();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Screen'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Screen'][$this->getPrimaryKey()] = true;
        $keys = ScreenPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getIp(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getWidth(),
            $keys[5] => $this->getHeight(),
            $keys[6] => $this->getLastSeen(),
            $keys[7] => $this->getMac(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collScreenMessages) {
                $result['ScreenMessages'] = $this->collScreenMessages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ScreenPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setIp($value);
                break;
            case 3:
                $this->setKey($value);
                break;
            case 4:
                $this->setWidth($value);
                break;
            case 5:
                $this->setHeight($value);
                break;
            case 6:
                $this->setLastSeen($value);
                break;
            case 7:
                $this->setMac($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = ScreenPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIp($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setKey($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setWidth($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setHeight($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setLastSeen($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setMac($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ScreenPeer::DATABASE_NAME);

        if ($this->isColumnModified(ScreenPeer::ID)) $criteria->add(ScreenPeer::ID, $this->id);
        if ($this->isColumnModified(ScreenPeer::NAME)) $criteria->add(ScreenPeer::NAME, $this->name);
        if ($this->isColumnModified(ScreenPeer::IP)) $criteria->add(ScreenPeer::IP, $this->ip);
        if ($this->isColumnModified(ScreenPeer::KEY)) $criteria->add(ScreenPeer::KEY, $this->key);
        if ($this->isColumnModified(ScreenPeer::WIDTH)) $criteria->add(ScreenPeer::WIDTH, $this->width);
        if ($this->isColumnModified(ScreenPeer::HEIGHT)) $criteria->add(ScreenPeer::HEIGHT, $this->height);
        if ($this->isColumnModified(ScreenPeer::LAST_SEEN)) $criteria->add(ScreenPeer::LAST_SEEN, $this->last_seen);
        if ($this->isColumnModified(ScreenPeer::MAC)) $criteria->add(ScreenPeer::MAC, $this->mac);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ScreenPeer::DATABASE_NAME);
        $criteria->add(ScreenPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Screen (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setIp($this->getIp());
        $copyObj->setKey($this->getKey());
        $copyObj->setWidth($this->getWidth());
        $copyObj->setHeight($this->getHeight());
        $copyObj->setLastSeen($this->getLastSeen());
        $copyObj->setMac($this->getMac());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getScreenMessages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addScreenMessage($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Screen Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return ScreenPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ScreenPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ScreenMessage' == $relationName) {
            $this->initScreenMessages();
        }
    }

    /**
     * Clears out the collScreenMessages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Screen The current object (for fluent API support)
     * @see        addScreenMessages()
     */
    public function clearScreenMessages()
    {
        $this->collScreenMessages = null; // important to set this to null since that means it is uninitialized
        $this->collScreenMessagesPartial = null;

        return $this;
    }

    /**
     * reset is the collScreenMessages collection loaded partially
     *
     * @return void
     */
    public function resetPartialScreenMessages($v = true)
    {
        $this->collScreenMessagesPartial = $v;
    }

    /**
     * Initializes the collScreenMessages collection.
     *
     * By default this just sets the collScreenMessages collection to an empty array (like clearcollScreenMessages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initScreenMessages($overrideExisting = true)
    {
        if (null !== $this->collScreenMessages && !$overrideExisting) {
            return;
        }
        $this->collScreenMessages = new PropelObjectCollection();
        $this->collScreenMessages->setModel('ScreenMessage');
    }

    /**
     * Gets an array of ScreenMessage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Screen is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ScreenMessage[] List of ScreenMessage objects
     * @throws PropelException
     */
    public function getScreenMessages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collScreenMessagesPartial && !$this->isNew();
        if (null === $this->collScreenMessages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collScreenMessages) {
                // return empty collection
                $this->initScreenMessages();
            } else {
                $collScreenMessages = ScreenMessageQuery::create(null, $criteria)
                    ->filterByScreen($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collScreenMessagesPartial && count($collScreenMessages)) {
                      $this->initScreenMessages(false);

                      foreach ($collScreenMessages as $obj) {
                        if (false == $this->collScreenMessages->contains($obj)) {
                          $this->collScreenMessages->append($obj);
                        }
                      }

                      $this->collScreenMessagesPartial = true;
                    }

                    $collScreenMessages->getInternalIterator()->rewind();

                    return $collScreenMessages;
                }

                if ($partial && $this->collScreenMessages) {
                    foreach ($this->collScreenMessages as $obj) {
                        if ($obj->isNew()) {
                            $collScreenMessages[] = $obj;
                        }
                    }
                }

                $this->collScreenMessages = $collScreenMessages;
                $this->collScreenMessagesPartial = false;
            }
        }

        return $this->collScreenMessages;
    }

    /**
     * Sets a collection of ScreenMessage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $screenMessages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Screen The current object (for fluent API support)
     */
    public function setScreenMessages(PropelCollection $screenMessages, PropelPDO $con = null)
    {
        $screenMessagesToDelete = $this->getScreenMessages(new Criteria(), $con)->diff($screenMessages);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->screenMessagesScheduledForDeletion = clone $screenMessagesToDelete;

        foreach ($screenMessagesToDelete as $screenMessageRemoved) {
            $screenMessageRemoved->setScreen(null);
        }

        $this->collScreenMessages = null;
        foreach ($screenMessages as $screenMessage) {
            $this->addScreenMessage($screenMessage);
        }

        $this->collScreenMessages = $screenMessages;
        $this->collScreenMessagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ScreenMessage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ScreenMessage objects.
     * @throws PropelException
     */
    public function countScreenMessages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collScreenMessagesPartial && !$this->isNew();
        if (null === $this->collScreenMessages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collScreenMessages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getScreenMessages());
            }
            $query = ScreenMessageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByScreen($this)
                ->count($con);
        }

        return count($this->collScreenMessages);
    }

    /**
     * Method called to associate a ScreenMessage object to this object
     * through the ScreenMessage foreign key attribute.
     *
     * @param    ScreenMessage $l ScreenMessage
     * @return Screen The current object (for fluent API support)
     */
    public function addScreenMessage(ScreenMessage $l)
    {
        if ($this->collScreenMessages === null) {
            $this->initScreenMessages();
            $this->collScreenMessagesPartial = true;
        }

        if (!in_array($l, $this->collScreenMessages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddScreenMessage($l);

            if ($this->screenMessagesScheduledForDeletion and $this->screenMessagesScheduledForDeletion->contains($l)) {
                $this->screenMessagesScheduledForDeletion->remove($this->screenMessagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ScreenMessage $screenMessage The screenMessage object to add.
     */
    protected function doAddScreenMessage($screenMessage)
    {
        $this->collScreenMessages[]= $screenMessage;
        $screenMessage->setScreen($this);
    }

    /**
     * @param	ScreenMessage $screenMessage The screenMessage object to remove.
     * @return Screen The current object (for fluent API support)
     */
    public function removeScreenMessage($screenMessage)
    {
        if ($this->getScreenMessages()->contains($screenMessage)) {
            $this->collScreenMessages->remove($this->collScreenMessages->search($screenMessage));
            if (null === $this->screenMessagesScheduledForDeletion) {
                $this->screenMessagesScheduledForDeletion = clone $this->collScreenMessages;
                $this->screenMessagesScheduledForDeletion->clear();
            }
            $this->screenMessagesScheduledForDeletion[]= clone $screenMessage;
            $screenMessage->setScreen(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Screen is new, it will return
     * an empty collection; or if this Screen has previously
     * been saved, it will retrieve related ScreenMessages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Screen.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ScreenMessage[] List of ScreenMessage objects
     */
    public function getScreenMessagesJoinMessage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ScreenMessageQuery::create(null, $criteria);
        $query->joinWith('Message', $join_behavior);

        return $this->getScreenMessages($query, $con);
    }

    /**
     * Clears out the collMessages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Screen The current object (for fluent API support)
     * @see        addMessages()
     */
    public function clearMessages()
    {
        $this->collMessages = null; // important to set this to null since that means it is uninitialized
        $this->collMessagesPartial = null;

        return $this;
    }

    /**
     * Initializes the collMessages collection.
     *
     * By default this just sets the collMessages collection to an empty collection (like clearMessages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initMessages()
    {
        $this->collMessages = new PropelObjectCollection();
        $this->collMessages->setModel('Message');
    }

    /**
     * Gets a collection of Message objects related by a many-to-many relationship
     * to the current object by way of the screen_message cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Screen is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Message[] List of Message objects
     */
    public function getMessages($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collMessages || null !== $criteria) {
            if ($this->isNew() && null === $this->collMessages) {
                // return empty collection
                $this->initMessages();
            } else {
                $collMessages = MessageQuery::create(null, $criteria)
                    ->filterByScreen($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collMessages;
                }
                $this->collMessages = $collMessages;
            }
        }

        return $this->collMessages;
    }

    /**
     * Sets a collection of Message objects related by a many-to-many relationship
     * to the current object by way of the screen_message cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Screen The current object (for fluent API support)
     */
    public function setMessages(PropelCollection $messages, PropelPDO $con = null)
    {
        $this->clearMessages();
        $currentMessages = $this->getMessages(null, $con);

        $this->messagesScheduledForDeletion = $currentMessages->diff($messages);

        foreach ($messages as $message) {
            if (!$currentMessages->contains($message)) {
                $this->doAddMessage($message);
            }
        }

        $this->collMessages = $messages;

        return $this;
    }

    /**
     * Gets the number of Message objects related by a many-to-many relationship
     * to the current object by way of the screen_message cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Message objects
     */
    public function countMessages($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collMessages || null !== $criteria) {
            if ($this->isNew() && null === $this->collMessages) {
                return 0;
            } else {
                $query = MessageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByScreen($this)
                    ->count($con);
            }
        } else {
            return count($this->collMessages);
        }
    }

    /**
     * Associate a Message object to this object
     * through the screen_message cross reference table.
     *
     * @param  Message $message The ScreenMessage object to relate
     * @return Screen The current object (for fluent API support)
     */
    public function addMessage(Message $message)
    {
        if ($this->collMessages === null) {
            $this->initMessages();
        }

        if (!$this->collMessages->contains($message)) { // only add it if the **same** object is not already associated
            $this->doAddMessage($message);
            $this->collMessages[] = $message;

            if ($this->messagesScheduledForDeletion and $this->messagesScheduledForDeletion->contains($message)) {
                $this->messagesScheduledForDeletion->remove($this->messagesScheduledForDeletion->search($message));
            }
        }

        return $this;
    }

    /**
     * @param	Message $message The message object to add.
     */
    protected function doAddMessage(Message $message)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$message->getScreens()->contains($this)) { $screenMessage = new ScreenMessage();
            $screenMessage->setMessage($message);
            $this->addScreenMessage($screenMessage);

            $foreignCollection = $message->getScreens();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Message object to this object
     * through the screen_message cross reference table.
     *
     * @param Message $message The ScreenMessage object to relate
     * @return Screen The current object (for fluent API support)
     */
    public function removeMessage(Message $message)
    {
        if ($this->getMessages()->contains($message)) {
            $this->collMessages->remove($this->collMessages->search($message));
            if (null === $this->messagesScheduledForDeletion) {
                $this->messagesScheduledForDeletion = clone $this->collMessages;
                $this->messagesScheduledForDeletion->clear();
            }
            $this->messagesScheduledForDeletion[]= $message;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->ip = null;
        $this->key = null;
        $this->width = null;
        $this->height = null;
        $this->last_seen = null;
        $this->mac = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collScreenMessages) {
                foreach ($this->collScreenMessages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMessages) {
                foreach ($this->collMessages as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collScreenMessages instanceof PropelCollection) {
            $this->collScreenMessages->clearIterator();
        }
        $this->collScreenMessages = null;
        if ($this->collMessages instanceof PropelCollection) {
            $this->collMessages->clearIterator();
        }
        $this->collMessages = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ScreenPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
