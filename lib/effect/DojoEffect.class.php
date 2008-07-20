<?php

/**
 * This class houses some of the various parts of a Dojo effect.  It maintains
 * the node for the effect and handles the default options for base Dojo
 * effects.
 *
 */
abstract class DojoEffect extends DojoBaseEffect
{                               
    protected
        /** What node this effect is for. */
        $node = null;

    /**
     * Creates a DojoEffect.
     *
     * @param string $effect The desired Dojo effect.
     * @throws DojoException If $effect is not a valid effect.
     */
    public function __construct($node, $options = array())
    {
        $this->setNode($node, (isset($options['jnode']) && $options['jnode']));
        $this->setOptions($options);
    }
    
    /**
     * Sets the node for this effect.  Can consist of an ID for a node or a
     * Javascript variable for that node.
     *
     * @param string $node What node this effect is for.
     * @param boolean $jscript True means the node should be treated as
     *                         javascript.
     */
    public function setNode($node, $jscript = false)
    {
        $this->node = ($jscript) ? $node : "'$node'"; 
    }

    /**
     * Gets the current node for this effect.  Will be in single quotes if the
     * setNode function was called with $jscript false.
     *
     * @return string The current effect node
     */
    public function getNode()
    {
        return $this->node;
    }
    
    /**
     * Builds all of the callbacks and sets up the base options to be used for
     * an effect javascript call.  The list of available options for this 
     * effect are:
     *      
     * delay    - How long to wait in seconds before starting effect after play
     * duration - How long the effect should play in seconds
     * rate     - The FPS for the effect
     * repeat   - How many times to repeat the effect
     * easing   - Function taking one decimal argument and returning a decimal
     *            that allows an effect to 'ease in' and 'ease out'.
     *
     * @return string All of the javascript options that have been set ready
     *                for use by the dojo effect.
     */
    protected function optionsForEffect()
    {
        $opts = $this->buildCallbacks();
        
        $opts['node'] = $this->getNode();
        
        if (isset($this->options['delay']) && $this->options['delay'] > 0)
            $opts['delay'] = $this->options['delay'] * 1000;
        
        if (isset($this->options['duration']) && $this->options['duration'] > 0)
            $opts['duration'] = $this->options['duration'] * 1000;
        
        if (isset($this->options['rate']) && $this->options['rate'] > 0)
            $opts['rate'] = $this->options['rate'];
        
        if (isset($this->options['repeat']) && $this->options['repeat'] > 0)
            $opts['repeat'] = $this->options['repeat'];
            
        if (isset($this->options['easing']) && $this->options['easing'])
            $opts['easing'] = $this->options['easing'];

        $this->additionalOptions($opts);
        
        return _dojo_options_for_javascript($opts);
    }
    
    /**
     * Adds any additional options that an effect may have.  This is generally
     * going to be overridden by subclasses.
     *
     * @param mixed $opts Current set of prepared options.  Modify this to 
     *                    include additional options.
     */
    protected function additionalOptions(&$opts)
    {
        // nothing to be added in the DojoEffect class
    }
}
?>