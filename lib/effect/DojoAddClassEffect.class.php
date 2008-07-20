<?php

/**
 * This class can be used to do a transition to add a particular class to an
 * element.  Be aware that using this in a chain looks weird.
 *
 */
class DojoAddClassEffect extends DojoEffect
{
    /**
     * Handle the additional options for this effect.  These options are:
     * 
     * class - The class to be added to the node
     * 
     * If you do not set class, this will throw an exception.
     *
     * @param mixed $opts Set of options being built
     * @throws DojoEffectException If the 'class' option is not set
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['class']) && $this->options['class'])
            $opts['cssClass'] = '"'.$this->options['class'].'"';
        else
            throw new DojoEffectException('DojoAddClassEffect requires a class to add in the options.');
    }
    
    /**
     * Builds the effect Javascript for making an addClass effect.
     *
     * @return string Javascript to make the effect happen
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::STYLE);
        
        return "dojox.fx.addClass($js_options)";
    }
}
?>