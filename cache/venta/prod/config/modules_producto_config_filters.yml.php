<?php
// auto-generated by sfFilterConfigHandler
// date: 2014/07/30 18:31:49


list($class, $parameters) = (array) sfConfig::get('sf_rendering_filter', array('sfRenderingFilter', array (
)));
$filter = new $class(sfContext::getInstance(), $parameters);
$this->register($filter);

// does this action require security?
if ($actionInstance->isSecure())
{
  
list($class, $parameters) = (array) sfConfig::get('sf_security_filter', array('sfBasicSecurityFilter', array (
)));
$filter = new $class(sfContext::getInstance(), $parameters);
$this->register($filter);
}

list($class, $parameters) = (array) sfConfig::get('sf_common_filter', array('sfCommonFilter', null));
$filter = new $class(sfContext::getInstance(), $parameters);
$this->register($filter);

list($class, $parameters) = (array) sfConfig::get('sf_execution_filter', array('sfExecutionFilter', array (
)));
$filter = new $class(sfContext::getInstance(), $parameters);
$this->register($filter);

