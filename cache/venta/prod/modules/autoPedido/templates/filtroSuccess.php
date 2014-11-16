<script type="text/javascript">
Ext.ns("pedidoFiltro");
pedidoFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_PROVEEDOR = this.getStoreCO_PROVEEDOR();
//<Stores de fk>



this.co_proveedor = new Ext.form.ComboBox({
	fieldLabel:'Co proveedor',
	store: this.storeCO_PROVEEDOR,
	typeAhead: true,
	valueField: 'co_proveedor',
	displayField:'co_proveedor',
	hiddenName:'co_proveedor',
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

this.fe_pedido = new Ext.form.DateField({
	fieldLabel:'Fe pedido',
	name:'fe_pedido'
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.co_proveedor,
                                                                                this.fe_pedido,
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
                     pedidoFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    pedidoFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    pedidoFiltro.main.win.close();
                    pedidoLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    pedidoLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    pedidoFiltro.main.panelfiltro.getForm().reset();
    pedidoLista.main.store_lista.baseParams={}
    pedidoLista.main.store_lista.baseParams.paginar = 'si';
    pedidoLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = pedidoFiltro.main.panelfiltro.getForm().getValues();
    pedidoLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("pedidoLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        pedidoLista.main.store_lista.baseParams.paginar = 'si';
        pedidoLista.main.store_lista.baseParams.BuscarBy = true;
        pedidoLista.main.store_lista.load();


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

Ext.onReady(pedidoFiltro.main.init,pedidoFiltro.main);
</script>