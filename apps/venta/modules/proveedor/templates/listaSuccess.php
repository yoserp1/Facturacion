<script type="text/javascript">
Ext.ns("proveedorLista");
proveedorLista.main = {
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
        proveedorLista.main.mascara.show();
        this.msg = Ext.get('formularioproveedor');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/editar",
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
	this.codigo  = proveedorLista.main.gridPanel_.getSelectionModel().getSelected().get('co_proveedor');
	proveedorLista.main.mascara.show();
        this.msg = Ext.get('formularioproveedor');
        this.msg.load({
         url:"<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/editar/codigo/"+this.codigo,
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
	this.codigo  = proveedorLista.main.gridPanel_.getSelectionModel().getSelected().get('co_proveedor');
	Ext.MessageBox.confirm('Confirmación', '¿Realmente desea eliminar este registro?', function(boton){
	if(boton=="yes"){
        Ext.Ajax.request({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/eliminar',
            params:{
                co_proveedor:proveedorLista.main.gridPanel_.getSelectionModel().getSelected().get('co_proveedor')
            },
            success:function(result, request ) {
                obj = Ext.util.JSON.decode(result.responseText);
                if(obj.success==true){
		    proveedorLista.main.store_lista.load();
                    Ext.Msg.alert("Notificación",obj.msg);
                }else{
                    Ext.Msg.alert("Notificación",obj.msg);
                }
                proveedorLista.main.mascara.hide();
            }});
	}});
    }
});

//filtro
this.filtro = new Ext.Button({
    text:'Filtro',
    iconCls: 'icon-buscar',
    handler:function(){
        this.msg = Ext.get('filtroproveedor');
        proveedorLista.main.mascara.show();
        proveedorLista.main.filtro.setDisabled(true);
        this.msg.load({
             url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/filtro',
             scripts: true
        });
    }
});

this.editar.disable();
this.eliminar.disable();

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    title:'Lista de proveedor',
    iconCls: 'icon-libro',
    store: this.store_lista,
    loadMask:true,
    border:false,
//    frame:true,
//    height:550,
    autoWidth: true,
    autoHeight:true,
    tbar:[
        this.nuevo,'-',this.editar,'-',this.filtro
    ],
    columns: [
    new Ext.grid.RowNumberer(),
    {header: 'co_proveedor',hidden:true, menuDisabled:true,dataIndex: 'co_proveedor'},
    {header: 'Documento', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'tx_dni'},
    {header: 'Nombre', width:200,  menuDisabled:true, sortable: true,  dataIndex: 'tx_nombre'},
    {header: 'Direccion', width:300,  menuDisabled:true, sortable: true,  dataIndex: 'tx_direccion'},
    {header: 'Telefono', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'tx_telefono'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){proveedorLista.main.editar.enable();proveedorLista.main.eliminar.enable();}},
    bbar: new Ext.PagingToolbar({
        pageSize: 20,
        store: this.store_lista,
        displayInfo: true,
        displayMsg: '<span style="color:black">Registros: {0} - {1} de {2}</span>',
        emptyMsg: "<span style=\"color:black\">No se encontraron registros</span>"
    }),	
	sm: new Ext.grid.RowSelectionModel({
		singleSelect: true,
		//AQUI ES DONDE ESTA EL LISTENER
			listeners: {
			rowselect: function(sm, row, rec) {
                                            var msg = Ext.get('detalle');
                                            msg.load({
                                                    url: '<?= $_SERVER['SCRIPT_NAME']?>/proveedor/detalle',
                                                    scripts: true,
                                                    params: {codigo:rec.json.co_proveedor},
                                                    text: 'Cargando...'
                                            });
				if(panel_detalle.collapsed == true)
				{
				panel_detalle.toggleCollapse();
				}    
			}
		}
	})
});

this.gridPanel_.render("contenedorproveedorLista");

//Cargar el grid
this.store_lista.baseParams.paginar = 'si';
this.store_lista.load();
this.store_lista.on('load',function(){
proveedorLista.main.editar.disable();
proveedorLista.main.eliminar.disable();
});
this.store_lista.on('beforeload',function(){
panel_detalle.collapse();
});
},
getLista: function(){
    this.store = new Ext.data.JsonStore({
    url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/storelista',
    root:'data',
    fields:[
    {name: 'co_proveedor'},
    {name: 'co_documento'},
    {name: 'tx_dni'},
    {name: 'tx_nombre'},
    {name: 'tx_direccion'},
    {name: 'tx_telefono'},
           ]
    });
    return this.store;
}
};
Ext.onReady(proveedorLista.main.init, proveedorLista.main);
</script>
<div id="contenedorproveedorLista"></div>
<div id="formularioproveedor"></div>
<div id="filtroproveedor"></div>
