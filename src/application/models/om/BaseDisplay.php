<?php


/**
 * Base class that represents a row from the 'display' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseDisplay extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'DisplayPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DisplayPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
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
     * @var        PropelObjectCollection|DisplayMessage[] Collection to store aggregation of DisplayMessage objects.
     */
    protected $collDisplayMessages;
    protected $collDisplayMessagesPartial;

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
    protected $displayMessagesScheduledForDeletion = null;

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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DisplayPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = DisplayPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [ip] column.
     *
     * @param string $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setIp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ip !== $v) {
            $this->ip = $v;
            $this->modifiedColumns[] = DisplayPeer::IP;
        }


        return $this;
    } // setIp()

    /**
     * Set the value of [key] column.
     *
     * @param int $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setKey($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->key !== $v) {
            $this->key = $v;
            $this->modifiedColumns[] = DisplayPeer::KEY;
        }


        return $this;
    } // setKey()

    /**
     * Set the value of [width] column.
     *
     * @param int $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setWidth($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->width !== $v) {
            $this->width = $v;
            $this->modifiedColumns[] = DisplayPeer::WIDTH;
        }


        return $this;
    } // setWidth()

    /**
     * Set the value of [height] column.
     *
     * @param int $v new value
     * @return Display The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[] = DisplayPeer::HEIGHT;
        }


        return $this;
    } // setHeight()

    /**
     * Sets the value of [last_seen] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Display The current object (for fluent API support)
     */
    public function setLastSeen($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_seen !== null || $dt !== null) {
            $currentDateAsString = ($this->last_seen !== null && $tmpDt = new DateTime($this->last_seen)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->last_seen = $newDateAsString;
                $this->modifiedColumns[] = DisplayPeer::LAST_SEEN;
            }
        } // if either are not null


        return $this;
    } // setLastSeen()

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
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
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
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 7; // 7 = DisplayPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Display object", $e);
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
            $con = Propel::getConnection(DisplayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DisplayPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDisplayMessages = null;

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
            $con = Propel::getConnection(DisplayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DisplayQuery::create()
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
            $con = Propel::getConnection(DisplayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                DisplayPeer::addInstanceToPool($this);
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
                    DisplayMessageQuery::create()
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

            if ($this->displayMessagesScheduledForDeletion !== null) {
                if (!$this->displayMessagesScheduledForDeletion->isEmpty()) {
                    foreach ($this->displayMessagesScheduledForDeletion as $displayMessage) {
                        // need to save related object because we set the relation to null
                        $displayMessage->save($con);
                    }
                    $this->displayMessagesScheduledForDeletion = null;
                }
            }

            if ($this->collDisplayMessages !== null) {
                foreach ($this->collDisplayMessages as $referrerFK) {
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

        $this->modifiedColumns[] = DisplayPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DisplayPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DisplayPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(DisplayPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(DisplayPeer::IP)) {
            $modifiedColumns[':p' . $index++]  = '`ip`';
        }
        if ($this->isColumnModified(DisplayPeer::KEY)) {
            $modifiedColumns[':p' . $index++]  = '`key`';
        }
        if ($this->isColumnModified(DisplayPeer::WIDTH)) {
            $modifiedColumns[':p' . $index++]  = '`width`';
        }
        if ($this->isColumnModified(DisplayPeer::HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`height`';
        }
        if ($this->isColumnModified(DisplayPeer::LAST_SEEN)) {
            $modifiedColumns[':p' . $index++]  = '`last_seen`';
        }

        $sql = sprintf(
            'INSERT INTO `display` (%s) VALUES (%s)',
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
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = DisplayPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDisplayMessages !== null) {
                    foreach ($this->collDisplayMessages as $referrerFK) {
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
        $pos = DisplayPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Display'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Display'][$this->getPrimaryKey()] = true;
        $keys = DisplayPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getIp(),
            $keys[3] => $this->getKey(),
            $keys[4] => $this->getWidth(),
            $keys[5] => $this->getHeight(),
            $keys[6] => $this->getLastSeen(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collDisplayMessages) {
                $result['DisplayMessages'] = $this->collDisplayMessages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DisplayPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = DisplayPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIp($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setKey($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setWidth($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setHeight($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setLastSeen($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DisplayPeer::DATABASE_NAME);

        if ($this->isColumnModified(DisplayPeer::ID)) $criteria->add(DisplayPeer::ID, $this->id);
        if ($this->isColumnModified(DisplayPeer::NAME)) $criteria->add(DisplayPeer::NAME, $this->name);
        if ($this->isColumnModified(DisplayPeer::IP)) $criteria->add(DisplayPeer::IP, $this->ip);
        if ($this->isColumnModified(DisplayPeer::KEY)) $criteria->add(DisplayPeer::KEY, $this->key);
        if ($this->isColumnModified(DisplayPeer::WIDTH)) $criteria->add(DisplayPeer::WIDTH, $this->width);
        if ($this->isColumnModified(DisplayPeer::HEIGHT)) $criteria->add(DisplayPeer::HEIGHT, $this->height);
        if ($this->isColumnModified(DisplayPeer::LAST_SEEN)) $criteria->add(DisplayPeer::LAST_SEEN, $this->last_seen);

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
        $criteria = new Criteria(DisplayPeer::DATABASE_NAME);
        $criteria->add(DisplayPeer::ID, $this->id);

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
     * @param object $copyObj An object of Display (or compatible) type.
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

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDisplayMessages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDisplayMessage($relObj->copy($deepCopy));
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
     * @return Display Clone of current object.
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
     * @return DisplayPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DisplayPeer();
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
        if ('DisplayMessage' == $relationName) {
            $this->initDisplayMessages();
        }
    }

    /**
     * Clears out the collDisplayMessages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Display The current object (for fluent API support)
     * @see        addDisplayMessages()
     */
    public function clearDisplayMessages()
    {
        $this->collDisplayMessages = null; // important to set this to null since that means it is uninitialized
        $this->collDisplayMessagesPartial = null;

        return $this;
    }

    /**
     * reset is the collDisplayMessages collection loaded partially
     *
     * @return void
     */
    public function resetPartialDisplayMessages($v = true)
    {
        $this->collDisplayMessagesPartial = $v;
    }

    /**
     * Initializes the collDisplayMessages collection.
     *
     * By default this just sets the collDisplayMessages collection to an empty array (like clearcollDisplayMessages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDisplayMessages($overrideExisting = true)
    {
        if (null !== $this->collDisplayMessages && !$overrideExisting) {
            return;
        }
        $this->collDisplayMessages = new PropelObjectCollection();
        $this->collDisplayMessages->setModel('DisplayMessage');
    }

    /**
     * Gets an array of DisplayMessage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Display is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DisplayMessage[] List of DisplayMessage objects
     * @throws PropelException
     */
    public function getDisplayMessages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDisplayMessagesPartial && !$this->isNew();
        if (null === $this->collDisplayMessages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDisplayMessages) {
                // return empty collection
                $this->initDisplayMessages();
            } else {
                $collDisplayMessages = DisplayMessageQuery::create(null, $criteria)
                    ->filterByDisplay($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDisplayMessagesPartial && count($collDisplayMessages)) {
                      $this->initDisplayMessages(false);

                      foreach($collDisplayMessages as $obj) {
                        if (false == $this->collDisplayMessages->contains($obj)) {
                          $this->collDisplayMessages->append($obj);
                        }
                      }

                      $this->collDisplayMessagesPartial = true;
                    }

                    $collDisplayMessages->getInternalIterator()->rewind();
                    return $collDisplayMessages;
                }

                if($partial && $this->collDisplayMessages) {
                    foreach($this->collDisplayMessages as $obj) {
                        if($obj->isNew()) {
                            $collDisplayMessages[] = $obj;
                        }
                    }
                }

                $this->collDisplayMessages = $collDisplayMessages;
                $this->collDisplayMessagesPartial = false;
            }
        }

        return $this->collDisplayMessages;
    }

    /**
     * Sets a collection of DisplayMessage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $displayMessages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Display The current object (for fluent API support)
     */
    public function setDisplayMessages(PropelCollection $displayMessages, PropelPDO $con = null)
    {
        $displayMessagesToDelete = $this->getDisplayMessages(new Criteria(), $con)->diff($displayMessages);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->displayMessagesScheduledForDeletion = clone $displayMessagesToDelete;

        foreach ($displayMessagesToDelete as $displayMessageRemoved) {
            $displayMessageRemoved->setDisplay(null);
        }

        $this->collDisplayMessages = null;
        foreach ($displayMessages as $displayMessage) {
            $this->addDisplayMessage($displayMessage);
        }

        $this->collDisplayMessages = $displayMessages;
        $this->collDisplayMessagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DisplayMessage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DisplayMessage objects.
     * @throws PropelException
     */
    public function countDisplayMessages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDisplayMessagesPartial && !$this->isNew();
        if (null === $this->collDisplayMessages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDisplayMessages) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getDisplayMessages());
            }
            $query = DisplayMessageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDisplay($this)
                ->count($con);
        }

        return count($this->collDisplayMessages);
    }

    /**
     * Method called to associate a DisplayMessage object to this object
     * through the DisplayMessage foreign key attribute.
     *
     * @param    DisplayMessage $l DisplayMessage
     * @return Display The current object (for fluent API support)
     */
    public function addDisplayMessage(DisplayMessage $l)
    {
        if ($this->collDisplayMessages === null) {
            $this->initDisplayMessages();
            $this->collDisplayMessagesPartial = true;
        }
        if (!in_array($l, $this->collDisplayMessages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDisplayMessage($l);
        }

        return $this;
    }

    /**
     * @param	DisplayMessage $displayMessage The displayMessage object to add.
     */
    protected function doAddDisplayMessage($displayMessage)
    {
        $this->collDisplayMessages[]= $displayMessage;
        $displayMessage->setDisplay($this);
    }

    /**
     * @param	DisplayMessage $displayMessage The displayMessage object to remove.
     * @return Display The current object (for fluent API support)
     */
    public function removeDisplayMessage($displayMessage)
    {
        if ($this->getDisplayMessages()->contains($displayMessage)) {
            $this->collDisplayMessages->remove($this->collDisplayMessages->search($displayMessage));
            if (null === $this->displayMessagesScheduledForDeletion) {
                $this->displayMessagesScheduledForDeletion = clone $this->collDisplayMessages;
                $this->displayMessagesScheduledForDeletion->clear();
            }
            $this->displayMessagesScheduledForDeletion[]= clone $displayMessage;
            $displayMessage->setDisplay(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Display is new, it will return
     * an empty collection; or if this Display has previously
     * been saved, it will retrieve related DisplayMessages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Display.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|DisplayMessage[] List of DisplayMessage objects
     */
    public function getDisplayMessagesJoinMessage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DisplayMessageQuery::create(null, $criteria);
        $query->joinWith('Message', $join_behavior);

        return $this->getDisplayMessages($query, $con);
    }

    /**
     * Clears out the collMessages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Display The current object (for fluent API support)
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
     * to the current object by way of the display_message cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Display is new, it will return
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
                    ->filterByDisplay($this)
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
     * to the current object by way of the display_message cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Display The current object (for fluent API support)
     */
    public function setMessages(PropelCollection $messages, PropelPDO $con = null)
    {
        $this->clearMessages();
        $currentMessages = $this->getMessages();

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
     * to the current object by way of the display_message cross-reference table.
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
                    ->filterByDisplay($this)
                    ->count($con);
            }
        } else {
            return count($this->collMessages);
        }
    }

    /**
     * Associate a Message object to this object
     * through the display_message cross reference table.
     *
     * @param  Message $message The DisplayMessage object to relate
     * @return Display The current object (for fluent API support)
     */
    public function addMessage(Message $message)
    {
        if ($this->collMessages === null) {
            $this->initMessages();
        }
        if (!$this->collMessages->contains($message)) { // only add it if the **same** object is not already associated
            $this->doAddMessage($message);

            $this->collMessages[]= $message;
        }

        return $this;
    }

    /**
     * @param	Message $message The message object to add.
     */
    protected function doAddMessage($message)
    {
        $displayMessage = new DisplayMessage();
        $displayMessage->setMessage($message);
        $this->addDisplayMessage($displayMessage);
    }

    /**
     * Remove a Message object to this object
     * through the display_message cross reference table.
     *
     * @param Message $message The DisplayMessage object to relate
     * @return Display The current object (for fluent API support)
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
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collDisplayMessages) {
                foreach ($this->collDisplayMessages as $o) {
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

        if ($this->collDisplayMessages instanceof PropelCollection) {
            $this->collDisplayMessages->clearIterator();
        }
        $this->collDisplayMessages = null;
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
        return (string) $this->exportTo(DisplayPeer::DEFAULT_STRING_FORMAT);
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
