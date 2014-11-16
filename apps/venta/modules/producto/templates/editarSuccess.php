<script type="text/javascript">
Ext.ns("productoEditar");
productoEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_PROVEEDOR = this.getStoreCO_PROVEEDOR();
//<Stores de fk>

//<ClavePrimaria>
this.co_producto = new Ext.form.Hidden({
    name:'co_producto',
    value:this.OBJ.co_producto});
//</ClavePrimaria>


this.tx_producto = new Ext.form.TextField({
	fieldLabel:'Tx producto',
	name:'t07_producto[tx_producto]',
	value:this.OBJ.tx_producto,
	allowBlank:false
});

this.co_proveedor = new Ext.form.ComboBox({
	fieldLabel:'Co proveedor',
	store: this.storeCO_PROVEEDOR,
	typeAhead: true,
	valueField: 'co_proveedor',
	displayField:'co_proveedor',
	hiddenName:'t07_producto[co_proveedor]',
	//readOnly:(this.OBJ.co_proveedor!='')?true:false,
	//style:(this.OBJ.co_proveedor!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_proveedor',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_PROVEEDOR.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_proveedor,
	value:  this.OBJ.co_proveedor,
	objStore: this.storeCO_PROVEEDOR
});

this.nu_precio = new Ext.form.NumberField({
	fieldLabel:'Nu precio',
	name:'t07_producto[nu_precio]',
	value:this.OBJ.nu_precio,
	allowBlank:false
});

this.nu_procentaje_iva = new Ext.form.NumberField({
	fieldLabel:'Nu procentaje iva',
	name:'t07_producto[nu_procentaje_iva]',
	value:this.OBJ.nu_procentaje_iva,
	allowBlank:false
});

this.nu_precio_iva = new Ext.form.NumberField({
	fieldLabel:'Nu precio iva',
	name:'t07_producto[nu_precio_iva]',
	value:this.OBJ.nu_precio_iva,
	allowBlank:false
});

this.in_activo = new Ext.form.Checkbox({
	fieldLabel:'In activo',
	name:'t07_producto[in_activo]',
	checked:(this.OBJ.in_activo=='1') ? true:false,
	allowBlank:false
});

this.nu_stock = new Ext.form.NumberField({
	fieldLabel:'Nu stock',
	name:'t07_producto[nu_stock]',
	value:this.OBJ.nu_stock,
	allowBlank:false
});

this.in_excento_iva = new Ext.form.Checkbox({
	fieldLabel:'In excento iva',
	name:'t07_producto[in_excento_iva]',
	checked:(this.OBJ.in_excento_iva=='1') ? true:false,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!productoEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        productoEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/guardar',
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
                 productoLista.main.store_lista.load();
                 productoEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        productoEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_producto,
                    this.tx_producto,
                    this.co_proveedor,
                    this.nu_precio,
                    this.nu_procentaje_iva,
                    this.nu_precio_iva,
                    this.in_activo,
                    this.nu_stock,
                    this.in_excento_iva,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: producto',
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
productoLista.main.mascara.hide();
}
,getStoreCO_PROVEEDOR:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/storefkcoproveedor',
        root:'data',
        fields:[
            {name: 'co_proveedor'}
            ]
    });
    return this.store;
}
};
Ext.onReady(productoEditar.main.init, productoEditar.main);
</script>
