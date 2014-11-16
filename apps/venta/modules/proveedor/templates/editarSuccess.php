<script type="text/javascript">
Ext.ns("proveedorEditar");
proveedorEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_DOCUMENTO = this.getStoreCO_DOCUMENTO();
//<Stores de fk>

//<ClavePrimaria>
this.co_proveedor = new Ext.form.Hidden({
    name:'co_proveedor',
    value:this.OBJ.co_proveedor});
//</ClavePrimaria>


this.co_documento = new Ext.form.ComboBox({
	fieldLabel:'Co documento',
	store: this.storeCO_DOCUMENTO,
	typeAhead: true,
	valueField: 'co_documento',
	displayField:'co_documento',
	hiddenName:'t06_proveedor[co_documento]',
	//readOnly:(this.OBJ.co_documento!='')?true:false,
	//style:(this.OBJ.co_documento!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_documento',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_DOCUMENTO.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_documento,
	value:  this.OBJ.co_documento,
	objStore: this.storeCO_DOCUMENTO
});

this.tx_dni = new Ext.form.TextField({
	fieldLabel:'Tx dni',
	name:'t06_proveedor[tx_dni]',
	value:this.OBJ.tx_dni,
	allowBlank:false
});

this.tx_nombre = new Ext.form.TextField({
	fieldLabel:'Tx nombre',
	name:'t06_proveedor[tx_nombre]',
	value:this.OBJ.tx_nombre,
	allowBlank:false
});

this.tx_direccion = new Ext.form.TextField({
	fieldLabel:'Tx direccion',
	name:'t06_proveedor[tx_direccion]',
	value:this.OBJ.tx_direccion,
	allowBlank:false
});

this.tx_telefono = new Ext.form.TextField({
	fieldLabel:'Tx telefono',
	name:'t06_proveedor[tx_telefono]',
	value:this.OBJ.tx_telefono,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!proveedorEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        proveedorEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/guardar',
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
                 proveedorLista.main.store_lista.load();
                 proveedorEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        proveedorEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_proveedor,
                    this.co_documento,
                    this.tx_dni,
                    this.tx_nombre,
                    this.tx_direccion,
                    this.tx_telefono,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: proveedor',
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
proveedorLista.main.mascara.hide();
}
,getStoreCO_DOCUMENTO:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/proveedor/storefkcodocumento',
        root:'data',
        fields:[
            {name: 'co_documento'}
            ]
    });
    return this.store;
}
};
Ext.onReady(proveedorEditar.main.init, proveedorEditar.main);
</script>
