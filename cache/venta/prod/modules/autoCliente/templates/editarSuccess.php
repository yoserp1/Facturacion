<script type="text/javascript">
Ext.ns("clienteEditar");
clienteEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_DOCUMENTO = this.getStoreCO_DOCUMENTO();
//<Stores de fk>

//<ClavePrimaria>
this.co_cliente = new Ext.form.Hidden({
    name:'co_cliente',
    value:this.OBJ.co_cliente});
//</ClavePrimaria>


this.co_documento = new Ext.form.ComboBox({
	fieldLabel:'Co documento',
	store: this.storeCO_DOCUMENTO,
	typeAhead: true,
	valueField: 'co_documento',
	displayField:'co_documento',
	hiddenName:'t10_cliente[co_documento]',
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
	name:'t10_cliente[tx_dni]',
	value:this.OBJ.tx_dni,
	allowBlank:false
});

this.tx_nombre = new Ext.form.TextField({
	fieldLabel:'Tx nombre',
	name:'t10_cliente[tx_nombre]',
	value:this.OBJ.tx_nombre,
	allowBlank:false
});

this.tx_direccion = new Ext.form.TextField({
	fieldLabel:'Tx direccion',
	name:'t10_cliente[tx_direccion]',
	value:this.OBJ.tx_direccion,
	allowBlank:false
});

this.tx_telefono = new Ext.form.TextField({
	fieldLabel:'Tx telefono',
	name:'t10_cliente[tx_telefono]',
	value:this.OBJ.tx_telefono,
	allowBlank:false
});

this.nu_limite_credito = new Ext.form.NumberField({
	fieldLabel:'Nu limite credito',
	name:'t10_cliente[nu_limite_credito]',
	value:this.OBJ.nu_limite_credito,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!clienteEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        clienteEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/cliente/guardar',
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
                 clienteLista.main.store_lista.load();
                 clienteEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        clienteEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_cliente,
                    this.co_documento,
                    this.tx_dni,
                    this.tx_nombre,
                    this.tx_direccion,
                    this.tx_telefono,
                    this.nu_limite_credito,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: cliente',
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
clienteLista.main.mascara.hide();
}
,getStoreCO_DOCUMENTO:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/cliente/storefkcodocumento',
        root:'data',
        fields:[
            {name: 'co_documento'}
            ]
    });
    return this.store;
}
};
Ext.onReady(clienteEditar.main.init, clienteEditar.main);
</script>
