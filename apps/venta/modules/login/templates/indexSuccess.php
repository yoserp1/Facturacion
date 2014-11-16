<script type="text/javascript">
Ext.onReady(function(){
this.captchaURL = "<?= $_SERVER['SCRIPT_NAME']; ?>/captcha?width=160&height=80&characters=4&t=";
function onCapthaChange(){
	var curr = Ext.get('codigoimagen');
	curr.slideOut('b', {callback: function(){
			Ext.get('codigoimagen').dom.src=this.captchaURL+new Date().getTime();
			curr.slideIn('t');		
	}},this);
}

this.boxCaptcha = new Ext.BoxComponent({
	width:150,
	height:80,	
	autoEl: {
			tag:'img',
			id:'codigoimagen',
			title:'Click para refrescar codigo',
			src:this.captchaURL+new Date().getTime()
		}
});

//Ventana para validar
function Validar(){
if (validarForm.form.isValid()) {
	validarForm.form.submit({
		waitTitle: "Validando",
		waitMsg : "Espere un momento por favor......",
		failure: function(form,action){
		    try{
			if(action.result.msg!=null)
			    Ext.utiles.msg('Error de Validaci&oacute;n', action.result.msg);
			else
			    throw Exception();
		    }catch(Exception){
			    Ext.utiles.msg('Error durante el proceso','Consulta al administrador del Sistema');
		    }
		},
		success: function(form,action) {
		    winValidar.hide();
		    location.href=action.result.url;
		}
	});
}
}

this.usuario = new Ext.form.TextField({
	fieldLabel:'Usuario',
	name: 'usuario',
	id:'usuario',
	allowBlank:false,
	maxLength:250,
	width:235
});

this.password = new Ext.form.TextField({
	fieldLabel:'Contraseña',
	inputType:'password',
	name: 'password',
	id:'password',
	allowBlank:false,
	maxLength:60,
	width:235
});

this.codigoseg = new Ext.form.TextField({
	autoCreate: {tag: "input", type: "text", autocomplete: "off", maxlength: 4 },
	fieldLabel:'Cod. Validacion',
	name: 'codigoseg',
	id:'codigoseg',
	allowBlank:false,
	maxLength:'4',
        width:80
});

this.compositefieldCodigo = new Ext.form.CompositeField({
fieldLabel: 'Codigo de Seguridad',
items: [
	this.codigoseg,
	this.boxCaptcha,
]
});

this.Panel = new Ext.Panel ({
	baseCls : 'x-plain',
	html    : 'El acceso a este lugar está restringido a los usuarios no autorizados.<br>Por favor escriba su nombre de usuario y contraseña.',
	cls     : 'icon-autorizacion',
	region  : 'north',
	height  : 50
});

var validarForm = new Ext.form.FormPanel({
	baseCls: 'x-plain',
	labelWidth: 180,
	autoWidth:true,
	autoHeight:true,
	frame:true,
	autoScroll:false,
	bodyStyle:'padding:10px;',
	url:'<?= $_SERVER['SCRIPT_NAME']; ?>/login/validar',
	items: [
		this.Panel,
		{
		xtype:'fieldset',title:'Usuario / Contraseña', autoWidth:true, labelWidth: 90, height:170, frame:false, defaultType: 'textfield',
		items:[
			this.usuario,
			this.password,
			this.compositefieldCodigo
		],
		keys: [
			{key: [Ext.EventObject.ENTER], handler: function() {
				Validar();
			}
		   }
		]
	    }
	]
});

var winValidar;

winValidar = new Ext.Window({
	title:'Validaci&oacute;n de Usuario',
	layout:'fit',
	iconCls: 'icon-bloqueado',
	bodyStyle:'padding:5px;',
	width:485,
        height: 330,
	modal:true,
	autoScroll: true,
	maximizable:false,
	closable:false,
	plain: true,
	buttonAlign:'center',
	items:[
	    //{xtype:'panel', baseCls:'x-plain', border:false, contentEl:'msgValidar', autoWidth: true, autoHeight:true},
	    validarForm
	],
	buttons: [{
	    text:'Entrar',
	    align:'center',
	    iconCls: 'icon-login',
	    handler: function (){
		            Validar();
	    }
	}]
});

this.boxCaptcha.on('render',function (){
	var curr = Ext.get('codigoimagen');
	curr.on('click',onCapthaChange,this);
},this);

setTimeout(function(){
	usuario.focus(true,true);
	},500);
	winValidar.show();
});
</script>
<input type="hidden" name="url_" id="url_" value="<?= $url ?>">
