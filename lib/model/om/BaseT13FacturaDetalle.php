<?php

/**
 * Base class that represents a row from the 't13_factura_detalle' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Aug 20 18:05:54 2013
 *
 * @package    lib.model.om
 */
abstract class BaseT13FacturaDetalle extends BaseObject  implements Persistent {


  const PEER = 'T13FacturaDetallePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        T13FacturaDetallePeer
	 */
	protected static $peer;

	/**
	 * The value for the co_factura_detalle field.
	 * @var        string
	 */
	protected $co_factura_detalle;

	/**
	 * The value for the co_factura field.
	 * @var        string
	 */
	protected $co_factura;

	/**
	 * The value for the co_producto field.
	 * @var        int
	 */
	protected $co_producto;

	/**
	 * The value for the mo_unitario field.
	 * @var        string
	 */
	protected $mo_unitario;

	/**
	 * The value for the nu_cantidad field.
	 * @var        string
	 */
	protected $nu_cantidad;

	/**
	 * The value for the nu_iva field.
	 * @var        string
	 */
	protected $nu_iva;

	/**
	 * The value for the mo_neto field.
	 * @var        string
	 */
	protected $mo_neto;

	/**
	 * The value for the mo_iva field.
	 * @var        string
	 */
	protected $mo_iva;

	/**
	 * The value for the mo_total field.
	 * @var        string
	 */
	protected $mo_total;

	/**
	 * @var        T12Factura
	 */
	protected $aT12Factura;

	/**
	 * @var        T07Producto
	 */
	protected $aT07Producto;

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
	 * Initializes internal state of BaseT13FacturaDetalle object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [co_factura_detalle] column value.
	 * 
	 * @return     string
	 */
	public function getCoFacturaDetalle()
	{
		return $this->co_factura_detalle;
	}

	/**
	 * Get the [co_factura] column value.
	 * 
	 * @return     string
	 */
	public function getCoFactura()
	{
		return $this->co_factura;
	}

	/**
	 * Get the [co_producto] column value.
	 * 
	 * @return     int
	 */
	public function getCoProducto()
	{
		return $this->co_producto;
	}

	/**
	 * Get the [mo_unitario] column value.
	 * 
	 * @return     string
	 */
	public function getMoUnitario()
	{
		return $this->mo_unitario;
	}

	/**
	 * Get the [nu_cantidad] column value.
	 * 
	 * @return     string
	 */
	public function getNuCantidad()
	{
		return $this->nu_cantidad;
	}

	/**
	 * Get the [nu_iva] column value.
	 * 
	 * @return     string
	 */
	public function getNuIva()
	{
		return $this->nu_iva;
	}

	/**
	 * Get the [mo_neto] column value.
	 * 
	 * @return     string
	 */
	public function getMoNeto()
	{
		return $this->mo_neto;
	}

	/**
	 * Get the [mo_iva] column value.
	 * 
	 * @return     string
	 */
	public function getMoIva()
	{
		return $this->mo_iva;
	}

	/**
	 * Get the [mo_total] column value.
	 * 
	 * @return     string
	 */
	public function getMoTotal()
	{
		return $this->mo_total;
	}

