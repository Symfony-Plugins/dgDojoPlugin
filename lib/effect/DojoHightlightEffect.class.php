<?php

/**
 * This class is for creating Dojo highlight effects.  It adds another option
 * to the available options for effects, 'color'.  This allows you to design
 * what the highlight color should be.
 *
 */
class DojoHighlightEffect extends DojoEffect
{
    /**
     * Sets up additional options for this class.  In this case, the class
     * can take an optional parameter for 'color'.  This changes what the
     * highlight color will be.
     *
     * @param mixed $opts Reference to the options object being built
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['color']) && $this->options['color'])
            $opts['color'] = '"'.$this->options['color'].'"';
    }
    
    /**
     * Builds the needed Javascript to create the highlight effect.  It also
     * pulls in the needed Javascript elements.
     *
     * @return string The Javascript for creating a Dojo highlight
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.highlight($js_options)";
    }
}
?>