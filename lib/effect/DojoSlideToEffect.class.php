<?php

/**
 * This class creates events that let you slide a node to any particular spot
 * on the screen.  It uses top and left references to place the node.
 *
 */
class DojoSlideToEffect extends DojoEffect
{
    /**
     * This handles the additional options available for the Slide to effect.
     * These options are:
     * 
     * left - End position based on the left side of the screen
     * top  - End position in reference to top of page
     *
     * @param mixed $opts Set of options being built
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['left']))
            $opts['left'] = $this->options['left'];
        if (isset($this->options['top']))
            $opts['top'] = $this->options['top'];
    }
    
    /**
     * Builds the Javascript to create the slide to effect.
     *
     * @return string The created Javascript for the effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJO_FX);
        
        return "dojo.fx.slideTo($js_options)";
    }
}
?>