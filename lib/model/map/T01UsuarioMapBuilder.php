<?php


/**
 * This class adds structure of 't01_usuario' table to 'propel' DatabaseMap object.
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
class T01UsuarioMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.T01UsuarioMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(T01UsuarioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(T01UsuarioPeer::TABLE_NAME);
		$tMap->setPhpName('T01Usuario');
		$tMap->setClassname('T01Usuario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('t01_usuario_co_usuario_seq');

		$tMap->addPrimaryKey('CO_USUARIO', 'CoUsuario', 'INTEGER', true, null);

		$tMap->addColumn('NB_USUARIO', 'NbUsuario', 'VARCHAR', true, 50);

		$tMap->addColumn('AP_USUARIO', 'ApUsuario', 'VARCHAR', true, 50);

		$tMap->addColumn('NU_CEDULA', 'NuCedula', 'NUMERIC', true, null);

		$tMap->addColumn('TX_LOGIN', 'TxLogin', 'VARCHAR', true, 50);

		$tMap->addColumn('TX_PASSWORD', 'TxPassword', 'VARCHAR', true, 255);

		$tMap->addForeignKey('CO_ROL', 'CoRol', 'INTEGER', 't02_rol', 'CO_ROL', true, null);

		$tMap->addColumn('IN_ACTIVO', 'InActivo', 'BOOLEAN', true, null);

	} // doBuild()

} // T01UsuarioMapBuilder
