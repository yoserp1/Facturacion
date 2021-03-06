<script type="text/javascript">
Ext.ns("facturadetalleEditar");
facturadetalleEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});

//objeto store
this.store_lista = this.getLista();

this.Registro;

this.co_producto = new Ext.form.NumberField({
	fieldLabel:'Codigo',
	name:'t13_factura_detalle[co_producto]',
	value:this.OBJ.co_producto,
	allowBlank:false,
	width:100
});

this.co_producto.on('specialkey', function(f, event) {
    if(event.getKey() == event.ENTER) {
        facturadetalleEditar.main.verificarProducto();
    }
}, this);

this.co_producto.on('blur',function(){
    facturadetalleEditar.main.verificarProducto();
});

this.mo_unitario = new Ext.form.NumberField({
	fieldLabel:'Precio',
	name:'t13_factura_detalle[mo_unitario]',
	value:this.OBJ.mo_unitario,
	allowBlank:false,
	width:100,
	readOnly:true,
	style:'background:#c9c9c9;'
});

this.nu_procentaje_iva = new Ext.form.NumberField({
	fieldLabel:'% I.V.A',
	name:'t13_factura_detalle[nu_procentaje_iva]',
	value:this.OBJ.nu_procentaje_iva,
	allowBlank:false,
	width:100,
	readOnly:true,
	style:'background:#c9c9c9;'
});

this.nu_cantidad = new Ext.form.NumberField({
	fieldLabel:'Cantidad',
	name:'t13_factura_detalle[nu_cantidad]',
	value:this.OBJ.nu_cantidad,
	allowBlank:false,
	width:100
});

this.tx_producto = new Ext.form.TextField({
	fieldLabel:'Descripcion',
	name:'t13_factura_detalle[tx_producto]',
	value:this.OBJ.tx_producto,
	allowBlank:false,
	width:350,
	readOnly:true,
	style:'background:#c9c9c9;'
});

this.busqueda = new Ext.form.ComboBox({
	minChars:1,
	fieldLabel:'Busqueda',
        store: this.store_lista,
        displayField:'tx_producto',
        typeAhead: false,
        loadingText: 'Buscando...',
	emptyText: 'Escriba el nombre del producto.',
        width: 350,
        pageSize:10,
        hideTrigger:true,
        tpl: new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<h3><br>Codigo {co_producto} - {tx_producto} - Stock {nu_stock}</h3>',
        '</div></tpl>'
    	),
        applyTo: this.busqueda,
        itemSelector: 'div.search-item',
        onSelect: function(record){
//		alert(record.data.tx_producto + ' Fue Seleccionado...');
		facturadetalleEditar.main.co_producto.setValue(record.data.co_producto);
		facturadetalleEditar.main.busqueda.setValue(record.data.tx_producto);
		facturadetalleEditar.main.verificarProducto();
		this.collapse();
        }
    });

this.guardar = new Ext.Button({
	text:'Agregar',
	id:'guardar',
	iconCls: 'icon-guardar',
	handler:function(){
	if(facturadetalleEditar.main.formPanel_.form.isValid()){
		var e = new facturaEditar.main.Registro({
			co_producto:facturadetalleEditar.main.co_producto.getValue(),
			tx_producto:facturadetalleEditar.main.tx_producto.getValue(),
			mo_unitario:facturadetalleEditar.main.mo_unitario.getValue(),
			nu_cantidad:facturadetalleEditar.main.nu_cantidad.getValue(),
			nu_procentaje_iva:facturadetalleEditar.main.nu_procentaje_iva.getValue()
		});
		var cant = facturaEditar.main.store_lista.getCount();
			(cant==0)?0:facturaEditar.main.store_lista.getCount()+1;

			facturaEditar.main.store_lista.insert(cant, e);
			facturaEditar.main.gridPanel_.getView().refresh();
			facturaEditar.main.getTotalCancelar();
			facturadetalleEditar.main.winformPanel_.close();
	}else{
		Ext.Msg.show({
			title:'Mensaje',
			msg: 'Debe llenar los campos requeridos',
			buttons: Ext.Msg.OK,
			animEl: document.body,
			icon: Ext.MessageBox.INFO
		});
	}
	}
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        facturadetalleEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:false,
    width:500,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[
		    this.busqueda,
                    this.co_producto,
                    this.tx_producto,
                    this.mo_unitario,
		    this.nu_procentaje_iva,
                    this.nu_cantidad
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: facturadetalle',
    modal:true,
    constrain:true,
width:514,
    frame:true,
    closabled:true,
    autoHeight:true,
    items:[
        this.formPanel_
    ],
    keys: [{
		key:[Ext.EventObject.ENTER],
		handler: function() {
			Ext.getCmp('guardar').handler.call(Ext.getCmp('guardar').scope);
		}}
    ],
    buttons:[
        this.guardar,
        this.salir
    ],
    buttonAlign:'center'
});
this.winformPanel_.show();
facturadetalleEditar.main.store_lista.baseParams.paginar = 'si';
facturadetalleEditar.main.store_lista.baseParams.BuscarBy = true;
},
verificarProducto:function(){
  if(facturadetalleEditar.main.co_producto.getValue()==''){
                Ext.Msg.alert("Alerta","Debe indicar el codigo del producto");
                return false;
            }

            Ext.Ajax.request({
                method:'POST',
                url:'<?= $_SERVER["SCRIPT_NAME"]?>/producto/verificar',
                params:{
                    co_producto: facturadetalleEditar.main.co_producto.getValue()
                },
                success:function(result, request ) {
                    obj = Ext.util.JSON.decode(result.responseText);
                    if(!obj.data){
                        facturadetalleEditar.main.co_producto.setValue("");
                        facturadetalleEditar.main.co_producto.focus(true,true);
			facturadetalleEditar.main.tx_producto.setValue("");
			facturadetalleEditar.main.mo_unitario.setValue("");
			facturadetalleEditar.main.nu_cantidad.setValue("");
			facturadetalleEditar.main.nu_procentaje_iva.setValue("");
                    }else{
                        facturadetalleEditar.main.nu_cantidad.focus(true,true);
                        facturadetalleEditar.main.co_producto.setValue(obj.data.co_producto);
			facturadetalleEditar.main.tx_producto.setValue(obj.data.tx_producto);
			facturadetalleEditar.main.mo_unitario.setValue(obj.data.nu_precio);
			facturadetalleEditar.main.nu_procentaje_iva.setValue(obj.data.nu_procentaje_iva);
                    }
                }
 });
},
getLista: function(){
this.Store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/storelista',
            method: 'POST'
        }),
        reader: new Ext.data.JsonReader({
            root: 'data',
            totalProperty: 'total',
            id: 'co_producto'
        }, [
	    {name: 'co_producto', mapping: 'co_producto'},
	    {name: 'tx_producto', mapping: 'tx_producto'},
	    {name: 'co_proveedor', mapping: 'co_proveedor'},
	    {name: 'nu_precio', mapping: 'nu_precio'},
	    {name: 'nu_procentaje_iva', mapping: 'nu_procentaje_iva'},
	    {name: 'nu_precio_iva', mapping: 'nu_precio_iva'},
	    {name: 'in_activo', mapping: 'in_activo'},
	    {name: 'nu_stock', mapping: 'nu_stock'},
	    {name: 'in_excento_iva', mapping: 'in_excento_iva'},
        ])
});
return this.Store;
}
};
Ext.onReady(facturadetalleEditar.main.init, facturadetalleEditar.main);
</script>
