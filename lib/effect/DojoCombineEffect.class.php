<?php

/**
 * This class can be used to combine multiple Dojo effects to play at the same
 * time.  This allows for some interesting effects.
 *
 */
class DojoCombineEffect extends DojoEffectsContainer
{
    /**
     * Builds the Javascript for a Dojo combine effect.  It also includes the
     * Dojo javascripts and requires the 'dojo.fx' piece.
     *
     * @return string The completed Javascript for the effect
     */
    public function buildEffect()
    {
        DojoManager::addJavascript();
        DojoManager::addRequire(DojoTypes::DOJO_FX);
        
        return 'dojo.fx.combine(['.implode(',', $this->effects).'])';
    }
}
?>