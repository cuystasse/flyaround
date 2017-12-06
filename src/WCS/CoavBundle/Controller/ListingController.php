<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 05/12/17
 * Time: 12:18
 */

namespace WCS\CoavBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use WCS\CoavBundle\Entity\Flight;
use WCS\CoavBundle\Entity\PlaneModel;
use WCS\CoavBundle\Entity\Reservation;

/**
 * Class ListingController
 *
 * @Route("listing")
 */
class ListingController extends Controller
{
    /**
     * List a reservation with one flight and one planemodel with few ID
     *
     * @Route("/{reservation_id}/flight/{flight_id}/planemodel/{planemodel_id}", name="listing_index", requirements={"reservation_id": "\d+"})
     * @Method("GET")
     * @ParamConverter("reservation", options={"mapping": {"reservation_id": "id"}})
     * @ParamConverter("flight", options={"mapping": {"flight_id": "id"}})
     * @ParamConverter("planemodel", options={"mapping": {"planemodel_id": "id"}})
     *
     * @param Reservation $reservation
     * @param Flight $flight
     * @param PlaneModel $planeModel
     * @return mixed
     */
    public function indexActon(Reservation $reservation, Flight $flight, PlaneModel $planemodel)
    {
        return $this->render('listing/index.html.twig', [
            'reservation' => $reservation,
            'flight' => $flight,
            'planemodel' => $planemodel,
        ]);
    }
}