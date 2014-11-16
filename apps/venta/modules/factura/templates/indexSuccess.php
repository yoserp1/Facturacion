<script type="text/javascript">
Ext.ns('facturaEditar');
facturaEditar.main = {
init: function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'<?php echo $data ?>'});
//<Stores de fk>
this.storeCO_DOCUMENTO = this.getStoreCO_DOCUMENTO();
//<Stores de fk>
//<Stores de fk>
this.storeCO_TIPO_FACTURA = this.getStoreCO_TIPO_FACTURA();
//<Stores de fk>

//<ClavePrimaria>
this.co_factura = new Ext.form.Hidden({
    name:'co_factura',
    value:this.OBJ.co_factura});
//</ClavePrimaria>

this.co_cliente = new Ext.form.Hidden({
    name:'co_cliente',
    value:this.OBJ.co_cliente});

this.co_tipo_factura = new Ext.form.ComboBox({
	fieldLabel:'Co tipo factura',
	store: this.storeCO_TIPO_FACTURA,
	typeAhead: true,
	valueField: 'co_tipo_factura',
	displayField:'tx_tipo_factura',
	hiddenName:'t12_factura[co_tipo_factura]',
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
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_tipo_factura,
	value:  this.OBJ.co_tipo_factura,
	objStore: this.storeCO_TIPO_FACTURA
});

this.co_documento = new Ext.form.ComboBox({
	fieldLabel:'Co documento',
	store: this.storeCO_DOCUMENTO,
	typeAhead: true,
	valueField: 'co_documento',
	displayField:'tx_documento',
	hiddenName:'t10_cliente[co_documento]',
	//readOnly:(this.OBJ.co_documento!='')?true:false,
	//style:(this.OBJ.co_documento!='')?'background:#c9c9c9;':'',
	forceSelection:true,
	resizable:true,
	triggerAction: 'all',
	emptyText:'...',
	selectOnFocus: true,
	mode: 'local',
	width:40,
	resizable:true,
	allowBlank:false
});
this.storeCO_DOCUMENTO.load();
	paqueteComunJS.funcion.seleccionarComboByCo({
	objCMB: this.co_documento,
	value:  this.OBJ.co_documento,
	objStore: this.storeCO_DOCUMENTO
});

this.tx_dni = new Ext.form.TextField({
	fieldLabel:'Tx dni',
	name:'t10_cliente[tx_dni]',
	value:this.OBJ.tx_dni,
	allowBlank:false,
	width:155,
	minLength : 5,
	autoCreate: {tag: "input", type: "textfield", autocomplete: "off", maxlength: 8},
});

this.tx_dni.on('specialkey', function(f, event) {
    if(event.getKey() == event.ENTER) {
        facturaEditar.main.verificarCliente();
    }
}, this);

this.tx_dni.on('blur',function(){
    facturaEditar.main.verificarCliente();
});

this.tx_nombre = new Ext.form.TextField({
	fieldLabel:'Nombre',
	name:'t10_cliente[tx_nombre]',
	value:this.OBJ.tx_nombre,
	allowBlank:false,
	width:250
});

this.compositefieldCI = new Ext.form.CompositeField({
fieldLabel: 'Cedula / Rif',
items: [
	this.co_documento,
	this.tx_dni,
             {
                   xtype: 'displayfield',
                   value: '&nbsp;&nbsp;&nbsp; Nombre:',
                   width: 90
             },
	this.tx_nombre
	]
});

this.tx_direccion = new Ext.form.TextField({
	fieldLabel:'Direccion',
	name:'t10_cliente[tx_direccion]',
	value:this.OBJ.tx_direccion,
	allowBlank:false,
	width:550
});

this.tx_telefono = new Ext.form.TextField({
	fieldLabel:'Telefono',
	name:'t10_cliente[tx_telefono]',
	value:this.OBJ.tx_telefono,
	allowBlank:false,
	width:200
});

this.nu_limite_credito = new Ext.form.NumberField({
	fieldLabel:'Limite Credito',
	name:'t10_cliente[nu_limite_credito]',
	value:this.OBJ.nu_limite_credito,
	allowBlank:false,
	width:40
});

this.compositefieldTl = new Ext.form.CompositeField({
fieldLabel: 'Telefono',
items: [
	this.tx_telefono,
             {
                   xtype: 'displayfield',
                   value: ' Limite Credito:',
                   width: 90
             },
	this.nu_limite_credito
	]
});

this.fe_factura = new Ext.form.DateField({
	fieldLabel:'Fecha',
	name:'t12_factura[fe_factura]',
//	value:this.OBJ.fe_factura,
        value: (this.OBJ.fe_factura)?this.OBJ.fe_factura:'<?= date('d-m-Y'); ?>',
	allowBlank:false,
	width:100
});

this.compositefieldFactura = new Ext.form.CompositeField({
fieldLabel: 'Fecha',
items: [
	this.fe_factura,
             {
                   xtype: 'displayfield',
                   value: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Factura:',
                   width: 190
             },
	this.co_tipo_factura
	]
});

