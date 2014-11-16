<?php


/**
 * This class adds structure of 't12_factura' table to 'propel' DatabaseMap object.
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
class T12FacturaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.T12FacturaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(T12FacturaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(T12FacturaPeer::TABLE_NAME);
		$tMap->setPhpName('T12Factura');
		$tMap->setClassname('T12Factura');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('t12_factura_co_factura_seq');

		$tMap->addPrimaryKey('CO_FACTURA', 'CoFactura', 'BIGINT', true, null);

		$tMap->addForeignKey('CO_CLIENTE', 'CoCliente', 'INTEGER', 't10_cliente', 'CO_CLIENTE', true, null);

		$tMap->addColumn('FE_FACTURA', 'FeFactura', 'DATE', true, null);

		$tMap->addColumn('NU_IVA', 'NuIva', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_NETO', 'MoNeto', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_IVA', 'MoIva', 'NUMERIC', false, 10);

		$tMap->addColumn('MO_TOTAL', 'MoTotal', 'NUMERIC', false, 10);

		$tMap->addColumn('CO_USUARIO', 'CoUsuario', 'INTEGER', true, null);

		$tMap->addForeignKey('CO_TIPO_FACTURA', 'CoTipoFactura', 'INTEGER', 't11_tipo_factura', 'CO_TIPO_FACTURA', true, null);

		$tMap->addColumn('FECHA_CREACION', 'FechaCreacion', 'TIMESTAMP', true, null);

	} // doBuild()

} // T12FacturaMapBuilder