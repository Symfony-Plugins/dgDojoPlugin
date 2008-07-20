<?php

/**
 * This class enables you to create Javascript to remove a certain class from an
 * element with a little animation.  This is iffy in a chain, so do this only 
 * after testing.
 *
 */
class DojoRemoveClassEffect extends DojoEffect
{
    /**
     * Handles the additional options.  The additional options are:
     * 
     * class - The class to be removed.
     * 
     * If you do not specify 'class', an exception will be thrown.
     *
     * @param mixed $opts Set of options being built
     * @throws DojoEffectException If you fail to specify the class
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['class']) && $this->options['class'])
            $opts['cssClass'] = '"'.$this->options['class'].'"';
        else
            throw new DojoEffectException('DojoRemoveClassEffect requires a class to add in the options.');
    }
    
    /**
     * Builds the Javascript required to remove the class.
     *
     * @return string The Javascript to do a class removal with style
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::STYLE);
        
        return "dojox.fx.removeClass($js_options)";
    }
}
?>