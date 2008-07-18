<?php

/**
 * This class allows you to chain effects together without having to write
 * custom methods for the onEnd handle of the effects.
 *
 */
class DojoChainEffect extends DojoEffectsContainer
{
    /**
     * Builds the effect code for a Dojo Chain effect.  It also pulls in the 
     * needed Dojo javascript and adds the 'dojo.fx' require.
     *
     * @return string The completed javascript to chain the effects
     */
    public function buildEffect()
    {
        DojoManager::addRequire(DojoTypes::DOJO_FX);
        
        return 'dojo.fx.chain(['.implode(',', $this->effects).'])';
    }
}
?>