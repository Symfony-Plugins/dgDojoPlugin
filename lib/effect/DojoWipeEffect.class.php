<?php

class DojoWipeEffect extends DojoEffect
{
    public function buildEffect()
    {
        $dir = 'In';
        if (isset($this->options['dir']))
        {
            $dir = ucfirst(strtolower($this->options['dir']));
        }
        
        $js_options = $this->optionsForEffect();
        
        DojoManager::addJavascript();
        DojoManager::addRequire(DojoTypes::DOJO_FX);
        
        return "dojo.fx.wipe$dir($js_options)";
    }
}
?>