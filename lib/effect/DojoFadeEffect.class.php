<?php

/**
 * This class is used to create a Dojo effect that fades a div.  It assumes
 * that you want a fade in unless you set the direction option as 'out' in
 * which case a fadeOut effect will be done.
 *
 */
class DojoFadeEffect extends DojoEffect
{
    /**
     * Builds the Javascript to create this effect.  You will get Javascript 
     * errors if you use anything other than 'in' or 'out' as the 'dir' option.
     *
     * @return string The completed Javascript for the effect.
     */
    public function buildEffect()
    {
        $dir = 'In';
        if (isset($this->options['dir']))
            $dir = ucfirst(strtolower($this->options['dir']));
        
        $js_options = $this->optionsForEffect();
        DojoManager::addJavascript();
        
        return "dojo.fade$dir($js_options)";
    }
}
?>