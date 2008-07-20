<?php

/**
 * This class houses the various built-in function calls for easing in Dojo.
 * Easing gives you the ability to alter the acceleration of the animation as it
 * goes.
 *
 */
DojoManager::addRequire(DojoTypes::EASING);

class DojoEasing
{
    const
        /** Pops past range at beginning and slowly continues effect. */
        BACK_IN = 'dojox.fx.easing.backIn',
        /** Pops past start and comes back then pops past end and comes back. */
        BACK_IN_OUT = 'dojox.fx.easing.backInOut',
        /** Pops past the range briefly and slowly comes back. */
        BACK_OUT = 'dojox.fx.easing.backOut',
        /** Bounces near the beginning of animation. */
        BOUNCE_IN = 'dojox.fx.easing.bounceIn',
        /** Bounces near beginning and end of animation. */
        BOUNCE_IN_OUT = 'dojox.fx.easing.bounceInOut',
        /** Bounces near end of animation. */
        BOUNCE_OUT = 'dojox.fx.easing.bounceOut',
        /** Slowly start animation based on circle equation. */
        CIRC_IN = 'dojox.fx.easing.circIn',
        /** Slowly start and end animation based on circle equation. */
        CIRC_IN_OUT = 'dojox.fx.easing.circInOut',
        /** Slowly end animation based on circle equation. */
        CIRC_OUT = 'dojox.fx.easing.circOut',
        /** Use cubic acceleration at beginning. */
        CUBIC_IN = 'dojox.fx.easing.cubicIn',
        /** Use cubic acceleration at beginning and end of animation. */
        CUBIC_IN_OUT = 'dojox.fx.easing.cubicInOut',
        /** Use cubic acceleration at end of animation. */
        CUBIC_OUT = 'dojox.fx.easing.cubicOut',
        /** Elasticly snap around value at beginning of animation. */
        ELASTIC_IN = 'dojox.fx.easing.elasticIn',
        /** Elasticly snap around value at beginning and end of animation. */
        ELASTIC_IN_OUT = 'dojox.fx.easing.elasticInOut',
        /** Elasticaly snap around value at end of animation. */
        ELASTIC_OUT = 'dojox.fx.easing.elasticOut',
        /** Exponential acceleration in the beginning. */
        EXPO_IN = 'dojox.fx.easing.expoIn',
        /** Exponential acceleration at beginning and end. */
        EXPO_IN_OUT = 'dojox.fx.easing.expoInOut',
        /** Exponential acceleration at end. */
        EXPO_OUT = 'dojox.fx.easing.expoOut',
        /** Linear acceleration across animation. */
        LINEAR = 'dojox.fx.easing.linear',
        /** Quadratic acceleration at beginning. */
        QUAD_IN = 'dojox.fx.easing.quadIn',
        /** Quadratic acceleration at beginning and end. */
        QUAD_IN_OUT = 'dojox.fx.easing.quadInOut',
        /** Quadratic acceleration at end. */
        QUAD_OUT = 'dojox.fx.easing.quadOut',
        /** Quartic acceleration at beginning. */
        QUART_IN = 'dojox.fx.easing.quartIn',
        /** Quartic acceleration at beginning and end. */
        QUART_IN_OUT = 'dojox.fx.easing.quartInOut',
        /** Quartic acceleration at end. */
        QUART_OUT = 'dojox.fx.easing.quartOut',
        /** Quintic acceleration at beginning. */
        QUINT_IN = 'dojox.fx.easing.quintIn',
        /** Quintic acceleration at beginning and end. */
        QUINT_IN_OUT = 'dojox.fx.easing.quintInOut',
        /** Quintic acceleration at end. */
        QUINT_OUT = 'dojox.fx.easing.quintOut',
        /** Sine acceleration at beginning. */
        SINE_IN = 'dojox.fx.easing.sineIn',
        /** Sine acceleration at beginning and end. */
        SINE_IN_OUT = 'dojox.fx.easing.sineInOut',
        /** Sine acceleration at end. */
        SINE_OUT = 'dojox.fx.easing.sineOut';
}
?>