<script type="text/javascript">
Ext.ns("loginFiltro");
loginFiltro.main = {
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
                     loginFiltro.main.aplicarFiltroByFormulario();
                }
            },
            {
                text:'Limpiar',
                handler:function(){
                    loginFiltro.main.limpiarCamposByFormFiltro();
                }
            },
            {
                text:'Cerrar',
                handler:function(){
                    loginFiltro.main.win.close();
                    loginLista.main.filtro.setDisabled(false);
                }
            }
        ]
    });
    this.win.show();
    loginLista.main.mascara.hide();
},
limpiarCamposByFormFiltro: function(){
    loginFiltro.main.panelfiltro.getForm().reset();
    loginLista.main.store_lista.baseParams={}
    loginLista.main.store_lista.baseParams.paginar = 'si';
    loginLista.main.gridPanel_.store.load();
},
aplicarFiltroByFormulario: function(){
    //Capturamos los campos con su value para posteriormente verificar cual
    //esta lleno y trabajar en base a ese.
    var campo = loginFiltro.main.panelfiltro.getForm().getValues();
    loginLista.main.store_lista.baseParams={};

    var swfiltrar = false;
    for(campName in campo){
        if(campo[campName]!=''){
            swfiltrar = true;
            eval("loginLista.main.store_lista.baseParams."+campName+" = '"+campo[campName]+"';");
        }
    }

        loginLista.main.store_lista.baseParams.paginar = 'si';
        loginLista.main.store_lista.baseParams.BuscarBy = true;
        loginLista.main.store_lista.load();


}

};

Ext.onReady(loginFiltro.main.init,loginFiltro.main);
</script>