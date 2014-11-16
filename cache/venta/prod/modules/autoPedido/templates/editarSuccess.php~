<script type="text/javascript">
Ext.ns("pedidoEditar");
pedidoEditar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_PROVEEDOR = this.getStoreCO_PROVEEDOR();
//<Stores de fk>

//<ClavePrimaria>
this.co_pedido = new Ext.form.Hidden({
    name:'co_pedido',
    value:this.OBJ.co_pedido});
//</ClavePrimaria>


this.co_proveedor = new Ext.form.ComboBox({
	fieldLabel:'Co proveedor',
	store: this.storeCO_PROVEEDOR,
	typeAhead: true,
	valueField: 'co_proveedor',
	displayField:'co_proveedor',
	hiddenName:'t08_pedido[co_proveedor]',
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

this.fe_pedido = new Ext.form.DateField({
	fieldLabel:'Fe pedido',
	name:'t08_pedido[fe_pedido]',
	value:this.OBJ.fe_pedido,
	allowBlank:false
});

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!pedidoEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        pedidoEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/guardar',
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
                 pedidoLista.main.store_lista.load();
                 pedidoEditar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        pedidoEditar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

                    this.co_pedido,
                    this.co_proveedor,
                    this.fe_pedido,
            ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: pedido',
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
pedidoLista.main.mascara.hide();
}
,getStoreCO_PROVEEDOR:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/pedido/storefkcoproveedor',
        root:'data',
        fields:[
            {name: 'co_proveedor'}
            ]
    });
    return this.store;
}
};
Ext.onReady(pedidoEditar.main.init, pedidoEditar.main);
</script>
