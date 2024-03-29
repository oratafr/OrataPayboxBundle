<?php

namespace Orata\Bundle\PayboxBundle\Tests\Paybox\System\Cancellation;

use Orata\Bundle\PayboxBundle\Paybox\System\Cancellation\ParameterResolver;

/**
 * Paybox\System\ParameterResolver class tests.
 *
 * @author Fabien Pomerol <fabien.pomerol@gmail.com>
 */
class ParameterResolverTest extends \PHPUnit\Framework\TestCase
{
    public function testResolveFirst()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver();
        $resolver->resolve(array());
    }

    public function testResolveSecond()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver();
        $resolver->resolve(array(
            'VERSION'     => '',
            'TYPE'        => '',
            'SITE'        => '',
            'IDENTIFIANT' => '',
            'MACH'        => '',
            'HMAC'        => '',
            'TIME'        => '',
        ));
    }

    public function testResolveThird()
    {
        $this->expectException('InvalidArgumentException');

        $resolver = new ParameterResolver();
        $resolver->resolve(array(
            'unknow'      => '',
            'VERSION'     => '',
            'TYPE'        => '',
            'SITE'        => '',
            'IDENTIFIANT' => '',
            'MACH'        => '',
            'HMAC'        => '',
            'TIME'        => '',
        ));
    }
}