//Agregar un registro
this.nuevo = new Ext.Button({
	text:'Agregar',
	id:'AgregarDet',
	iconCls: 'icon-nuevo',
	handler: function(boton){
		paqueteComunJS.funcion.mostrarVentana({url:'<?= $_SERVER['SCRIPT_NAME'] ?>/facturadetalle/editar',parametro:'no'});
	}
});

//Eliminar un registro
this.eliminar= new Ext.Button({
	text:'Quitar',
	iconCls: 'icon-eliminar',
	handler: function(boton){
		facturaEditar.main.eliminarArticulo();
	        facturaEditar.main.getTotalCancelar();
	}
});

this.eliminar.disable();

this.Registro = Ext.data.Record.create([
	{ name: 'co_producto', type: 'number'},
	{ name: 'tx_producto', type: 'string' },
	{ name: 'mo_unitario', type: 'number'},
	{ name: 'nu_cantidad', type: 'number'},
	{ name: 'mo_total', type: 'number'},
	{ name: 'nu_procentaje_iva', type: 'number'},
]);

this.store_lista =  new Ext.data.GroupingStore({
	reader: new Ext.data.JsonReader({fields:facturaEditar.main.Registro})
});

/*if(this.OBJ.co_factura!='')
{
	this.store_lista = new Ext.data.JsonStore({
		url:'<?= $_SERVER["SCRIPT_NAME"] ?>/facturadetalle/storelista',
		root:'data',
		fields: [
				{name: 'co_producto'},
				{name: 'tx_producto'},
				{name: 'mo_unitario'},
				{name: 'nu_cantidad'},
				{name: 'mo_total'},
				{name: 'nu_procentaje_iva'},
			]
		});
	this.store_lista.load({
		params: {co_factura:facturaEditar.main.co_factura.getValue()},
	});
}*/

this.displayfieldneto = new Ext.form.DisplayField({
	value:"<b>Precio Base: Bs. 0.00</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
});

this.displayfieldiva = new Ext.form.DisplayField({
	value:"<b>I.V.A: Bs. 0.00</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
});

this.displayfieldttotalacancelar = new Ext.form.DisplayField({
	value:"<span style='font-size:15px;'><b>Total a Cancelar: Bs. 0.00</b></span>&nbsp;&nbsp;&nbsp;"
});

//Grid principal
this.gridPanel_ = new Ext.grid.GridPanel({
    iconCls: 'icon-libro',border:true,
    store: this.store_lista,
    loadMask:true,
    height:300,
    //autoHeight:true,
    tbar:[
        this.nuevo,'-',this.eliminar
    ],
    bbar: new Ext.ux.StatusBar({
	    id: 'basic-statusbar',
	    autoScroll:true,
	    defaults:{style:'color:black;font-size:10px;',autoWidth:true},
	    items:[this.displayfieldneto,'-',this.displayfieldiva,'-',this.displayfieldttotalacancelar]
    }),
    columns: [
    new Ext.grid.RowNumberer(),
    {header: 'Codigo', width:100,  menuDisabled:true, sortable: true,  dataIndex: 'co_producto'},
    {header: 'Descripcion', width:280,  menuDisabled:true, sortable: true,  dataIndex: 'tx_producto'},
    {header: 'Cantidad', width:60,  menuDisabled:true, sortable: true,  dataIndex: 'nu_cantidad'},
    {header: 'Precio Unitario', width:120,  menuDisabled:true, sortable: true, xtype: 'numbercolumn',format: 'Bs 0,0.00', dataIndex: 'mo_unitario'},
    {header: 'Total', width: 100,  menuDisabled:true, sortable: true, dataIndex: 'mo_total',
		renderer: function(v, params, record){
			   return paqueteComunJS.funcion.getNumeroFormateado(record.data.nu_cantidad * record.data.mo_unitario);
		}
    },
    {header: 'nu_procentaje_iva',hidden:true, menuDisabled:true,dataIndex: 'nu_procentaje_iva'},
    ],
    stripeRows: true,
    autoScroll:true,
    stateful: true,
    listeners:{cellclick:function(Grid, rowIndex, columnIndex,e ){facturaEditar.main.eliminar.enable();}}
});

this.JsonDetalle = new Ext.form.Hidden({
	name:'t12_factura[json_detalle]',
	value:''
});

this.guardar = new Ext.Button({
    text:'Facturar',
    iconCls: 'icon-pagos',
    handler:function(){

        if(!facturaEditar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }

//*****Array del Grid********//
	listado = paqueteComunJS.funcion.getJsonByObjStore({
		store:facturaEditar.main.gridPanel_.getStore()
	});
	facturaEditar.main.JsonDetalle.setValue(listado);
//**************************//
        facturaEditar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/guardar',
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
		window.open("../reportes/factura?codigo="+action.result.co_factura);
                 }
	    facturaEditar.main.formPanel_.getForm().reset();
            facturaEditar.main.store_lista.baseParams={};
            facturaEditar.main.store_lista.removeAll();
	    facturaEditar.main.getTotalCancelar();
             }
        });

   
    }
});

this.guardar.disable();

