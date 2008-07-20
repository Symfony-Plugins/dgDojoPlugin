<?php

/**
 * This class enables you to toggle a class on and off for an element.  Right
 * now, it does not support all of the usual options for DojoEffects and only
 * uses the 'class' option and the node passed in the constructor.
 *
 */
class DojoToggleClassEffect extends DojoEffect
{
    /**
     * Handles the additional arguments.  The additional arguments are:
     * 
     * class - The class to toggle on and off of an element
     * 
     * This will throw an exception if you do not specify the class to be
     * toggled.
     *
     * @param mixed $opts Set of options being built
     * @throws DojoEffectException If you do not set the 'class' option
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['class']) && $this->options['class'])
            $opts['cssClass'] = $this->options['class'];
        else
            throw new DojoEffectException('DojoToggleClassEffect requires a class to add in the options.');
    }
    
    /**
     * Builds the Javascript to toggle the class on the element.  This function
     * specifically uses the node and 'class' option only to build the effect.
     * This will stay this way until Dojo updates the library.
     *
     * @return string The Javascript to do the effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::STYLE);
        
        $rval  = 'dojox.fx.toggleClass(';
        $rval .= $this->getNode().', "';
        $rval .= $this->options['class'].'")';
        
        return $rval;
    }
}
?>