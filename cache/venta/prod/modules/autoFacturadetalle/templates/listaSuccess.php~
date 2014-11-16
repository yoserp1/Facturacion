<script type="text/javascript">
Ext.ns("facturadetalleLista");
facturadetalleLista.main = {
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
        facturadetalleLista.main.mascara.show();
        this.msg = Ext.get('formulariofacturadetalle');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/editar",
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
	this.codigo  = facturadetalleLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura_detalle');
	facturadetalleLista.main.mascara.show();
        this.msg = Ext.get('formulariofacturadetalle');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/editar/codigo/"+this.codigo,
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
	this.codigo  = facturadetalleLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura_detalle');
	Ext.MessageBox.confirm('Confirmación', '¿Realmente desea eliminar este registro?', function(boton){
	if(boton=="yes"){
        Ext.Ajax.request({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/eliminar',
            params:{
                co_factura_detalle:facturadetalleLista.main.gridPanel_.getSelectionModel().getSelected().get('co_factura_detalle')
            },
            success:function(result, request ) {
                obj = Ext.util.JSON.decode(result.responseText);
                if(obj.success==true){
		    facturadetalleLista.main.store_lista.load();
                    Ext.Msg.alert("Notificación",obj.msg);
                }else{
                    Ext.Msg.alert("Notificación",obj.msg);
                }
                facturadetalleLista.main.mascara.hide();
            }});
	}});
    }
});

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtrofacturadetalle');
        facturadetalleLista.main.mascara.show();
        facturadetalleLista.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/filtro',
             scripts: true
        });
    }
});

this.editar.disable();
this.eliminar.disable();

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    title:'Lista de facturadetalle',
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
    {header: 'co_factura_detalle',hidden:true, menuDisabled:true,dataIndex: 'co_factura_detalle'},
    {header: 'Co factura', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_factura'},
    {header: 'Co producto', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_producto'},
    {header: 'Mo unitario', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_unitario'},
    {header: 'Nu cantidad', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_cantidad'},
    {header: 'Nu iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_iva'},
    {header: 'Mo neto', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_neto'},
    {header: 'Mo iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_iva'},
    {header: 'Mo total', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_total'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){facturadetalleLista.main.editar.enable();facturadetalleLista.main.eliminar.enable();}},
    bbar: new Ext.PagingToolbar({
        pageSize: 20,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:white">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:white\">No se encontraron registros</span>"
    })
});

this.gridPanel_.render("contenedorfacturadetalleLista");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.load();
this.store_lista.on('load',function(){
facturadetalleLista.main.editar.disable();
facturadetalleLista.main.eliminar.disable();
});
this.store_lista.on('beforeload',function(){
panel_detalle.collapse();
});
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storelista',
    root:'data',
    fields:[
    {name: 'co_factura_detalle'},
    {name: 'co_factura'},
    {name: 'co_producto'},
    {name: 'mo_unitario'},
    {name: 'nu_cantidad'},
    {name: 'nu_iva'},
    {name: 'mo_neto'},
    {name: 'mo_iva'},
    {name: 'mo_total'},
           ]
    });
    return this.store;
}
};
Ext.onReady(facturadetalleLista.main.init, facturadetalleLista.main);
</script>
<div id="contenedorfacturadetalleLista"></div>
<div id="formulariofacturadetalle"></div>
<div id="filtrofacturadetalle"></div>
