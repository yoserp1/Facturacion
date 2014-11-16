<script type="text/javascript">
Ext.ns("facturaEditar");
facturaEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_CLIENTE = this.getStoreCO_CLIENTE();
//<Stores de fk>
//<Stores de fk>
this.storeCO_TIPO_FACTURA = this.getStoreCO_TIPO_FACTURA();
//<Stores de fk>

//<ClavePrimaria>
this.co_factura = new Ext.form.Hidden({
    name:'co_factura',
    value:this.OBJ.co_factura});
//</ClavePrimaria>


this.co_cliente = new Ext.form.ComboBox({
	fieldLabel:'Co cliente',
	store: this.storeCO_CLIENTE,
	typeAhead: true,
	valueField: 'co_cliente',
	displayField:'co_cliente',
	hiddenName:'t12_factura[co_cliente]',
	//readOnly:(this.OBJ.co_cliente!='')?true:false,
	//style:(this.OBJ.co_cliente!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_cliente',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_CLIENTE.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_cliente,
	value:  this.OBJ.co_cliente,
	objStore: this.storeCO_CLIENTE
});

this.fe_factura = new Ext.form.DateField({
	fieldLabel:'Fe factura',
	name:'t12_factura[fe_factura]',
	value:this.OBJ.fe_factura,
	allowBlank:false
});

this.nu_iva = new Ext.form.NumberField({
	fieldLabel:'Nu iva',
	name:'t12_factura[nu_iva]',
	value:this.OBJ.nu_iva,
	allowBlank:false
});

this.mo_neto = new Ext.form.NumberField({
	fieldLabel:'Mo neto',
	name:'t12_factura[mo_neto]',
	value:this.OBJ.mo_neto,
	allowBlank:false
});

this.mo_iva = new Ext.form.NumberField({
	fieldLabel:'Mo iva',
	name:'t12_factura[mo_iva]',
	value:this.OBJ.mo_iva,
	allowBlank:false
});

this.mo_total = new Ext.form.NumberField({
	fieldLabel:'Mo total',
	name:'t12_factura[mo_total]',
	value:this.OBJ.mo_total,
	allowBlank:false
});

this.co_usuario = new Ext.form.NumberField({
	fieldLabel:'Co usuario',
	name:'t12_factura[co_usuario]',
	value:this.OBJ.co_usuario,
	allowBlank:false
});

this.co_tipo_factura = new Ext.form.ComboBox({
	fieldLabel:'Co tipo factura',
	store: this.storeCO_TIPO_FACTURA,
	typeAhead: true,
	valueField: 'co_tipo_factura',
	displayField:'co_tipo_factura',
	hiddenName:'t12_factura[co_tipo_factura]',
	//readOnly:(this.OBJ.co_tipo_factura!='')?true:false,
	//style:(this.OBJ.co_tipo_factura!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_tipo_factura',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_TIPO_FACTURA.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_tipo_factura,
	value:  this.OBJ.co_tipo_factura,
	objStore: this.storeCO_TIPO_FACTURA
});

this.fecha_creacion = new Ext.form.DateField({
	fieldLabel:'Fecha creacion',
	name:'t12_factura[fecha_creacion]',
	value:this.OBJ.fecha_creacion,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!facturaEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        facturaEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/guardar',
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
                 facturaLista.main.store_lista.load();
                 facturaEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        facturaEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_factura,
                    this.co_cliente,
                    this.fe_factura,
                    this.nu_iva,
                    this.mo_neto,
                    this.mo_iva,
                    this.mo_total,
                    this.co_usuario,
                    this.co_tipo_factura,
                    this.fecha_creacion,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: factura',
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
facturaLista.main.mascara.hide();
}
,getStoreCO_CLIENTE:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/storefkcocliente',
        root:'data',
        fields:[
            {name: 'co_cliente'}
            ]
    });
    return this.store;
}
,getStoreCO_TIPO_FACTURA:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/storefkcotipofactura',
        root:'data',
        fields:[
            {name: 'co_tipo_factura'}
            ]
    });
    return this.store;
}
};
Ext.onReady(facturaEditar.main.init, facturaEditar.main);
</script>
