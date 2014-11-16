<script type="text/javascript">
Ext.ns("productoLista");
productoLista.main = {
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
        productoLista.main.mascara.show();
        this.msg = Ext.get('formularioproducto');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/editar",
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
	this.codigo  = productoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_producto');
	productoLista.main.mascara.show();
        this.msg = Ext.get('formularioproducto');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/editar/codigo/"+this.codigo,
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
	this.codigo  = productoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_producto');
	Ext.MessageBox.confirm('Confirmación', '¿Realmente desea eliminar este registro?', function(boton){
	if(boton=="yes"){
        Ext.Ajax.request({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/eliminar',
            params:{
                co_producto:productoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_producto')
            },
            success:function(result, request ) {
                obj = Ext.util.JSON.decode(result.responseText);
                if(obj.success==true){
		    productoLista.main.store_lista.load();
                    Ext.Msg.alert("Notificación",obj.msg);
                }else{
                    Ext.Msg.alert("Notificación",obj.msg);
                }
                productoLista.main.mascara.hide();
            }});
	}});
    }
});

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtroproducto');
        productoLista.main.mascara.show();
        productoLista.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/filtro',
             scripts: true
        });
    }
});

this.editar.disable();
this.eliminar.disable();

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    title:'Lista de producto',
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
    {header: 'co_producto',hidden:true, menuDisabled:true,dataIndex: 'co_producto'},
    {header: 'Tx producto', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'tx_producto'},
    {header: 'Co proveedor', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_proveedor'},
    {header: 'Nu precio', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_precio'},
    {header: 'Nu procentaje iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_procentaje_iva'},
    {header: 'Nu precio iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_precio_iva'},
    {header: 'In activo', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'in_activo'},
    {header: 'Nu stock', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'nu_stock'},
    {header: 'In excento iva', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'in_excento_iva'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){productoLista.main.editar.enable();productoLista.main.eliminar.enable();}},
    bbar: new Ext.PagingToolbar({
        pageSize: 20,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:white">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:white\">No se encontraron registros</span>"
    })
});

this.gridPanel_.render("contenedorproductoLista");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.load();
this.store_lista.on('load',function(){
productoLista.main.editar.disable();
productoLista.main.eliminar.disable();
});
this.store_lista.on('beforeload',function(){
panel_detalle.collapse();
});
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/storelista',
    root:'data',
    fields:[
    {name: 'co_producto'},
    {name: 'tx_producto'},
    {name: 'co_proveedor'},
    {name: 'nu_precio'},
    {name: 'nu_procentaje_iva'},
    {name: 'nu_precio_iva'},
    {name: 'in_activo'},
    {name: 'nu_stock'},
    {name: 'in_excento_iva'},
           ]
    });
    return this.store;
}
};
Ext.onReady(productoLista.main.init, productoLista.main);
</script>
<div id="contenedorproductoLista"></div>
<div id="formularioproducto"></div>
<div id="filtroproducto"></div>
