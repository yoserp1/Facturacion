<script type="text/javascript">
Ext.ns("pedidoLista");
pedidoLista.main = {
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
        pedidoLista.main.mascara.show();
        this.msg = Ext.get('formulariopedido');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/editar",
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
	this.codigo  = pedidoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_pedido');
	pedidoLista.main.mascara.show();
        this.msg = Ext.get('formulariopedido');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/editar/codigo/"+this.codigo,
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
	this.codigo  = pedidoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_pedido');
	Ext.MessageBox.confirm('Confirmación', '¿Realmente desea eliminar este registro?', function(boton){
	if(boton=="yes"){
        Ext.Ajax.request({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/eliminar',
            params:{
                co_pedido:pedidoLista.main.gridPanel_.getSelectionModel().getSelected().get('co_pedido')
            },
            success:function(result, request ) {
                obj = Ext.util.JSON.decode(result.responseText);
                if(obj.success==true){
		    pedidoLista.main.store_lista.load();
                    Ext.Msg.alert("Notificación",obj.msg);
                }else{
                    Ext.Msg.alert("Notificación",obj.msg);
                }
                pedidoLista.main.mascara.hide();
            }});
	}});
    }
});

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtropedido');
        pedidoLista.main.mascara.show();
        pedidoLista.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/filtro',
             scripts: true
        });
    }
});

this.editar.disable();
this.eliminar.disable();

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    title:'Lista de pedido',
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
    {header: 'co_pedido',hidden:true, menuDisabled:true,dataIndex: 'co_pedido'},
    {header: 'Co proveedor', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_proveedor'},
    {header: 'Fe pedido', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'fe_pedido'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){pedidoLista.main.editar.enable();pedidoLista.main.eliminar.enable();}},
    bbar: new Ext.PagingToolbar({
        pageSize: 20,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:white">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:white\">No se encontraron registros</span>"
    })
});

this.gridPanel_.render("contenedorpedidoLista");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.load();
this.store_lista.on('load',function(){
pedidoLista.main.editar.disable();
pedidoLista.main.eliminar.disable();
});
this.store_lista.on('beforeload',function(){
panel_detalle.collapse();
});
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/storelista',
    root:'data',
    fields:[
    {name: 'co_pedido'},
    {name: 'co_proveedor'},
    {name: 'fe_pedido'},
           ]
    });
    return this.store;
}
};
Ext.onReady(pedidoLista.main.init, pedidoLista.main);
</script>
<div id="contenedorpedidoLista"></div>
<div id="formulariopedido"></div>
<div id="filtropedido"></div>
