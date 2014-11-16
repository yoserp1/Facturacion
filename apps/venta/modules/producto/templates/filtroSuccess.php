<script type="text/javascript">
Ext.ns("productoFiltro");
productoFiltro.main = {
init:function(){

//<Stores de fk>
this.storeCO_PROVEEDOR = this.getStoreCO_PROVEEDOR();
//<Stores de fk>



this.tx_producto = new Ext.form.TextField({
	fieldLabel:'Tx producto',
	name:'tx_producto',
	value:''
});

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

this.nu_precio = new Ext.form.NumberField({
	fieldLabel:'Nu precio',
name:'nu_precio',
	value:''
});

this.nu_procentaje_iva = new Ext.form.NumberField({
	fieldLabel:'Nu procentaje iva',
name:'nu_procentaje_iva',
	value:''
});

this.nu_precio_iva = new Ext.form.NumberField({
	fieldLabel:'Nu precio iva',
name:'nu_precio_iva',
	value:''
});

this.in_activo = new Ext.form.Checkbox({
	fieldLabel:'In activo',
	name:'in_activo',
	checked:true
});

this.nu_stock = new Ext.form.NumberField({
	fieldLabel:'Nu stock',
name:'nu_stock',
	value:''
});

this.in_excento_iva = new Ext.form.Checkbox({
	fieldLabel:'In excento iva',
	name:'in_excento_iva',
	checked:true
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.tx_producto,
                                                                                this.co_proveedor,
                                                                                this.nu_precio,
                                                                                this.nu_procentaje_iva,
                                                                                this.nu_precio_iva,
                                                                                this.in_activo,
                                                                                this.nu_stock,
                                                                                this.in_excento_iva,
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
                     productoFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    productoFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    productoFiltro.main.win.close();
                    productoLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    productoLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    productoFiltro.main.panelfiltro.getForm().reset();
    productoLista.main.store_lista.baseParams={}
    productoLista.main.store_lista.baseParams.paginar = 'si';
    productoLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = productoFiltro.main.panelfiltro.getForm().getValues();
    productoLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("productoLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        productoLista.main.store_lista.baseParams.paginar = 'si';
        productoLista.main.store_lista.baseParams.BuscarBy = true;
        productoLista.main.store_lista.load();


}
,getStoreCO_PROVEEDOR:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/producto/storefkcoproveedor',
        root:'data',
        fields:[
            {name: 'co_proveedor'}
            ]
    });
    return this.store;
}

};

Ext.onReady(productoFiltro.main.init,productoFiltro.main);
</script>