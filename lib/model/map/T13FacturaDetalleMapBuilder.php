<?php


/**
 * This class adds structure of 't13_factura_detalle' table to 'propel' DatabaseMap object.
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
class T13FacturaDetalleMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.T13FacturaDetalleMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(T13FacturaDetallePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(T13FacturaDetallePeer::TABLE_NAME);
		$tMap->setPhpName('T13FacturaDetalle');
		$tMap->setClassname('T13FacturaDetalle');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('t13_factura_detalle_co_factura_detalle_seq');

		$tMap->addPrimaryKey('CO_FACTURA_DETALLE', 'CoFacturaDetalle', 'BIGINT', true, null);

		$tMap->addForeignKey('CO_FACTURA', 'CoFactura', 'BIGINT', 't12_factura', 'CO_FACTURA', true, null);

		$tMap->addForeignKey('CO_PRODUCTO', 'CoProducto', 'INTEGER', 't07_producto', 'CO_PRODUCTO', true, null);

		$tMap->addColumn('MO_UNITARIO', 'MoUnitario', 'NUMERIC', true, 10);

		$tMap->addColumn('NU_CANTIDAD', 'NuCantidad', 'NUMERIC', true, null);

		$tMap->addColumn('NU_IVA', 'NuIva', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_NETO', 'MoNeto', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_IVA', 'MoIva', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_TOTAL', 'MoTotal', 'NUMERIC', false, 10);

	} // doBuild()

} // T13FacturaDetalleMapBuilder
