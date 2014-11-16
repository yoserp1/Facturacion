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
//    title:'Lista de Facturas',
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
    {header: 'codigo',width:100, menuDisabled:true, sortable: true, dataIndex: 'co_factura'},
//    {header: 'Cliente', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_cliente'},
    {header: 'Fecha', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'fe_factura'},
    {header: 'Neto', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_neto'},
    {header: 'I.V.A', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_iva'},
    {header: 'Total', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'mo_total'},
    {header: 'Tipo Factura', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_tipo_factura'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){facturaLista.main.editar.enable();facturaLista.main.eliminar.enable();}},
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
                                                    url: '<?= $_SERVER['SCRIPT_NAME']?>/factura/detalle',
                                                    scripts: true,
                                                    params: {codigo:rec.json.co_factura},
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
