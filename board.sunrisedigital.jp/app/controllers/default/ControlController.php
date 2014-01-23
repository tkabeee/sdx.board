<?php

class ControlController extends Sdx_Controller_Action_Http
{
    public function __call($name, $arguments)
    {
        $helper = new Sdx_Controller_Action_Helper_Scaffold();
        $this->addHelper($helper);
        
        $this->_helper->scaffold->setViewRendererPath('default/control/scaffold.tpl');
        $this->_helper->scaffold->run();
    }
}