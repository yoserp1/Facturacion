<script type="text/javascript">
Ext.ns("proveedorFiltro");
proveedorFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_DOCUMENTO = this.getStoreCO_DOCUMENTO();
//<Stores de fk>



this.co_documento = new Ext.form.ComboBox({
	fieldLabel:'Co documento',
	store: this.storeCO_DOCUMENTO,
	typeAhead: true,
	valueField: 'co_documento',
	displayField:'co_documento',
	hiddenName:'co_documento',
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

this.tx_dni = new Ext.form.TextField({
	fieldLabel:'Tx dni',
	name:'tx_dni',
	value:''
});

this.tx_nombre = new Ext.form.TextField({
	fieldLabel:'Tx nombre',
	name:'tx_nombre',
	value:''
});

this.tx_direccion = new Ext.form.TextField({
	fieldLabel:'Tx direccion',
	name:'tx_direccion',
	value:''
});

this.tx_telefono = new Ext.form.TextField({
	fieldLabel:'Tx telefono',
	name:'tx_telefono',
	value:''
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.co_documento,
                                                                                this.tx_dni,
                                                                                this.tx_nombre,
                                                                                this.tx_direccion,
                                                                                this.tx_telefono,
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
                     proveedorFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    proveedorFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    proveedorFiltro.main.win.close();
                    proveedorLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    proveedorLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    proveedorFiltro.main.panelfiltro.getForm().reset();
    proveedorLista.main.store_lista.baseParams={}
    proveedorLista.main.store_lista.baseParams.paginar = 'si';
    proveedorLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = proveedorFiltro.main.panelfiltro.getForm().getValues();
    proveedorLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("proveedorLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        proveedorLista.main.store_lista.baseParams.paginar = 'si';
        proveedorLista.main.store_lista.baseParams.BuscarBy = true;
        proveedorLista.main.store_lista.load();


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

Ext.onReady(proveedorFiltro.main.init,proveedorFiltro.main);
</script>