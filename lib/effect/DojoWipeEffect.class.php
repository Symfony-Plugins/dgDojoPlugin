<?php

/**
 * This class creates a Dojo wipe effect for an element.  This class defaults
 * to a wipeIn unless you specify the 'dir' option as 'out'.
 *
 */
class DojoWipeEffect extends DojoEffect
{
    /**
     * Builds the needed Javascript to create the desired effect.  You will get
     * Javascript errors if you specify the 'dir' option as anything other than
     * 'in' or 'out'.
     *
     * @return string The Javascript to create the effect
     */
    public function buildEffect()
    {
        $dir = 'In';
        if (isset($this->options['dir']))
            $dir = ucfirst(strtolower($this->options['dir']));
        
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJO_FX);
        
        return "dojo.fx.wipe$dir($js_options)";
    }
}
?>