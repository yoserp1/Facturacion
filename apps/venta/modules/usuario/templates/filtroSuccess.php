<script type="text/javascript">
Ext.ns("usuarioFiltro");
usuarioFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_ROL = this.getStoreCO_ROL();
//<Stores de fk>



this.nb_usuario = new Ext.form.TextField({
	fieldLabel:'Nb usuario',
	name:'nb_usuario',
	value:''
});

this.ap_usuario = new Ext.form.TextField({
	fieldLabel:'Ap usuario',
	name:'ap_usuario',
	value:''
});

this.nu_cedula = new Ext.form.NumberField({
	fieldLabel:'Nu cedula',
name:'nu_cedula',
	value:''
});

this.tx_login = new Ext.form.TextField({
	fieldLabel:'Tx login',
	name:'tx_login',
	value:''
});

this.tx_password = new Ext.form.TextField({
	fieldLabel:'Tx password',
	name:'tx_password',
	value:''
});

this.co_rol = new Ext.form.ComboBox({
	fieldLabel:'Co rol',
	store: this.storeCO_ROL,
	typeAhead: true,
	valueField: 'co_rol',
	displayField:'co_rol',
	hiddenName:'co_rol',
	//readOnly:(this.OBJ.co_rol!='')?true:false,
	//style:(this.main.OBJ.co_rol!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_rol',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_ROL.load();

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.nb_usuario,
                                                                                this.ap_usuario,
                                                                                this.nu_cedula,
                                                                                this.tx_login,
                                                                                this.tx_password,
                                                                                this.co_rol,
                                           ]
               }
            ]
    });

    this.panelfiltro = new Ext.form.FormPanel({
        frame:true,
        autoWidth:true,
        border:false,
        items:[
            this.tabpanelfiltro
        ]
    });

    this.win = new Ext.Window({
        title:'Parametros de busqueda',
        iconCls: 'icon-buscar',
        width:600,
        autoHeight:true,
        constrain:true,
        closable:false,
        buttonAlign:'center',
        items:[
            this.panelfiltro
        ],
        buttons:[
            {
                text:'Filtrar',
                handler:function(){
                     usuarioFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    usuarioFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    usuarioFiltro.main.win.close();
                    usuarioLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    usuarioLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    usuarioFiltro.main.panelfiltro.getForm().reset();
    usuarioLista.main.store_lista.baseParams={}
    usuarioLista.main.store_lista.baseParams.paginar = 'si';
    usuarioLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = usuarioFiltro.main.panelfiltro.getForm().getValues();
    usuarioLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("usuarioLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        usuarioLista.main.store_lista.baseParams.paginar = 'si';
        usuarioLista.main.store_lista.baseParams.BuscarBy = true;
        usuarioLista.main.store_lista.load();


}
,getStoreCO_ROL:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/usuario/storefkcorol',
        root:'data',
        fields:[
            {name: 'co_rol'}
            ]
    });
    return this.store;
}

};

Ext.onReady(usuarioFiltro.main.init,usuarioFiltro.main);
</script>