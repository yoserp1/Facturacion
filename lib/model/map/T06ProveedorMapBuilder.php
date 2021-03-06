<?php


/**
 * This class adds structure of 't06_proveedor' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Tue Aug 20 18:05:54 2013
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class T06ProveedorMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.T06ProveedorMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(T06ProveedorPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(T06ProveedorPeer::TABLE_NAME);
		$tMap->setPhpName('T06Proveedor');
		$tMap->setClassname('T06Proveedor');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('t06_proveedor_co_proveedor_seq');

		$tMap->addPrimaryKey('CO_PROVEEDOR', 'CoProveedor', 'BIGINT', true, null);

		$tMap->addForeignKey('CO_DOCUMENTO', 'CoDocumento', 'INTEGER', 't05_documento', 'CO_DOCUMENTO', true, null);

		$tMap->addColumn('TX_DNI', 'TxDni', 'VARCHAR', true, 255);

		$tMap->addColumn('TX_NOMBRE', 'TxNombre', 'VARCHAR', true, 255);

		$tMap->addColumn('TX_DIRECCION', 'TxDireccion', 'VARCHAR', false, 255);

		$tMap->addColumn('TX_TELEFONO', 'TxTelefono', 'VARCHAR', true, 255);

	} // doBuild()

} // T06ProveedorMapBuilder
