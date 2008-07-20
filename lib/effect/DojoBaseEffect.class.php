<?php

sfLoader::loadHelpers(array('Dojo'));

/**
 * This is the base class used to specify DojoEffects.
 *
 */
abstract class DojoBaseEffect
{
    protected
        /** This holds various options for the effect. */
        $options  = array();
    
    /**
     * Returns a list of available callbacks for a Dojo effect.  The available
     * ones are:
     * 
     * 'animate' - Fired at each interval of the animation.
     * 'begin'   - Fired as the animation begins.
     * 'end'     - Fired after the final frame of the animation.
     * 'pause'   - Fired when the animation is paused.
     * 'play'    - Fired whenever the animation is played.
     * 'stop'    - Fired whenever the animation is stopped.
     *
     * @return array Set of strings that are available callbacks
     */
    public function getCallbacks()
    {
        static $callbacks;
        if (!$callbacks)
        {
            $callbacks = array('animate', 'begin', 'end', 'pause', 'play', 
                               'stop');
        }
        
        return $callbacks;
    }
    
    /**
     * Builds the callback functions in an array and then returns it.
     *
     * @return mixed Set of callbacks and their respective functions
     */
    protected function buildCallbacks()
    {
        $rval = array();
        foreach ($this->getCallbacks() as $callback)
        {
            if (isset($this->options[$callback]))
            {
                $name = 'on'.ucfirst($callback);
                $code = $this->options[$callback];
                $rval[$name] = 'function() {'.$code.'}';
            }
        }
        
        if (isset($this->options['beforeBegin']))
        {
            $code = $this->options['beforeBegin'];
            $rval['beforeBegin'] = "function() { $code }";
        }
        
        if (isset($this->options['easing']))
        {
            $code = $this->options['easing'];
            $rval['easing'] = "function(n) { $code }";
        }
        
        return $rval;
    }
    
    /**
     * Returns the function call to play a DojoEffect.
     *
     * @param integer $delay Amount of time in seconds to delay playing
     * @param boolean $gotoStart Set to true to start the animation at the
     *                           beginning.  False will make it start from
     *                           where it currently is.
     * @return string The effect calling the play function.
     */
    public function play($delay = 0, $gotoStart = false)
    {
        $delay *= 1000;
        return $this->buildEffect().".play($delay, ".(($gotoStart)?'true':'false').")";
    }
    
    /**
     * Magic method that builds the effect for adding to Javascript functions.
     *
     * @return string The built effect Javascript.
     */
    public function __toString()
    {
        return $this->buildEffect();
    }
    
    /**
     * Sets the options for this effect.  It verifies that the options are
     * valid and throws an exception if this is not the case.
     *
     * @param mixed $options The set of options for this effect.
     * @throws InvalidArgumentException If any of the options are not valid.
     */
    public function setOptions($options = array())
    {        
        $this->options = $options;
    }
    
    /**
     * Sets an option for the effect.  This validates that the option is a
     * valid option before proceeding.
     *
     * @param string $option Options being set.
     * @param string $value Value of the option being set.
     * @throws InvalidArgumentException If the option is not a valid option.
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
    
    /** Required method to build Javascript for an effect. */
    abstract public function buildEffect();
}
?>