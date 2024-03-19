<?php

namespace Orata\Bundle\PayboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * Class SampleController
 *
 * @package Orata\Bundle\PayboxBundle\Controller
 */
class SampleController extends Controller
{
    /**
     * Index action creates the form for a payment call.
     *
     * @return Response
     */
    public function indexAction()
    {
        $paybox = $this->get('orata_paybox.request_handler');
        $paybox->setParameters(array(
            'PBX_CMD'          => 'CMD'.time(),
            'PBX_DEVISE'       => '978',
            'PBX_PORTEUR'      => 'test@paybox.com',
            'PBX_RETOUR'       => 'Mt:M;Ref:R;Auto:A;Erreur:E',
            'PBX_TOTAL'        => '1000',
            'PBX_TYPEPAIEMENT' => 'CARTE',
            'PBX_TYPECARTE'    => 'CB',
            'PBX_EFFECTUE'     => $this->generateUrl('orata_paybox_sample_return', array('status' => 'success'), UrlGenerator::ABSOLUTE_URL),
            'PBX_REFUSE'       => $this->generateUrl('orata_paybox_sample_return', array('status' => 'denied'), UrlGenerator::ABSOLUTE_URL),
            'PBX_ANNULE'       => $this->generateUrl('orata_paybox_sample_return', array('status' => 'canceled'), UrlGenerator::ABSOLUTE_URL),
            'PBX_RUF1'         => 'POST',
            'PBX_REPONDRE_A'   => $this->generateUrl('orata_paybox_ipn', array('time' => time()), UrlGenerator::ABSOLUTE_URL),
        ));

        return $this->render(
            'OrataPayboxBundle:Sample:index.html.twig',
            array(
                'url'  => $paybox->getUrl(),
                'form' => $paybox->getForm()->createView(),
            )
        );
    }

    /**
     * Return action for a confirmation payment page on which the user is sent
     * after he seizes his payment informations on the Paybox's platform.
     * This action might only containts presentation logic.
     *
     * @param Request $request
     * @param string  $status
     *
     * @return Response
     */
    public function returnAction(Request $request, $status)
    {
        return $this->render('OrataPayboxBundle:Sample:return.html.twig', array(
            'status'     => $status,
            'parameters' => $request->query,
        ));
    }
}
