<?php

/**
 * This class embodies the effect of scrolling to a particular element on a
 * page.  This enables you to choose which element or window gets scrolled and
 * gives you the ability to offset from the target node by some amount.
 *
 */
class DojoSmoothScrollEffect extends DojoEffect
{
    /**
     * This function handles the extra arguments sent to the smooth scroll
     * effect.  These include:
     * 
     * offset - An array of 'x' and 'y' that offset from the target node
     * win    - What element or window object to scroll.  Defaults to the windo
     *
     * @param mixed $opts Set of options currently being built
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['offset']) && is_array($this->options['offset']))
        {
            $offset = array();
            if (isset($this->options['x']))
                $offset['x'] = $this->options['x'];
            if (isset($this->options['y']))
                $offset['y'] = $this->options['y'];
            
            // Make sure there is something in the offset
            if (!empty($offset))
                $opts['offset'] = _dojo_options_for_javascript($offset);
        }
        
        // 'win' has to be set, so default to 'window'
        if (isset($this->options['win']))
            $opts['win'] = $this->options['win'];
        else
            $opts['win'] = 'window';
    }
    
    /**
     * Builds the Javascript for a Smooth scroll effect.
     *
     * @return string The completed Javascript for the effect.\
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::SCROLL);
        
        return "dojox.fx.smoothScroll($js_options)";
    }
}
?>