<?php

namespace Orata\Bundle\PayboxBundle\Tests\Paybox\System\Base;

use Orata\Bundle\PayboxBundle\Paybox\System\Base\ParameterResolver;

/**
 * Paybox\System\ParameterResolver class tests.
 *
 */
class ParameterResolverTest extends \PHPUnit\Framework\TestCase
{
    public function testResolveFirst()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver(array());
        $resolver->resolve(array());
    }

    public function testResolveNoCurrency()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver(array('953'));
        $resolver->resolve(array(
            'PBX_CMD'         => '',
            'PBX_DEVISE'      => '',
            'PBX_HASH'        => '',
            'PBX_HMAC'        => '',
            'PBX_IDENTIFIANT' => '',
            'PBX_PORTEUR'     => '',
            'PBX_RANG'        => '',
            'PBX_RETOUR'      => '',
            'PBX_SITE'        => '',
            'PBX_TIME'        => '',
            'PBX_TOTAL'       => '',
        ));
    }

    public function testResolveBadCurrency()
    {
        $this->expectExceptionMessageMatches('/PBX_DEVISE/');

        $resolver = new ParameterResolver(array('953'));
        $resolver->resolve(array(
            'PBX_CMD'         => '',
            'PBX_DEVISE'      => '978',
            'PBX_HASH'        => '',
            'PBX_HMAC'        => '',
            'PBX_IDENTIFIANT' => '',
            'PBX_PORTEUR'     => '',
            'PBX_RANG'        => '',
            'PBX_RETOUR'      => '',
            'PBX_SITE'        => '',
            'PBX_TIME'        => '',
            'PBX_TOTAL'       => '',
        ));
    }

    public function testResolveUndefinedParameter()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver(array());
        $resolver->resolve(array(
            'unknow'          => '',
            'PBX_CMD'         => '',
            'PBX_DEVISE'      => '',
            'PBX_HASH'        => '',
            'PBX_HMAC'        => '',
            'PBX_IDENTIFIANT' => '',
            'PBX_PORTEUR'     => '',
            'PBX_RANG'        => '',
            'PBX_RETOUR'      => '',
            'PBX_SITE'        => '',
            'PBX_TIME'        => '',
            'PBX_TOTAL'       => '',
        ));
    }
}
