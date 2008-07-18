<?php

/**
 * This class can be used to animate any CSS3 property.  It allows you to still
 * specify all of the options for a regular Dojo effect, but you can tell it
 * the specific properties to animate in terms of their start and end values.
 *
 */
class DojoAnimateEffect extends DojoEffect
{
    /**
     * Adds the additional options to the options array being built.  This adds
     * the option 'properties' to the effect.  The 'properties' key is
     * expected to be a hash of 'cssProp' => 'endValue'.  You can also specify
     * all properties for an animation by replacing 'endValue' with another 
     * hash.  This hash can have the following properties:
     * 
     * start - What the property's start value should be for the animation
     * end   - The end value for the property at the end of animation
     * unit  - The units for start and end properties
     *
     * @param mixed $opts Set of options being built for Javascript
     */
    protected function additionalOptions(&$opts)
    {
        if (isset($this->options['properties']))
        {
            $props = array();
            foreach ($this->options['properties'] as $prop => $values)
            {
                if (!is_array($values) && !empty($values))
                    $props[$prop] = $values;
                else
                {
                    $val = array();
                    if (isset($values['start']))
                        $val['start'] = "'".$values['start']."'";
                    if (isset($values['end']))
                        $val['end'] = "'".$values['end']."'";
                    if (isset($values['unit']))
                        $val['unit'] = "'".$values['unit']."'";
                    
                    if (!empty($val))
                        $props[$prop] = _dojo_options_for_javascript($val);
                }
            }
            if (!empty($props))
                $opts['properties'] = _dojo_options_for_javascript($props);
        }
    }
    
    /**
     * Builds the Javascript for the desired effect.  Includes all necesary
     * bits.
     *
     * @return string The Javascript for creating an animateProperty effect
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addJavascript();
        
        return "dojo.animateProperty($js_options)";
    }
}
?>