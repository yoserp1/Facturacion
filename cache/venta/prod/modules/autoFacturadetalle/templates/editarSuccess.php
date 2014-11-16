<script type="text/javascript">
Ext.ns("facturadetalleEditar");
facturadetalleEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_FACTURA = this.getStoreCO_FACTURA();
//<Stores de fk>
//<Stores de fk>
this.storeCO_PRODUCTO = this.getStoreCO_PRODUCTO();
//<Stores de fk>

//<ClavePrimaria>
this.co_factura_detalle = new Ext.form.Hidden({
    name:'co_factura_detalle',
    value:this.OBJ.co_factura_detalle});
//</ClavePrimaria>


this.co_factura = new Ext.form.ComboBox({
	fieldLabel:'Co factura',
	store: this.storeCO_FACTURA,
	typeAhead: true,
	valueField: 'co_factura',
	displayField:'co_factura',
	hiddenName:'t13_factura_detalle[co_factura]',
	//readOnly:(this.OBJ.co_factura!='')?true:false,
	//style:(this.OBJ.co_factura!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_factura',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_FACTURA.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_factura,
	value:  this.OBJ.co_factura,
	objStore: this.storeCO_FACTURA
});

this.co_producto = new Ext.form.ComboBox({
	fieldLabel:'Co producto',
	store: this.storeCO_PRODUCTO,
	typeAhead: true,
	valueField: 'co_producto',
	displayField:'co_producto',
	hiddenName:'t13_factura_detalle[co_producto]',
	//readOnly:(this.OBJ.co_producto!='')?true:false,
	//style:(this.OBJ.co_producto!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_producto',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_PRODUCTO.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_producto,
	value:  this.OBJ.co_producto,
	objStore: this.storeCO_PRODUCTO
});

this.mo_unitario = new Ext.form.NumberField({
	fieldLabel:'Mo unitario',
	name:'t13_factura_detalle[mo_unitario]',
	value:this.OBJ.mo_unitario,
	allowBlank:false
});

this.nu_cantidad = new Ext.form.NumberField({
	fieldLabel:'Nu cantidad',
	name:'t13_factura_detalle[nu_cantidad]',
	value:this.OBJ.nu_cantidad,
	allowBlank:false
});

this.nu_iva = new Ext.form.NumberField({
	fieldLabel:'Nu iva',
	name:'t13_factura_detalle[nu_iva]',
	value:this.OBJ.nu_iva,
	allowBlank:false
});

this.mo_neto = new Ext.form.NumberField({
	fieldLabel:'Mo neto',
	name:'t13_factura_detalle[mo_neto]',
	value:this.OBJ.mo_neto,
	allowBlank:false
});

this.mo_iva = new Ext.form.NumberField({
	fieldLabel:'Mo iva',
	name:'t13_factura_detalle[mo_iva]',
	value:this.OBJ.mo_iva,
	allowBlank:false
});

this.mo_total = new Ext.form.NumberField({
	fieldLabel:'Mo total',
	name:'t13_factura_detalle[mo_total]',
	value:this.OBJ.mo_total,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!facturadetalleEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        facturadetalleEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/guardar',
            waitMsg: 'Enviando datos, por favor espere..',
            waitTitle:'Enviando',
            failure: function(form, action) {
                Ext.MessageBox.alert('Error en transacción', action.result.msg);
            },
            success: function(form, action) {
                 if(action.result.success){
                     Ext.MessageBox.show({
                         title: 'Mensaje',
                         msg: action.result.msg,
                         closable: false,
                         icon: Ext.MessageBox.INFO,
                         resizable: false,
			 animEl: document.body,
                         buttons: Ext.MessageBox.OK
                     });
                 }
                 facturadetalleLista.main.store_lista.load();
                 facturadetalleEditar.main.winformPanel_.hide();
             }
        });

   
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
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_factura_detalle,
                    this.co_factura,
                    this.co_producto,
                    this.mo_unitario,
                    this.nu_cantidad,
                    this.nu_iva,
                    this.mo_neto,
                    this.mo_iva,
                    this.mo_total,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: facturadetalle',
    modal:true,
    constrain:true,
width:400,
    frame:true,
    closabled:true,
    autoHeight:true,
    items:[
        this.formPanel_
    ],
    buttons:[
        this.guardar,
        this.salir
    ],
    buttonAlign:'center'
});
this.winformPanel_.show();
facturadetalleLista.main.mascara.hide();
}
,getStoreCO_FACTURA:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storefkcofactura',
        root:'data',
        fields:[
            {name: 'co_factura'}
            ]
    });
    return this.store;
}
,getStoreCO_PRODUCTO:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storefkcoproducto',
        root:'data',
        fields:[
            {name: 'co_producto'}
            ]
    });
    return this.store;
}
};
Ext.onReady(facturadetalleEditar.main.init, facturadetalleEditar.main);
</script>
