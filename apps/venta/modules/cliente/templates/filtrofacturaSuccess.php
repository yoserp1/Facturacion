<script type="text/javascript">
Ext.ns("facturaFiltro");
facturaFiltro.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});

//<ClavePrimaria>
this.co_cliente = new Ext.form.Hidden({
    name:'co_cliente',
    value:this.OBJ.co_cliente});
//</ClavePrimaria>

//<Stores de fk>
this.storeCO_TIPO_FACTURA = this.getStoreCO_TIPO_FACTURA();
//<Stores de fk>


this.fe_factura = new Ext.form.DateField({
	fieldLabel:'Fecha Factura',
	name:'fe_factura',
	width:100
});

this.co_tipo_factura = new Ext.form.ComboBox({
	fieldLabel:'Tipo de Factura',
	store: this.storeCO_TIPO_FACTURA,
	typeAhead: true,
	valueField: 'co_tipo_factura',
	displayField:'tx_tipo_factura',
	hiddenName:'co_tipo_factura',
	//readOnly:(this.OBJ.co_tipo_factura!='')?true:false,
	//style:(this.OBJ.co_tipo_factura!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione Tipo de Factura',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_TIPO_FACTURA.load();

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
			this.fe_factura,
			this.co_tipo_factura,
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
                     facturaFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    facturaFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    facturaFiltro.main.win.close();
                    facturaCliente.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    facturaCliente.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    facturaFiltro.main.panelfiltro.getForm().reset();
    facturaCliente.main.store_lista.baseParams={}
	facturaCliente.main.store_lista.baseParams.co_cliente = this.OBJ.co_cliente;
    facturaCliente.main.store_lista.baseParams.paginar = 'si';
    facturaCliente.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = facturaFiltro.main.panelfiltro.getForm().getValues();
    facturaCliente.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("facturaCliente.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

	facturaCliente.main.store_lista.baseParams.co_cliente = this.OBJ.co_cliente;
        facturaCliente.main.store_lista.baseParams.paginar = 'si';
        facturaCliente.main.store_lista.baseParams.BuscarBy = true;
        facturaCliente.main.store_lista.load();


}
,getStoreCO_TIPO_FACTURA:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/storefkcotipofactura',
        root:'data',
        fields:[
            {name: 'co_tipo_factura'},{name: 'tx_tipo_factura'}
            ]
    });
    return this.store;
}

};

Ext.onReady(facturaFiltro.main.init,facturaFiltro.main);
</script>
