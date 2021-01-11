<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\VehicleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Entity\RefillStation;
use App\Form\RefillStationType;
use App\Repository\RefillStationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminProductController extends AbstractController
{
     /**
     * Displays the page for add a new vehicle
     * @Route("vehicule/ajouter", name="vehicle_new", methods={"GET","POST"})
     * @return Response
     */
    public function newVehicle(Request $request): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays the page for add a new charging-station
     * @Route("borne-de-recharge/ajouter", name="charging_station_new", methods={"GET","POST"})
     * @return Response
     */
    public function newChargingStation(Request $request): Response
    {
        $refillStation = new RefillStation();
        $form = $this->createForm(RefillStationType::class, $refillStation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refillStation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_charging_stations');
        }

        return $this->render('admin/charging_station_new.html.twig', [
            'refill_station' => $refillStation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays the page view vehicle details
     * @Route("vehicule/{id}", name="vehicle_show", methods={"GET"})
     * @return Response
     */
    public function showVehicle(Vehicle $vehicle): Response
    {
        return $this->render('admin/vehicle_show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Displays the page view charging-station details
     * @Route("borne-de-recharge/{id}", name="charging_station_show", methods={"GET"})
     * @return Response
     */
    public function showChargingStation(RefillStation $refillStation): Response
    {
        return $this->render('admin/charging_station_show.html.twig', [
            'refill_station' => $refillStation,
        ]);
    }

    /**
     * Provides access to the page to modify a vehicle
     * @Route("vehicule/{id}/modifier", name="vehicle_edit", methods={"GET","POST"})
     * @return Response
     */
    public function editVehicle(Request $request, Vehicle $vehicle): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

     /**
     * Provides access to the page to modify a charging-station
     * @Route("borne-de-recharge/{id}/modifier", name="charging_station_edit", methods={"GET","POST"})
     * @return Response
     */
    public function editChargingStation(Request $request, RefillStation $refillStation): Response
    {
        $form = $this->createForm(RefillStationType::class, $refillStation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_charging_stations');
        }

        return $this->render('admin/charging_station_edit.html.twig', [
            'refill_station' => $refillStation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * Displays the page for delete a vehicle
     * @Route("/vehicule/{id}", name="vehicle_delete", methods={"DELETE"})
     * @return Response
     */
    public function deleteVehicle(Request $request, Vehicle $vehicle): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_vehicles');
    }

    /**
     * Displays the page for delete a charging-station
     * @Route("/borne-de-recharge/{id}", name="charging_station_delete", methods={"DELETE"})
     * @return Response
     */
    public function deleteChargingStation(Request $request, RefillStation $refillStation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $refillStation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refillStation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_charging_stations');
    }
}
