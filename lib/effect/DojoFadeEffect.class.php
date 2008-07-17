<?php

class DojoFadeEffect extends DojoEffect
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
        
        return "dojo.fade$dir($js_options)";
    }
}
?>