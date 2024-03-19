<?php

namespace Orata\Bundle\PayboxBundle\Paybox;

/**
 * Interface ParameterResolverInterface
 *
 * @package Orata\Bundle\PayboxBundle\Paybox
 */
interface ParameterResolverInterface
{
    /**
     * Resolves parameters for a payment call.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function resolve(array $parameters);
}
