<script type="text/javascript">
Ext.ns("rolFiltro");
rolFiltro.main = {
init:function(){




this.tx_rol = new Ext.form.TextField({
	fieldLabel:'Tx rol',
	name:'tx_rol',
	value:''
});

    this.tabpanelfiltro = new Ext.TabPanel({
       activeTab:0,
       defaults:{layout:'form',bodyStyle:'padding:7px;',height:135,autoScroll:true},
       items:[
               {
                   title:'Información general',
                   items:[
                                                                                                            this.tx_rol,
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
                     rolFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    rolFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    rolFiltro.main.win.close();
                    rolLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    rolLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    rolFiltro.main.panelfiltro.getForm().reset();
    rolLista.main.store_lista.baseParams={}
    rolLista.main.store_lista.baseParams.paginar = 'si';
    rolLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = rolFiltro.main.panelfiltro.getForm().getValues();
    rolLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("rolLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        rolLista.main.store_lista.baseParams.paginar = 'si';
        rolLista.main.store_lista.baseParams.BuscarBy = true;
        rolLista.main.store_lista.load();


}

};

Ext.onReady(rolFiltro.main.init,rolFiltro.main);
</script>