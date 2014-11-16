<script type="text/javascript">
Ext.ns("facturadetalleFiltro");
facturadetalleFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_FACTURA = this.getStoreCO_FACTURA();
//<Stores de fk>
//<Stores de fk>
this.storeCO_PRODUCTO = this.getStoreCO_PRODUCTO();
//<Stores de fk>



this.co_factura = new Ext.form.ComboBox({
	fieldLabel:'Co factura',
	store: this.storeCO_FACTURA,
	typeAhead: true,
	valueField: 'co_factura',
	displayField:'co_factura',
	hiddenName:'co_factura',
	//readOnly:(this.OBJ.co_factura!='')?true:false,
	//style:(this.OBJ.co_factura!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_factura',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_FACTURA.load();

this.co_producto = new Ext.form.ComboBox({
	fieldLabel:'Co producto',
	store: this.storeCO_PRODUCTO,
	typeAhead: true,
	valueField: 'co_producto',
	displayField:'co_producto',
	hiddenName:'co_producto',
	//readOnly:(this.OBJ.co_producto!='')?true:false,
	//style:(this.OBJ.co_producto!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'Seleccione co_producto',
	selectOnFocus: true,
	mode: 'local',
	width:200,
	resizable:true,
	allowBlank:false
});
this.storeCO_PRODUCTO.load();

this.mo_unitario = new Ext.form.NumberField({
	fieldLabel:'Mo unitario',
name:'mo_unitario',
	value:''
});

this.nu_cantidad = new Ext.form.NumberField({
	fieldLabel:'Nu cantidad',
name:'nu_cantidad',
	value:''
});

this.mo_iva = new Ext.form.NumberField({
	fieldLabel:'Mo iva',
name:'mo_iva',
	value:''
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.co_factura,
                                                                                this.co_producto,
                                                                                this.mo_unitario,
                                                                                this.nu_cantidad,
                                                                                this.mo_iva,
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
                     facturadetalleFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    facturadetalleFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    facturadetalleFiltro.main.win.close();
                    facturadetalleLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    facturadetalleLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    facturadetalleFiltro.main.panelfiltro.getForm().reset();
    facturadetalleLista.main.store_lista.baseParams={}
    facturadetalleLista.main.store_lista.baseParams.paginar = 'si';
    facturadetalleLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = facturadetalleFiltro.main.panelfiltro.getForm().getValues();
    facturadetalleLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("facturadetalleLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        facturadetalleLista.main.store_lista.baseParams.paginar = 'si';
        facturadetalleLista.main.store_lista.baseParams.BuscarBy = true;
        facturadetalleLista.main.store_lista.load();


}
,getStoreCO_FACTURA:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storefkcofactura',
        root:'data',
        fields:[
            {name: 'co_factura'}
            ]
    });
    return this.store;
}
,getStoreCO_PRODUCTO:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storefkcoproducto',
        root:'data',
        fields:[
            {name: 'co_producto'}
            ]
    });
    return this.store;
}

};

Ext.onReady(facturadetalleFiltro.main.init,facturadetalleFiltro.main);
</script>
