<?php

class DojoAnimateEffect extends DojoEffect
{
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['properties']))
        {
            $props = array();
            foreach ($this->options['properties'] as $prop => $values)
            {
                if (!is_array($values) && !empty($values))
                    $props[$prop] = $values;
                else
                {
                    $val = array();
                    if (isset($values['start']))
                        $val['start'] = "'".$values['start']."'";
                    if (isset($values['end']))
                        $val['end'] = "'".$values['end']."'";
                    if (isset($values['unit']))
                        $val['unit'] = "'".$values['unit']."'";
                    
                    if (!empty($val))
                        $props[$prop] = _dojo_options_for_javascript($val);
                }
            }
            if (!empty($props))
                $opts['properties'] = _dojo_options_for_javascript($props);
        }
    }
    
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addJavascript();
        
        return "dojo.animateProperty($js_options)";
    }
}
?>