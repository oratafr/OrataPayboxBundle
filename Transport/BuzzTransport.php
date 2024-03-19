<?php

namespace Orata\Bundle\PayboxBundle\Transport;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Message\Response;
use Orata\Bundle\PayboxBundle\Paybox\RequestInterface;

/**
 * Class BuzzTransport
 *
 * @package Orata\Bundle\PayboxBundle\Transport
 *
 */
class BuzzTransport extends AbstractTransport
{
    /**
     * Buzz's curl browser.
     *
     * @var Browser
     */
    protected $browser;

    /**
     * {@inheritDoc}
     */
    public function __construct($url = '')
    {
        $this->browser = new Browser(new Curl());

        parent::__construct($url);
    }

    /**
     * {@inheritDoc}
     */
    public function call(RequestInterface $request)
    {
        /**
         * @var Response $response
         */
        $response = $this->browser->submit($this->getEndpoint(), $request->getParameters());

        if ($response->isSuccessful()) {
            return $response->getContent();
        } else {
            return false;
        }
    }
}
