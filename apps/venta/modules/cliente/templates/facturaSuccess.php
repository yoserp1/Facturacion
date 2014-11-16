<script type="text/javascript">
Ext.ns("facturaCliente");
facturaCliente.main = {
condicion:function(codigo){
    return (codigo=='0')?'NO':'SI';
},
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});

//<ClavePrimaria>
this.co_cliente = new Ext.form.Hidden({
    name:'co_cliente',
    value:this.OBJ.co_cliente});
//</ClavePrimaria>

//Mascara general del modulo
this.mascara = new Ext.LoadMask(Ext.getBody(), {msg:"Cargando..."});

//objeto store
this.store_lista = this.getLista();

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtrofactura');
        facturaCliente.main.mascara.show();
        facturaCliente.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/cliente/filtrofactura',
             scripts: true,
	     params: {co_cliente:facturaCliente.main.co_cliente.getValue()},
        });
    }
});

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
//    title:'Lista de factura',
    iconCls: 'icon-libro',
    store: this.store_lista,
    loadMask:true,
    border:false,
//    frame:true,
//    height:550,
    autoWidth: true,
    autoHeight:true,
    tbar:[
        this.filtro
    ],
    columns: [
    new Ext.grid.RowNumberer(),
    {header: 'Codigo',width:60,  menuDisabled:true, sortable: true,dataIndex: 'co_factura'},
    {header: 'Fecha', width:70,  menuDisabled:true, sortable: true,  dataIndex: 'fe_factura'},
    {header: 'Monto Neto', width:90,  menuDisabled:true, sortable: true,  dataIndex: 'mo_neto'},
    {header: 'Monto I.V.A', width:90,  menuDisabled:true, sortable: true,  dataIndex: 'mo_iva'},
    {header: 'Monto Total', width:90,  menuDisabled:true, sortable: true,  dataIndex: 'mo_total'},
    {header: 'Tipo Factura', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_tipo_factura'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    bbar: new Ext.PagingToolbar({
        pageSize: 10,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:black">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:black\">No se encontraron registros</span>"
    })
});

this.gridPanel_.render("contenedorfacturaCliente");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.baseParams.co_cliente = this.OBJ.co_cliente;
this.store_lista.load();
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/cliente/storelistafactura',
    root:'data',
    fields:[
    {name: 'co_factura'},
    {name: 'co_cliente'},
    {name: 'fe_factura'},
    {name: 'nu_iva'},
    {name: 'mo_neto'},
    {name: 'mo_iva'},
    {name: 'mo_total'},
    {name: 'co_usuario'},
    {name: 'co_tipo_factura'},
    {name: 'fecha_creacion'},
           ]
    });
    return this.store;
}
};
Ext.onReady(facturaCliente.main.init, facturaCliente.main);
</script>
<div id="contenedorfacturaCliente"></div>
<div id="formulariofactura"></div>
<div id="filtrofactura"></div>