this.salir = new Ext.Button({
    text:'Limpiar',
//    iconCls: 'icon-cancelar',
    handler:function(){
	    facturaEditar.main.formPanel_.getForm().reset();
            facturaEditar.main.store_lista.removeAll();
	    facturaEditar.main.getTotalCancelar();
    }
});


this.fieldset1 = new Ext.form.FieldSet({
        title: 'Datos de la Factura',
        items:[
                    this.co_factura,
                    this.co_cliente,
                    this.compositefieldFactura,
                    this.compositefieldCI,
                    this.tx_direccion,
                    this.compositefieldTl,
		]
});

this.fieldset2 = new Ext.form.FieldSet({
              title:'Detalle de la Factura',
              items:[                           
		    this.gridPanel_,this.JsonDetalle
]});

this.formPanel_ = new Ext.form.FormPanel({
	bodyStyle: 'padding:10px',
	autoWidth:true,
	autoHeight:true,
	border:false,
	id: 'forma', 
	iconCls:'icon-calculadora',             
	title: 'Nueva Factura',
	items:[
		this.fieldset1,
		this.fieldset2
	],
	buttonAlign:'center',
		buttons:[
			this.guardar,
			this.salir
	]
});

        this.formPanel_.render('formularioFactura');
}
,eliminarArticulo:function(){
                var s = facturaEditar.main.gridPanel_.getSelectionModel().getSelections();
                for(var i = 0, r; r = s[i]; i++){
                      facturaEditar.main.store_lista.remove(r);
                }
},
getTotalCancelar:function(){
		var cantidad = facturaEditar.main.store_lista.getCount();
                if(cantidad > 0)
                {this.guardar.enable();}else{this.guardar.disable();}

		var total_base=0;
		var total_iva=0;
		var total_pagar=0;
		facturaEditar.main.store_lista.each(function(record){
			var base = record.get('mo_unitario')*record.get('nu_cantidad');
			total_base+=base;
			total_iva+=base*(record.get('nu_procentaje_iva')/100);
			total_pagar+=base + (base*(record.get('nu_procentaje_iva')/100));
		});

		total_base=paqueteComunJS.funcion.getNumeroFormateado(total_base);
		total_iva=paqueteComunJS.funcion.getNumeroFormateado(total_iva);
		total_pagar=paqueteComunJS.funcion.getNumeroFormateado(total_pagar);

                facturaEditar.main.displayfieldneto.setValue("<b>Precio Base: "+total_base+"<b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                facturaEditar.main.displayfieldiva.setValue("<b>I.V.A: "+total_iva+"<b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                facturaEditar.main.displayfieldttotalacancelar.setValue("<span style='font-size:15px;'><b>Total a Cancelar: "+total_pagar+"<b></span>&nbsp;&nbsp;&nbsp;");
},
getStoreCO_DOCUMENTO:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/cliente/storefkcodocumento',
        root:'data',
        fields:[
            {name: 'co_documento'},{name: 'tx_documento'}
            ]
    });
    return this.store;
},
getStoreCO_TIPO_FACTURA:function(){
    this.store = new Ext.data.JsonStore({
        url:'<?php echo $_SERVER["SCRIPT_NAME"] ?>/factura/storefkcotipofactura',
        root:'data',
        fields:[
            {name: 'co_tipo_factura'},{name: 'tx_tipo_factura'}
            ]
    });
    return this.store;
},
verificarCliente:function(){
  if(facturaEditar.main.co_documento.getValue()==''){
                Ext.Msg.alert("Alerta","Debe indicar el tipo de documento");
                return false;
            }

            if(facturaEditar.main.tx_dni.getValue()==''){
                Ext.Msg.alert("Alerta","Debe indicar el numero de documento");
                return false;
            }

            Ext.Ajax.request({
                method:'GET',
                url:'<?= $_SERVER["SCRIPT_NAME"]?>/cliente/verificar',
                params:{
                    co_documento: facturaEditar.main.co_documento.getValue(),
                    tx_dni: facturaEditar.main.tx_dni.getValue()
                },
                success:function(result, request ) {
                    obj = Ext.util.JSON.decode(result.responseText);
                    if(!obj.data){
                        facturaEditar.main.co_cliente.setValue("");
//                        facturaEditar.main.tx_dni.focus(true,true);
			facturaEditar.main.tx_nombre.setValue("");
			facturaEditar.main.tx_direccion.setValue("");
			facturaEditar.main.tx_telefono.setValue("");
			facturaEditar.main.nu_limite_credito.setValue("");
                    }else{
                        facturaEditar.main.co_cliente.setValue(obj.data.co_cliente);
			facturaEditar.main.tx_dni.setValue(obj.data.tx_dni);
                        facturaEditar.main.tx_nombre.setValue(obj.data.tx_nombre);
			facturaEditar.main.tx_direccion.setValue(obj.data.tx_direccion);
                        facturaEditar.main.tx_telefono.setValue(obj.data.tx_telefono);
                        facturaEditar.main.nu_limite_credito.setValue(obj.data.nu_limite_credito);
                    }
                }
 });
}
};
Ext.onReady(facturaEditar.main.init, facturaEditar.main);
</script>
<div id="formularioFactura"></div>
<div id="formulario_detalle"></div>