	/**
	 * Set the value of [co_factura_detalle] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setCoFacturaDetalle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->co_factura_detalle !== $v) {
			$this->co_factura_detalle = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::CO_FACTURA_DETALLE;
		}

		return $this;
	} // setCoFacturaDetalle()

	/**
	 * Set the value of [co_factura] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setCoFactura($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->co_factura !== $v) {
			$this->co_factura = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::CO_FACTURA;
		}

		if ($this->aT12Factura !== null && $this->aT12Factura->getCoFactura() !== $v) {
			$this->aT12Factura = null;
		}

		return $this;
	} // setCoFactura()

	/**
	 * Set the value of [co_producto] column.
	 * 
	 * @param      int $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setCoProducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->co_producto !== $v) {
			$this->co_producto = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::CO_PRODUCTO;
		}

		if ($this->aT07Producto !== null && $this->aT07Producto->getCoProducto() !== $v) {
			$this->aT07Producto = null;
		}

		return $this;
	} // setCoProducto()

	/**
	 * Set the value of [mo_unitario] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setMoUnitario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mo_unitario !== $v) {
			$this->mo_unitario = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::MO_UNITARIO;
		}

		return $this;
	} // setMoUnitario()

	/**
	 * Set the value of [nu_cantidad] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setNuCantidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nu_cantidad !== $v) {
			$this->nu_cantidad = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::NU_CANTIDAD;
		}

		return $this;
	} // setNuCantidad()

	/**
	 * Set the value of [nu_iva] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setNuIva($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nu_iva !== $v) {
			$this->nu_iva = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::NU_IVA;
		}

		return $this;
	} // setNuIva()

	/**
	 * Set the value of [mo_neto] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setMoNeto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mo_neto !== $v) {
			$this->mo_neto = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::MO_NETO;
		}

		return $this;
	} // setMoNeto()

	/**
	 * Set the value of [mo_iva] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setMoIva($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mo_iva !== $v) {
			$this->mo_iva = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::MO_IVA;
		}

		return $this;
	} // setMoIva()

	/**
	 * Set the value of [mo_total] column.
	 * 
	 * @param      string $v new value
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 */
	public function setMoTotal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mo_total !== $v) {
			$this->mo_total = $v;
			$this->modifiedColumns[] = T13FacturaDetallePeer::MO_TOTAL;
		}

		return $this;
	} // setMoTotal()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->co_factura_detalle = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->co_factura = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->co_producto = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->mo_unitario = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->nu_cantidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->nu_iva = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->mo_neto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->mo_iva = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->mo_total = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = T13FacturaDetallePeer::NUM_COLUMNS - T13FacturaDetallePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating T13FacturaDetalle object", $e);
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
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aT12Factura !== null && $this->co_factura !== $this->aT12Factura->getCoFactura()) {
			$this->aT12Factura = null;
		}
		if ($this->aT07Producto !== null && $this->co_producto !== $this->aT07Producto->getCoProducto()) {
			$this->aT07Producto = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
			$con = Propel::getConnection(T13FacturaDetallePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = T13FacturaDetallePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aT12Factura = null;
			$this->aT07Producto = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseT13FacturaDetalle:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(T13FacturaDetallePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			T13FacturaDetallePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseT13FacturaDetalle:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseT13FacturaDetalle:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(T13FacturaDetallePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseT13FacturaDetalle:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			T13FacturaDetallePeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aT12Factura !== null) {
				if ($this->aT12Factura->isModified() || $this->aT12Factura->isNew()) {
					$affectedRows += $this->aT12Factura->save($con);
				}
				$this->setT12Factura($this->aT12Factura);
			}

			if ($this->aT07Producto !== null) {
				if ($this->aT07Producto->isModified() || $this->aT07Producto->isNew()) {
					$affectedRows += $this->aT07Producto->save($con);
				}
				$this->setT07Producto($this->aT07Producto);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = T13FacturaDetallePeer::CO_FACTURA_DETALLE;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = T13FacturaDetallePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCoFacturaDetalle($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += T13FacturaDetallePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
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
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aT12Factura !== null) {
				if (!$this->aT12Factura->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aT12Factura->getValidationFailures());
				}
			}

			if ($this->aT07Producto !== null) {
				if (!$this->aT07Producto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aT07Producto->getValidationFailures());
				}
			}


			if (($retval = T13FacturaDetallePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = T13FacturaDetallePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCoFacturaDetalle();
				break;
			case 1:
				return $this->getCoFactura();
				break;
			case 2:
				return $this->getCoProducto();
				break;
			case 3:
				return $this->getMoUnitario();
				break;
			case 4:
				return $this->getNuCantidad();
				break;
			case 5:
				return $this->getNuIva();
				break;
			case 6:
				return $this->getMoNeto();
				break;
			case 7:
				return $this->getMoIva();
				break;
			case 8:
				return $this->getMoTotal();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = T13FacturaDetallePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCoFacturaDetalle(),
			$keys[1] => $this->getCoFactura(),
			$keys[2] => $this->getCoProducto(),
			$keys[3] => $this->getMoUnitario(),
			$keys[4] => $this->getNuCantidad(),
			$keys[5] => $this->getNuIva(),
			$keys[6] => $this->getMoNeto(),
			$keys[7] => $this->getMoIva(),
			$keys[8] => $this->getMoTotal(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = T13FacturaDetallePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCoFacturaDetalle($value);
				break;
			case 1:
				$this->setCoFactura($value);
				break;
			case 2:
				$this->setCoProducto($value);
				break;
			case 3:
				$this->setMoUnitario($value);
				break;
			case 4:
				$this->setNuCantidad($value);
				break;
			case 5:
				$this->setNuIva($value);
				break;
			case 6:
				$this->setMoNeto($value);
				break;
			case 7:
				$this->setMoIva($value);
				break;
			case 8:
				$this->setMoTotal($value);
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
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = T13FacturaDetallePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCoFacturaDetalle($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCoFactura($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCoProducto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMoUnitario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNuCantidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNuIva($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMoNeto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMoIva($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMoTotal($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(T13FacturaDetallePeer::DATABASE_NAME);

		if ($this->isColumnModified(T13FacturaDetallePeer::CO_FACTURA_DETALLE)) $criteria->add(T13FacturaDetallePeer::CO_FACTURA_DETALLE, $this->co_factura_detalle);
		if ($this->isColumnModified(T13FacturaDetallePeer::CO_FACTURA)) $criteria->add(T13FacturaDetallePeer::CO_FACTURA, $this->co_factura);
		if ($this->isColumnModified(T13FacturaDetallePeer::CO_PRODUCTO)) $criteria->add(T13FacturaDetallePeer::CO_PRODUCTO, $this->co_producto);
		if ($this->isColumnModified(T13FacturaDetallePeer::MO_UNITARIO)) $criteria->add(T13FacturaDetallePeer::MO_UNITARIO, $this->mo_unitario);
		if ($this->isColumnModified(T13FacturaDetallePeer::NU_CANTIDAD)) $criteria->add(T13FacturaDetallePeer::NU_CANTIDAD, $this->nu_cantidad);
		if ($this->isColumnModified(T13FacturaDetallePeer::NU_IVA)) $criteria->add(T13FacturaDetallePeer::NU_IVA, $this->nu_iva);
		if ($this->isColumnModified(T13FacturaDetallePeer::MO_NETO)) $criteria->add(T13FacturaDetallePeer::MO_NETO, $this->mo_neto);
		if ($this->isColumnModified(T13FacturaDetallePeer::MO_IVA)) $criteria->add(T13FacturaDetallePeer::MO_IVA, $this->mo_iva);
		if ($this->isColumnModified(T13FacturaDetallePeer::MO_TOTAL)) $criteria->add(T13FacturaDetallePeer::MO_TOTAL, $this->mo_total);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(T13FacturaDetallePeer::DATABASE_NAME);

		$criteria->add(T13FacturaDetallePeer::CO_FACTURA_DETALLE, $this->co_factura_detalle);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCoFacturaDetalle();
	}

	/**
	 * Generic method to set the primary key (co_factura_detalle column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCoFacturaDetalle($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of T13FacturaDetalle (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCoFactura($this->co_factura);

		$copyObj->setCoProducto($this->co_producto);

		$copyObj->setMoUnitario($this->mo_unitario);

		$copyObj->setNuCantidad($this->nu_cantidad);

		$copyObj->setNuIva($this->nu_iva);

		$copyObj->setMoNeto($this->mo_neto);

		$copyObj->setMoIva($this->mo_iva);

		$copyObj->setMoTotal($this->mo_total);


		$copyObj->setNew(true);

		$copyObj->setCoFacturaDetalle(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     T13FacturaDetalle Clone of current object.
	 * @throws     PropelException
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
	 * @return     T13FacturaDetallePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new T13FacturaDetallePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a T12Factura object.
	 *
	 * @param      T12Factura $v
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setT12Factura(T12Factura $v = null)
	{
		if ($v === null) {
			$this->setCoFactura(NULL);
		} else {
			$this->setCoFactura($v->getCoFactura());
		}

		$this->aT12Factura = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the T12Factura object, it will not be re-added.
		if ($v !== null) {
			$v->addT13FacturaDetalle($this);
		}

		return $this;
	}


	/**
	 * Get the associated T12Factura object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     T12Factura The associated T12Factura object.
	 * @throws     PropelException
	 */
	public function getT12Factura(PropelPDO $con = null)
	{
		if ($this->aT12Factura === null && (($this->co_factura !== "" && $this->co_factura !== null))) {
			$c = new Criteria(T12FacturaPeer::DATABASE_NAME);
			$c->add(T12FacturaPeer::CO_FACTURA, $this->co_factura);
			$this->aT12Factura = T12FacturaPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aT12Factura->addT13FacturaDetalles($this);
			 */
		}
		return $this->aT12Factura;
	}

	/**
	 * Declares an association between this object and a T07Producto object.
	 *
	 * @param      T07Producto $v
	 * @return     T13FacturaDetalle The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setT07Producto(T07Producto $v = null)
	{
		if ($v === null) {
			$this->setCoProducto(NULL);
		} else {
			$this->setCoProducto($v->getCoProducto());
		}

		$this->aT07Producto = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the T07Producto object, it will not be re-added.
		if ($v !== null) {
			$v->addT13FacturaDetalle($this);
		}

		return $this;
	}


	/**
	 * Get the associated T07Producto object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     T07Producto The associated T07Producto object.
	 * @throws     PropelException
	 */
	public function getT07Producto(PropelPDO $con = null)
	{
		if ($this->aT07Producto === null && ($this->co_producto !== null)) {
			$c = new Criteria(T07ProductoPeer::DATABASE_NAME);
			$c->add(T07ProductoPeer::CO_PRODUCTO, $this->co_producto);
			$this->aT07Producto = T07ProductoPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aT07Producto->addT13FacturaDetalles($this);
			 */
		}
		return $this->aT07Producto;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aT12Factura = null;
			$this->aT07Producto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseT13FacturaDetalle:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseT13FacturaDetalle::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseT13FacturaDetalle
