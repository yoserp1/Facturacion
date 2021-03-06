<?php


/**
 * This class adds structure of 't03_menu' table to 'propel' DatabaseMap object.
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
class T03MenuMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.T03MenuMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(T03MenuPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(T03MenuPeer::TABLE_NAME);
		$tMap->setPhpName('T03Menu');
		$tMap->setClassname('T03Menu');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('t03_menu_co_menu_seq');

		$tMap->addPrimaryKey('CO_MENU', 'CoMenu', 'BIGINT', true, null);

		$tMap->addColumn('TX_MENU', 'TxMenu', 'VARCHAR', false, 50);

		$tMap->addColumn('CO_PADRE', 'CoPadre', 'BIGINT', false, null);

		$tMap->addColumn('TX_HREF', 'TxHref', 'VARCHAR', false, 100);

		$tMap->addColumn('CO_SUB_MENU', 'CoSubMenu', 'VARCHAR', false, 50);

		$tMap->addColumn('TX_ICONO', 'TxIcono', 'VARCHAR', false, 255);

		$tMap->addColumn('NU_ORDEN', 'NuOrden', 'INTEGER', false, null);

	} // doBuild()

} // T03MenuMapBuilder
