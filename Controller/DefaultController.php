<?php

namespace Orata\Bundle\PayboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @package Orata\Bundle\PayboxBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * Instant Payment Notification action.
     * Here, presentation is anecdotal, the requesting server only looks at the http status.
     *
     * @return Response
     */
    public function ipnAction()
    {
        $payboxResponse = $this->container->get('orata_paybox.response_handler');
        $result = $payboxResponse->verifySignature();

        return new Response($result ? 'OK' : 'KO');
    }
}
