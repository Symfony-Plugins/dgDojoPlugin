<?php

/**
 * Dojo lacks a real good way of doing togglers that happen when you click.
 * This class fixes this by using an attribute in a dom node and an if
 * statement to control what effect gets played depending on the status of the 
 * key attribute.  This attribute is 'displayed'.  Setting this to 'no' will
 * cause the show effect to be done first while setting it to 'yes' will make
 * the hide effect happen first.
 *
 */
class DojoToggleEffect extends DojoEffectsContainer
{            
    /**
     * This is a class override to handle the setting of effects.  The big issue
     * is maintaining that only two effects are entered and both have to point
     * to the same node.  The first effect is the hide and the second is the
     * show effect for purposes of the toggle.
     *
     * @param mixed $effects Set of effects to be used in toggle
     * @throws DojoEffectException If there are not 2 effects passed in or
     *                             if both effects don't point to same node
     */
    public function setEffects($effects = array())
    {
        parent::setEffects($effects);
        
        if (count($this->effects) != 2)
            throw new DojoEffectException('DojoToggleEffect takes only two effects.');
         
        if ($this->effects[0]->getNode() != $this->effects[1]->getNode())
            throw new DojoEffectException('The events for the DojoToggleEffect do not reference the same node.');
    }
    
    /**
     * This overrides the default play method because this uses an if statement
     * and will therefore not know what to do with '.play()' appended to it.
     *
     * @return string The completed Javascript for this effect
     */
    public function play()
    {
        return $this->buildEffect();
    }
    
    /**
     * This builds a toggle effect in Javascript.  It essentially uses the
     * 'displayed' attribute of an element to identify if the element is 
     * currently displayed or not.  If it is not displayed, the display effect
     * will be triggered.  If it is displayed, the hide effect will be played.
     *
     * @return string The Javascript to do the toggle of effects
     */
    public function buildEffect()
    {
        DojoManager::addJavascript();
        
        // find the node in the dom
        $script  = 'var node = dojo.byId('.$this->effects[0]->getNode().');';
        // get the 'displayed attribute'
        $script .= 'var disp = dojo.attr(node, "displayed");';
        // if the attribute isn't there or it is displayed, play the hide
        $script .= 'if (!disp || disp == "yes") {';
        $script .= $this->effects[0]->play().';';
        $script .= 'disp = "no";';
        $script .= '} else {';
        // play the show if it node isn't displayed
        $script .= $this->effects[1]->play().';';
        $script .= 'disp = "yes";';
        $script .= '}';
        // save the new displayed status to attributes
        $script .= 'dojo.attr(node, "displayed", disp);';
        
        return $script;
    }
}
?>