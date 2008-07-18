<?php

/**
 * This class creates an effect that essentially fades one div out while fading
 * another in.  It supports the same options as the DojoEffect class.  Both
 * nodes can be in Javascript if you would like, as well.
 *
 */
class DojoCrossFadeEffect extends DojoEffect
{
    protected
        /** This houses the first node in the cross */
        $firstNode = '',
        /** This houses the second node in the cross */
        $secondNode = '';
    
    /**
     * The constructor is overridden in this case because this effect requires
     * two nodes, but it still supports the effect options.  It also sends the
     * options up to the setOptions method.
     * 
     * In order to use Javascript nodes, set $options['jnode1'] and/or
     * $options['jnode2'] to true.
     *
     * @param string $node1 Javascript or element ID for first node
     * @param string $node2 Javascript or element ID for second node
     * @param mixed $options Set of options for the effect
     */
    public function __construct($node1, $node2, $options = array())
    {
        $this->setFirstNode($node1, isset($options['jnode1']) && $options['jnode1']);
        $this->setSecondNode($node2, isset($options['jonde2']) && $optsion['jnode2']);
        $this->setOptions($options);
    }
    
    /**
     * Sets the first node.  If you set $jscript to true, it will treat $node as
     * Javascript.
     *
     * @param string $node Javascript or node ID for first node
     * @param boolean $jscript True to interpret $node as Javascript
     */
    public function setFirstNode($node, $jscript = false)
    {
        $this->firstNode = ($jscript) ? $node : "'$node'";
    }
    
    /**
     * Sets the second node.  If you set $jscript to true, it will treat $node 
     * as Javascript.
     *
     * @param string $node Javascript or node ID for second node
     * @param boolean $jscript True to interpret $node as Javascript
     */
    public function setSecondNode($node, $jscript = false)
    {
        $this->secondNode = ($jscript) ? $node : "'$node'";
    }
        
    /**
     * Handles any additional options required for this effect.  For cross fade,
     * there are two important options:
     * 
     * node  - This is unset because the parent class sets it and it is not 
     *         needed
     * nodes - This is for the list of nodes in the effect.  This contains first
     *         and second nodes
     *
     * @param mixed $opts Current set of options being built
     */
    protected function additionalOptions(&$opts)
    {
        $opts['nodes'] = '['.$this->firstNode.','.$this->secondNode.']';
        unset($opts['node']);
    }
    
    /**
     * Builds the Javascript to create a Dojo cross fade effect.
     *
     * @return string The needed Javascript to create the event
     */
    public function buildEffect()
    {
        $js_options = $this->optionsForEffect();
        DojoManager::addRequire(DojoTypes::DOJOX_FX);
        
        return "dojox.fx.crossFade($js_options)";
    }
}
?>