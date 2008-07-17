<?php

class DojoHighlightEffect extends DojoEffect
{
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['color']) && $this->options['color'])
            $opts['color'] = '"'.$this->options['color'].'"';
    }
    
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        
        DojoManager::addJavascript();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.highlight($js_options)";
    }
}
?>