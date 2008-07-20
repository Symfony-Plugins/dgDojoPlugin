<?php

/**
 * This class allows you to use a wipe effect to change the height or the width
 * of an HTML element.  It cannot do both.  To do both, use DojoSizeToEffect.
 *
 */
class DojoWipeToEffect extends DojoEffect
{
    /**
     * Adds additional options for the wipe to effect.  These include:
     * 
     * height - The new heigt for the element
     * width  - The new width for the element
     * 
     * Remember, you can only choose to change one, but no both.  To combine
     * them, use DojoSizeToEffect.
     *
     * @param mixed $opts Set of options being built
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['width']) && !isset($this->options['height']))
            $opts['width'] = $this->options['width'];
        if (!isset($this->options['width']) && isset($this->options['height']))
            $opts['height'] = $this->options['height'];
    }
    
    /**
     * Builds the Javascript to create a Dojo wipe to effect.
     *
     * @return string The generated Javascript for the effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.wipeTo($js_options)";
    }
}
?>