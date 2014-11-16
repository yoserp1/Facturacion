<?php
    if(($datos!='')&&($codigoseg==$captcha))
        echo  "{success:true,msg:'Usuario Validado',url:'".$url."'}";
    else
        echo  "{failure:false,msg:'Usuario y/o Contraseña Invalida'}";   
?>
