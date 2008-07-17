<?php

/**
 * This class is used by effects that contain more than one effect.  It enables
 * them to ignore the adding and of effects to their respective containers.
 *
 */
abstract class DojoEffectsContainer extends DojoBaseEffect
{
    protected
        /** Set of effects for this container. */
        $effects = array();
    
    /**
     * Default constructor that sets all of the events for the container.
     *
     * @param mixed $effects Effects for the container.
     * @throws IllegalArgumentException If any of the effects in the array are
     *                                  not DojoBaseEffects.
     */
    public function __construct($effects = array())
    {
        $this->setEffects($effects);        
    }
    
    /**
     * Adds a DojoEffect to the set of effects.
     *
     * @param DojoEffect $effect Effect to add to the container.
     * @throws IllegalArgumentException If $effect is not an instance of 
     *                                  DojoBaseEffect.
     */
    public function addEffect($effect)
    {
        if (!$effect instanceof DojoBaseEffect)
            throw new IllegalArgumentException('The effect must be an instance of DojoBaseEffect.');
            
        $this->effects[] = $effect;
    }
    
    /**
     * Sets all of the effects for this container.  Throws exception if any of 
     * the effects are not an instance of DojoBaseEffect.
     *
     * @param mixed $effects Effects for the container.
     * @throws IllegalArgumentException If any item in $effects is not a
     *                                  DojoBaseEffect.
     */
    public function setEffects($effects = array())
    {
        if (!is_array($effects))
            $effects = array($effects);
        
        foreach ($effects as $effect)
        {
            if (!$effect instanceof DojoBaseEffect)
                throw new IllegalArgumentException('All effects must be an instance of DojoBaseEffect.');
        }
        
        $this->effects = $effects;
    }

}
?>