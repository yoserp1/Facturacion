<script type="text/javascript">
Ext.ns("<?php echo $this->getModuleName() ?>Editar");
<?php echo $this->getModuleName() ?>Editar.main = {
init:function(){

this.OBJ = paqueteComunJS.funcion.doJSON({stringData:'[?= $data ?]'});
<?php foreach ($this->getAllColumns() as $name => $column): ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php if($column->isForeignKey()): ?>
//<Stores de fk>
this.store<?= $column->getRelatedColumnName() ?> = this.getStore<?= $column->getRelatedColumnName() ?>();
//<Stores de fk>
<?php endif; ?>
<?php endforeach; ?>

<?php foreach ($this->getPrimaryKey() as $pk): ?>
//<ClavePrimaria>
this.<?= strtolower($pk->getName()) ?> = new Ext.form.Hidden({
    name:'<?= strtolower($pk->getName()) ?>',
    value:this.OBJ.<?= strtolower($pk->getName()) ?>
});
//</ClavePrimaria>
<?php endforeach; ?>

<?php foreach ($this->getColumns('editar.display') as $name => $column): ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?= $this->getColumnEditTag($column) ?>
<?php endforeach; ?>

this.guardar = new Ext.Button({
    text:'Guardar',
    iconCls: 'icon-guardar',
    handler:function(){

        if(!<?php echo $this->getModuleName() ?>Editar.main.formPanel_.getForm().isValid()){
            Ext.Msg.alert("Alerta","Debe ingresar los campos en rojo");
            return false;
        }
        <?php echo $this->getModuleName() ?>Editar.main.formPanel_.getForm().submit({
            method:'POST',
            url:'[?= $_SERVER["SCRIPT_NAME"] ?]/<?php echo $this->getModuleName() ?>/guardar',
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
                 }
                 <?php echo $this->getModuleName() ?>Lista.main.store_lista.load();
                 <?php echo $this->getModuleName() ?>Editar.main.winformPanel_.hide();
             }
        });

   
    }
});

this.salir = new Ext.Button({
    text:'Salir',
//    iconCls: 'icon-cancelar',
    handler:function(){
        <?php echo $this->getModuleName() ?>Editar.main.winformPanel_.close();
    }
});

this.formPanel_ = new Ext.form.FormPanel({
    frame:true,
    width:400,
autoHeight:true,  
    autoScroll:true,
    bodyStyle:'padding:10px;',
    items:[

        <?php foreach ($this->getColumns('editar.display') as $name => $column): ?>
            this.<?= $column->getName() ?>,
        <?php endforeach; ?>
    ]
});

this.winformPanel_ = new Ext.Window({
    title:'Formulario: <?php echo $this->getModuleName() ?>',
    modal:true,
    constrain:true,
width:400,
    frame:true,
    closabled:true,
    autoHeight:true,
    items:[
        this.formPanel_
    ],
    buttons:[
        this.guardar,
        this.salir
    ],
    buttonAlign:'center'
});
this.winformPanel_.show();
<?php echo $this->getModuleName() ?>Lista.main.mascara.hide();
}
<?php foreach ($this->getAllColumns() as $name => $column): ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php if($column->isForeignKey()): ?>
,getStore<?= $column->getRelatedColumnName() ?>:function(){
    this.store = new Ext.data.JsonStore({
        url:'[?= $_SERVER["SCRIPT_NAME"] ?]/<?php echo $this->getModuleName() ?>/storefk<?= strtolower($column->getPhpName()) ?>',
        root:'data',
        fields:[
            {name: '<?= strtolower($column->getRelatedColumnName()) ?>'}
            ]
    });
    return this.store;
}
<?php endif; ?>
<?php endforeach; ?>
};
Ext.onReady(<?php echo $this->getModuleName() ?>Editar.main.init, <?php echo $this->getModuleName() ?>Editar.main);
</script>
