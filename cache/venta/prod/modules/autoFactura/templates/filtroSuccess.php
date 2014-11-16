<script type="text/javascript">
Ext.ns("facturaFiltro");
facturaFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_CLIENTE = this.getStoreCO_CLIENTE();
//<Stores de fk>
//<Stores de fk>
this.storeCO_TIPO_FACTURA = this.getStoreCO_TIPO_FACTURA();
//<Stores de fk>



this.co_cliente = new Ext.form.ComboBox({
	fieldLabel:'Co cliente',
	store: this.storeCO_CLIENTE,
	typeAhead: true,
	valueField: 'co_cliente',
	displayField:'co_cliente',
	hiddenName:'co_cliente',
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

this.fe_factura = new Ext.form.DateField({
	fieldLabel:'Fe factura',
	name:'fe_factura'
});

this.nu_iva = new Ext.form.NumberField({
	fieldLabel:'Nu iva',
name:'nu_iva',
	value:''
});

this.mo_neto = new Ext.form.NumberField({
	fieldLabel:'Mo neto',
name:'mo_neto',
	value:''
});

this.mo_iva = new Ext.form.NumberField({
	fieldLabel:'Mo iva',
name:'mo_iva',
	value:''
});

this.mo_total = new Ext.form.NumberField({
	fieldLabel:'Mo total',
name:'mo_total',
	value:''
});

this.co_usuario = new Ext.form.NumberField({
	fieldLabel:'Co usuario',
	name:'co_usuario',
	value:''
});

this.co_tipo_factura = new Ext.form.ComboBox({
	fieldLabel:'Co tipo factura',
	store: this.storeCO_TIPO_FACTURA,
	typeAhead: true,
	valueField: 'co_tipo_factura',
	displayField:'co_tipo_factura',
	hiddenName:'co_tipo_factura',
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

this.fecha_creacion = new Ext.form.DateField({
	fieldLabel:'Fecha creacion',
	name:'fecha_creacion'
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
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
                    facturaLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    facturaLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    facturaFiltro.main.panelfiltro.getForm().reset();
    facturaLista.main.store_lista.baseParams={}
    facturaLista.main.store_lista.baseParams.paginar = 'si';
    facturaLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = facturaFiltro.main.panelfiltro.getForm().getValues();
    facturaLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("facturaLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        facturaLista.main.store_lista.baseParams.paginar = 'si';
        facturaLista.main.store_lista.baseParams.BuscarBy = true;
        facturaLista.main.store_lista.load();


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

Ext.onReady(facturaFiltro.main.init,facturaFiltro.main);
</script>