<script type="text/javascript">
Ext.ns("facturaLista");
facturaLista.main = {
condicion:function(codigo){
    return (codigo=='0')?'NO':'SI';
},
init:function(){
//Mascara general del modulo
this.mascara = new Ext.LoadMask(Ext.getBody(), {msg:"Cargando..."});

//objeto store
this.store_lista = this.getLista();

//Agregar un registro
this.nuevo = new Ext.Button({
    text:'Nuevo',
    iconCls: 'icon-nuevo',
    handler:function(){
        facturaLista.main.mascara.show();
        this.msg = Ext.get('formulariofactura');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/editar",
         scripts: true,
         text: "Cargando.."
        });
    }
});

//Editar un registro
this.editar= new Ext.Button({
    text:'Editar',
    iconCls: 'icon-editar',
    handler:function(){
	this.codigo  = facturaLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura');
	facturaLista.main.mascara.show();
        this.msg = Ext.get('formulariofactura');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/editar/codigo/"+this.codigo,
         scripts: true,
         text: "Cargando.."
        });
    }
});

//Eliminar un registro
this.eliminar= new Ext.Button({
    text:'Eliminar',
    iconCls: 'icon-eliminar',
    handler:function(){
	this.codigo  = facturaLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura');
	Ext.MessageBox.confirm('Confirmación', '¿Realmente desea eliminar este registro?', function(boton){
	if(boton=="yes"){
        Ext.Ajax.request({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/eliminar',
            params:{
                co_factura:facturaLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura')
            },
            success:function(result, request ) {
                obj = Ext.util.JSON.decode(result.responseText);
                if(obj.success==true){
		    facturaLista.main.store_lista.load();
                    Ext.Msg.alert("Notificación",obj.msg);
                }else{
                    Ext.Msg.alert("Notificación",obj.msg);
                }
                facturaLista.main.mascara.hide();
            }});
	}});
    }
});

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtrofactura');
        facturaLista.main.mascara.show();
        facturaLista.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/filtro',
             scripts: true
        });
    }
});

this.editar.disable();
this.eliminar.disable();

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    title:'Lista de factura',
    iconCls: 'icon-libro',
    store: this.store_lista,
    loadMask:true,
//    frame:true,
//    height:550,
    autoWidth: true,
    autoHeight:true,
    tbar:[
        this.nuevo,'-',this.editar,'-',this.eliminar,'-',this.filtro
    ],
    columns: [
    new Ext.grid.RowNumberer(),
    {header: 'co_factura',hidden:true, menuDisabled:true,dataIndex: 'co_factura'},
    {header: 'Co cliente', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_cliente'},
    {header: 'Fe factura', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'fe_factura'},
    {header: 'Nu iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_iva'},
    {header: 'Mo neto', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_neto'},
    {header: 'Mo iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_iva'},
    {header: 'Mo total', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_total'},
    {header: 'Co usuario', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_usuario'},
    {header: 'Co tipo factura', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_tipo_factura'},
    {header: 'Fecha creacion', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'fecha_creacion'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){facturaLista.main.editar.enable();facturaLista.main.eliminar.enable();}},
    bbar: new Ext.PagingToolbar({
        pageSize: 20,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:white">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:white\">No se encontraron registros</span>"
    })
});

this.gridPanel_.render("contenedorfacturaLista");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.load();
this.store_lista.on('load',function(){
facturaLista.main.editar.disable();
facturaLista.main.eliminar.disable();
});
this.store_lista.on('beforeload',function(){
panel_detalle.collapse();
});
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/storelista',
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
Ext.onReady(facturaLista.main.init, facturaLista.main);
</script>
<div id="contenedorfacturaLista"></div>
<div id="formulariofactura"></div>
<div id="filtrofactura"></div>
