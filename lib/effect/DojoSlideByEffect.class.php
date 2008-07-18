<?php

/**
 * This class allows you to create a slide by effect that moves an element up,
 * down, left, or right some amount.  Playing the animation again will cause
 * the element to move the same amount again from it's current location.
 *
 */
class DojoSlideByEffect extends DojoEffect
{
    /**
     * Handles the additional options for this effect.  These options are:
     * 
     * left - How much to move div from its current left position
     * top  - How much to move element from its current top position
     *
     * @param mixed $opts Set of options currently being built
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['left']))
            $opts['left'] = $this->options['left'];
        if (isset($this->options['top']))
            $opts['top'] = $this->options['top'];
    }
    
    /**
     * This builds the slide by effect and returns the script to make one.
     *
     * @return string Javascript to create the effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.slideBy($js_options)";
    }
}
?>