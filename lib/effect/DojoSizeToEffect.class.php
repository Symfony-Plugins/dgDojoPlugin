<?php

/**
 * This effect allows you to change the size an element to a desired size.  It
 * also lets you decide if this change is done width then height or both at the
 * same time.
 *
 */
class DojoSizeToEffect extends DojoEffect
{
    /**
     * This sets up the additional options for the size to effect.  The added
     * options are: 
     * 
     * width  - Final width of the element after animation
     * height - Final height of the element after animation
     * method - Method to do, either 'chain' or 'combine' 
     *
     * @param mixed $opts Set of options being built for Javascript
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['width']))
            $opts['width'] = $this->options['width'];
            
        if (isset($this->options['height']))
            $opts['height'] = $this->options['height'];
            
        if (isset($this->options['method']))
            $opts['method'] = "'".$this->options['method']."'";
    }
    
    /**
     * Builds the Javascript needed to do the Dojo effect.
     *
     * @return string The Javascript to create the effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.sizeTo($js_options)";
    }
}
?>