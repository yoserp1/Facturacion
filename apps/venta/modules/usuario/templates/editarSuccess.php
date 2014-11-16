<script type="text/javascript">
Ext.ns("usuarioEditar");
usuarioEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_ROL = this.getStoreCO_ROL();
//<Stores de fk>

//<ClavePrimaria>
this.co_usuario = new Ext.form.Hidden({
    name:'co_usuario',
    value:this.OBJ.co_usuario});
//</ClavePrimaria>


this.nb_usuario = new Ext.form.TextField({
	fieldLabel:'Nombre',
	name:'t01_usuario[nb_usuario]',
	value:this.OBJ.nb_usuario,
	allowBlank:false,
	width:200
});

this.ap_usuario = new Ext.form.TextField({
	fieldLabel:'Apellido',
	name:'t01_usuario[ap_usuario]',
	value:this.OBJ.ap_usuario,
	allowBlank:false,
	width:200
});

this.nu_cedula = new Ext.form.NumberField({
	fieldLabel:'Cedula',
	name:'t01_usuario[nu_cedula]',
	value:this.OBJ.nu_cedula,
	allowBlank:false,
	width:200
});

this.tx_login = new Ext.form.TextField({
	fieldLabel:'Login',
	name:'t01_usuario[tx_login]',
	value:this.OBJ.tx_login,
	allowBlank:false,
	width:200
});

this.tx_password = new Ext.form.TextField({
	inputType:'password',
	fieldLabel:'Password',
	name:'t01_usuario[tx_password]',
	value:this.OBJ.tx_password,
	allowBlank:false,
	width:200
});

this.co_rol = new Ext.form.ComboBox({
	fieldLabel:'Rol',
	store: this.storeCO_ROL,
	typeAhead: true,
	valueField: 'co_rol',
	displayField:'tx_rol',
	hiddenName:'t01_usuario[co_rol]',
	//readOnly:(this.OBJ.co_rol!='')?true:false,
	//style:(this.main.OBJ.co_rol!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione Rol',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_ROL.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_rol,
	value:  this.OBJ.co_rol,
	objStore: this.storeCO_ROL
});

this.fielset1 = new Ext.form.FieldSet({
              title:'Datos del Usuario',width:370,
              items:[
                    this.nu_cedula,
                    this.nb_usuario,
                    this.ap_usuario,
                    this.tx_login,
                    this.co_rol,
]});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!usuarioEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        usuarioEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?= $_SERVER["SCRIPT_NAME"] ?>/usuario/guardar',
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
                 usuarioLista.main.store_lista.load();
                 usuarioEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        usuarioEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
//    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[
		this.fielset1,this.co_usuario
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: usuario',
    modal:true,
    constrain:true,
width:414,
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
usuarioLista.main.mascara.hide();
}
,getStoreCO_ROL:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/usuario/storefkcorol',
        root:'data',
        fields:[
            {name: 'co_rol'},{name: 'tx_rol'}
            ]
    });
    return this.store;
}
};
Ext.onReady(usuarioEditar.main.init, usuarioEditar.main);
</script>
