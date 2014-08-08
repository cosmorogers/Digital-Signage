<?php


/**
 * Base class that represents a row from the 'image' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseImage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ImagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ImagePeer
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
     * The value for the filename field.
     * @var        string
     */
    protected $filename;

    /**
     * The value for the date field.
     * @var        string
     */
    protected $date;

    /**
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * @var        User
     */
    protected $aUser;

    /**
     * @var        PropelObjectCollection|SlideshowImage[] Collection to store aggregation of SlideshowImage objects.
     */
    protected $collSlideshowImages;
    protected $collSlideshowImagesPartial;

    /**
     * @var        PropelObjectCollection|Slideshow[] Collection to store aggregation of Slideshow objects.
     */
    protected $collSlideshows;

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
    protected $slideshowsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $slideshowImagesScheduledForDeletion = null;

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
     * Get the [filename] column value.
     *
     * @return string
     */
    public function getFilename()
    {

        return $this->filename;
    }

    /**
     * Get the [optionally formatted] temporal [date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d H:i:s')
    {
        if ($this->date === null) {
            return null;
        }

        if ($this->date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date, true), $x);
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
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {

        return $this->user_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Image The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ImagePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Image The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ImagePeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [filename] column.
     *
     * @param  string $v new value
     * @return Image The current object (for fluent API support)
     */
    public function setFilename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->filename !== $v) {
            $this->filename = $v;
            $this->modifiedColumns[] = ImagePeer::FILENAME;
        }


        return $this;
    } // setFilename()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Image The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            $currentDateAsString = ($this->date !== null && $tmpDt = new DateTime($this->date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date = $newDateAsString;
                $this->modifiedColumns[] = ImagePeer::DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Set the value of [user_id] column.
     *
     * @param  int $v new value
     * @return Image The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[] = ImagePeer::USER_ID;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserId()

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
            $this->filename = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->user_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 5; // 5 = ImagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Image object", $e);
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

        if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
            $this->aUser = null;
        }
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
            $con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ImagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->collSlideshowImages = null;

            $this->collSlideshows = null;
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
            $con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ImageQuery::create()
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
            $con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ImagePeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

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

            if ($this->slideshowsScheduledForDeletion !== null) {
                if (!$this->slideshowsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->slideshowsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    SlideshowImageQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->slideshowsScheduledForDeletion = null;
                }

                foreach ($this->getSlideshows() as $slideshow) {
                    if ($slideshow->isModified()) {
                        $slideshow->save($con);
                    }
                }
            } elseif ($this->collSlideshows) {
                foreach ($this->collSlideshows as $slideshow) {
                    if ($slideshow->isModified()) {
                        $slideshow->save($con);
                    }
                }
            }

            if ($this->slideshowImagesScheduledForDeletion !== null) {
                if (!$this->slideshowImagesScheduledForDeletion->isEmpty()) {
                    SlideshowImageQuery::create()
                        ->filterByPrimaryKeys($this->slideshowImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->slideshowImagesScheduledForDeletion = null;
                }
            }

            if ($this->collSlideshowImages !== null) {
                foreach ($this->collSlideshowImages as $referrerFK) {
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

        $this->modifiedColumns[] = ImagePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ImagePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ImagePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ImagePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(ImagePeer::FILENAME)) {
            $modifiedColumns[':p' . $index++]  = '`filename`';
        }
        if ($this->isColumnModified(ImagePeer::DATE)) {
            $modifiedColumns[':p' . $index++]  = '`date`';
        }
        if ($this->isColumnModified(ImagePeer::USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`user_id`';
        }

        $sql = sprintf(
            'INSERT INTO `image` (%s) VALUES (%s)',
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
                    case '`filename`':
                        $stmt->bindValue($identifier, $this->filename, PDO::PARAM_STR);
                        break;
                    case '`date`':
                        $stmt->bindValue($identifier, $this->date, PDO::PARAM_STR);
                        break;
                    case '`user_id`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if (!$this->aUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
                }
            }


            if (($retval = ImagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collSlideshowImages !== null) {
                    foreach ($this->collSlideshowImages as $referrerFK) {
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
        $pos = ImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFilename();
                break;
            case 3:
                return $this->getDate();
                break;
            case 4:
                return $this->getUserId();
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
        if (isset($alreadyDumpedObjects['Image'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Image'][$this->getPrimaryKey()] = true;
        $keys = ImagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getFilename(),
            $keys[3] => $this->getDate(),
            $keys[4] => $this->getUserId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSlideshowImages) {
                $result['SlideshowImages'] = $this->collSlideshowImages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFilename($value);
                break;
            case 3:
                $this->setDate($value);
                break;
            case 4:
                $this->setUserId($value);
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
        $keys = ImagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFilename($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ImagePeer::DATABASE_NAME);

        if ($this->isColumnModified(ImagePeer::ID)) $criteria->add(ImagePeer::ID, $this->id);
        if ($this->isColumnModified(ImagePeer::NAME)) $criteria->add(ImagePeer::NAME, $this->name);
        if ($this->isColumnModified(ImagePeer::FILENAME)) $criteria->add(ImagePeer::FILENAME, $this->filename);
        if ($this->isColumnModified(ImagePeer::DATE)) $criteria->add(ImagePeer::DATE, $this->date);
        if ($this->isColumnModified(ImagePeer::USER_ID)) $criteria->add(ImagePeer::USER_ID, $this->user_id);

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
        $criteria = new Criteria(ImagePeer::DATABASE_NAME);
        $criteria->add(ImagePeer::ID, $this->id);

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
     * @param object $copyObj An object of Image (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setFilename($this->getFilename());
        $copyObj->setDate($this->getDate());
        $copyObj->setUserId($this->getUserId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getSlideshowImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSlideshowImage($relObj->copy($deepCopy));
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
     * @return Image Clone of current object.
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
     * @return ImagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ImagePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param                  User $v
     * @return Image The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(User $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addImage($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUser(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUser === null && ($this->user_id !== null) && $doQuery) {
            $this->aUser = UserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addImages($this);
             */
        }

        return $this->aUser;
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
        if ('SlideshowImage' == $relationName) {
            $this->initSlideshowImages();
        }
    }

    /**
     * Clears out the collSlideshowImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Image The current object (for fluent API support)
     * @see        addSlideshowImages()
     */
    public function clearSlideshowImages()
    {
        $this->collSlideshowImages = null; // important to set this to null since that means it is uninitialized
        $this->collSlideshowImagesPartial = null;

        return $this;
    }

    /**
     * reset is the collSlideshowImages collection loaded partially
     *
     * @return void
     */
    public function resetPartialSlideshowImages($v = true)
    {
        $this->collSlideshowImagesPartial = $v;
    }

    /**
     * Initializes the collSlideshowImages collection.
     *
     * By default this just sets the collSlideshowImages collection to an empty array (like clearcollSlideshowImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSlideshowImages($overrideExisting = true)
    {
        if (null !== $this->collSlideshowImages && !$overrideExisting) {
            return;
        }
        $this->collSlideshowImages = new PropelObjectCollection();
        $this->collSlideshowImages->setModel('SlideshowImage');
    }

    /**
     * Gets an array of SlideshowImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Image is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|SlideshowImage[] List of SlideshowImage objects
     * @throws PropelException
     */
    public function getSlideshowImages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSlideshowImagesPartial && !$this->isNew();
        if (null === $this->collSlideshowImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSlideshowImages) {
                // return empty collection
                $this->initSlideshowImages();
            } else {
                $collSlideshowImages = SlideshowImageQuery::create(null, $criteria)
                    ->filterByImage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSlideshowImagesPartial && count($collSlideshowImages)) {
                      $this->initSlideshowImages(false);

                      foreach ($collSlideshowImages as $obj) {
                        if (false == $this->collSlideshowImages->contains($obj)) {
                          $this->collSlideshowImages->append($obj);
                        }
                      }

                      $this->collSlideshowImagesPartial = true;
                    }

                    $collSlideshowImages->getInternalIterator()->rewind();

                    return $collSlideshowImages;
                }

                if ($partial && $this->collSlideshowImages) {
                    foreach ($this->collSlideshowImages as $obj) {
                        if ($obj->isNew()) {
                            $collSlideshowImages[] = $obj;
                        }
                    }
                }

                $this->collSlideshowImages = $collSlideshowImages;
                $this->collSlideshowImagesPartial = false;
            }
        }

        return $this->collSlideshowImages;
    }

    /**
     * Sets a collection of SlideshowImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $slideshowImages A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Image The current object (for fluent API support)
     */
    public function setSlideshowImages(PropelCollection $slideshowImages, PropelPDO $con = null)
    {
        $slideshowImagesToDelete = $this->getSlideshowImages(new Criteria(), $con)->diff($slideshowImages);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->slideshowImagesScheduledForDeletion = clone $slideshowImagesToDelete;

        foreach ($slideshowImagesToDelete as $slideshowImageRemoved) {
            $slideshowImageRemoved->setImage(null);
        }

        $this->collSlideshowImages = null;
        foreach ($slideshowImages as $slideshowImage) {
            $this->addSlideshowImage($slideshowImage);
        }

        $this->collSlideshowImages = $slideshowImages;
        $this->collSlideshowImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SlideshowImage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related SlideshowImage objects.
     * @throws PropelException
     */
    public function countSlideshowImages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSlideshowImagesPartial && !$this->isNew();
        if (null === $this->collSlideshowImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSlideshowImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSlideshowImages());
            }
            $query = SlideshowImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByImage($this)
                ->count($con);
        }

        return count($this->collSlideshowImages);
    }

    /**
     * Method called to associate a SlideshowImage object to this object
     * through the SlideshowImage foreign key attribute.
     *
     * @param    SlideshowImage $l SlideshowImage
     * @return Image The current object (for fluent API support)
     */
    public function addSlideshowImage(SlideshowImage $l)
    {
        if ($this->collSlideshowImages === null) {
            $this->initSlideshowImages();
            $this->collSlideshowImagesPartial = true;
        }

        if (!in_array($l, $this->collSlideshowImages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSlideshowImage($l);

            if ($this->slideshowImagesScheduledForDeletion and $this->slideshowImagesScheduledForDeletion->contains($l)) {
                $this->slideshowImagesScheduledForDeletion->remove($this->slideshowImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	SlideshowImage $slideshowImage The slideshowImage object to add.
     */
    protected function doAddSlideshowImage($slideshowImage)
    {
        $this->collSlideshowImages[]= $slideshowImage;
        $slideshowImage->setImage($this);
    }

    /**
     * @param	SlideshowImage $slideshowImage The slideshowImage object to remove.
     * @return Image The current object (for fluent API support)
     */
    public function removeSlideshowImage($slideshowImage)
    {
        if ($this->getSlideshowImages()->contains($slideshowImage)) {
            $this->collSlideshowImages->remove($this->collSlideshowImages->search($slideshowImage));
            if (null === $this->slideshowImagesScheduledForDeletion) {
                $this->slideshowImagesScheduledForDeletion = clone $this->collSlideshowImages;
                $this->slideshowImagesScheduledForDeletion->clear();
            }
            $this->slideshowImagesScheduledForDeletion[]= clone $slideshowImage;
            $slideshowImage->setImage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Image is new, it will return
     * an empty collection; or if this Image has previously
     * been saved, it will retrieve related SlideshowImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Image.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|SlideshowImage[] List of SlideshowImage objects
     */
    public function getSlideshowImagesJoinSlideshow($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SlideshowImageQuery::create(null, $criteria);
        $query->joinWith('Slideshow', $join_behavior);

        return $this->getSlideshowImages($query, $con);
    }

    /**
     * Clears out the collSlideshows collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Image The current object (for fluent API support)
     * @see        addSlideshows()
     */
    public function clearSlideshows()
    {
        $this->collSlideshows = null; // important to set this to null since that means it is uninitialized
        $this->collSlideshowsPartial = null;

        return $this;
    }

    /**
     * Initializes the collSlideshows collection.
     *
     * By default this just sets the collSlideshows collection to an empty collection (like clearSlideshows());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSlideshows()
    {
        $this->collSlideshows = new PropelObjectCollection();
        $this->collSlideshows->setModel('Slideshow');
    }

    /**
     * Gets a collection of Slideshow objects related by a many-to-many relationship
     * to the current object by way of the slideshow_image cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Image is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Slideshow[] List of Slideshow objects
     */
    public function getSlideshows($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collSlideshows || null !== $criteria) {
            if ($this->isNew() && null === $this->collSlideshows) {
                // return empty collection
                $this->initSlideshows();
            } else {
                $collSlideshows = SlideshowQuery::create(null, $criteria)
                    ->filterByImage($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collSlideshows;
                }
                $this->collSlideshows = $collSlideshows;
            }
        }

        return $this->collSlideshows;
    }

    /**
     * Sets a collection of Slideshow objects related by a many-to-many relationship
     * to the current object by way of the slideshow_image cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $slideshows A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Image The current object (for fluent API support)
     */
    public function setSlideshows(PropelCollection $slideshows, PropelPDO $con = null)
    {
        $this->clearSlideshows();
        $currentSlideshows = $this->getSlideshows(null, $con);

        $this->slideshowsScheduledForDeletion = $currentSlideshows->diff($slideshows);

        foreach ($slideshows as $slideshow) {
            if (!$currentSlideshows->contains($slideshow)) {
                $this->doAddSlideshow($slideshow);
            }
        }

        $this->collSlideshows = $slideshows;

        return $this;
    }

    /**
     * Gets the number of Slideshow objects related by a many-to-many relationship
     * to the current object by way of the slideshow_image cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Slideshow objects
     */
    public function countSlideshows($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collSlideshows || null !== $criteria) {
            if ($this->isNew() && null === $this->collSlideshows) {
                return 0;
            } else {
                $query = SlideshowQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByImage($this)
                    ->count($con);
            }
        } else {
            return count($this->collSlideshows);
        }
    }

    /**
     * Associate a Slideshow object to this object
     * through the slideshow_image cross reference table.
     *
     * @param  Slideshow $slideshow The SlideshowImage object to relate
     * @return Image The current object (for fluent API support)
     */
    public function addSlideshow(Slideshow $slideshow)
    {
        if ($this->collSlideshows === null) {
            $this->initSlideshows();
        }

        if (!$this->collSlideshows->contains($slideshow)) { // only add it if the **same** object is not already associated
            $this->doAddSlideshow($slideshow);
            $this->collSlideshows[] = $slideshow;

            if ($this->slideshowsScheduledForDeletion and $this->slideshowsScheduledForDeletion->contains($slideshow)) {
                $this->slideshowsScheduledForDeletion->remove($this->slideshowsScheduledForDeletion->search($slideshow));
            }
        }

        return $this;
    }

    /**
     * @param	Slideshow $slideshow The slideshow object to add.
     */
    protected function doAddSlideshow(Slideshow $slideshow)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$slideshow->getImages()->contains($this)) { $slideshowImage = new SlideshowImage();
            $slideshowImage->setSlideshow($slideshow);
            $this->addSlideshowImage($slideshowImage);

            $foreignCollection = $slideshow->getImages();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Slideshow object to this object
     * through the slideshow_image cross reference table.
     *
     * @param Slideshow $slideshow The SlideshowImage object to relate
     * @return Image The current object (for fluent API support)
     */
    public function removeSlideshow(Slideshow $slideshow)
    {
        if ($this->getSlideshows()->contains($slideshow)) {
            $this->collSlideshows->remove($this->collSlideshows->search($slideshow));
            if (null === $this->slideshowsScheduledForDeletion) {
                $this->slideshowsScheduledForDeletion = clone $this->collSlideshows;
                $this->slideshowsScheduledForDeletion->clear();
            }
            $this->slideshowsScheduledForDeletion[]= $slideshow;
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
        $this->filename = null;
        $this->date = null;
        $this->user_id = null;
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
            if ($this->collSlideshowImages) {
                foreach ($this->collSlideshowImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSlideshows) {
                foreach ($this->collSlideshows as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aUser instanceof Persistent) {
              $this->aUser->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collSlideshowImages instanceof PropelCollection) {
            $this->collSlideshowImages->clearIterator();
        }
        $this->collSlideshowImages = null;
        if ($this->collSlideshows instanceof PropelCollection) {
            $this->collSlideshows->clearIterator();
        }
        $this->collSlideshows = null;
        $this->aUser = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ImagePeer::DEFAULT_STRING_FORMAT);
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
