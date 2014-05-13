<?php

namespace Earls\LeaseBundle\Controller;

use Earls\LeaseBundle\Entity\Storeclasses;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Earls\LeaseBundle\Entity\Leases;

class LeasesByExpiryController extends Controller
{
    /**
     * @Route("/", name="_leases_byExpiry")
     * @Template()
     */
    public function indexAction()
    {
        $restaurantlist = $this->getDoctrine()
            ->getRepository('EarlsLeaseBundle:Restaurants')
            ->findAll();

        $restaurantArray = array();
        $restaurantObj = array();

        foreach($restaurantlist as $restaurant){

            $storeNickname = $restaurant->getStorenickname();

            $storeId = $restaurant->getRestaurantid();

            $restaurantStoreClass = $restaurant->getStoreclassid();

            if(empty($restaurantStoreClass)){
                $storeClass= "";
            }else{
                $storeClassid = $restaurantStoreClass->getStoreclassid();

                $storeClassObj = $this->getDoctrine()
                    ->getRepository('EarlsLeaseBundle:Storeclasses')
                    ->find($storeClassid);

                $storeClass= $storeClassObj->getStoreclass();
            }


            $storeId = $restaurant->getRestaurantid();

            $leaseObj = $this->getDoctrine()
                ->getRepository('EarlsLeaseBundle:Leases')
                ->findOneBy(array(
                    'restaurantid' => $storeId
                ));

            if(empty($leaseObj)){
                $leaseObj = new Leases();
            }

            $leaseExpiryDateObj = $leaseObj->getExpirydate();

            $leaseExpiryDate= "";

            if(isset($leaseExpiryDateObj)){
                $leaseExpiryDate = $leaseExpiryDateObj->format('M d, Y');
            }

            $leaseOptionDate = $leaseObj->getOptiontime();

            $leaseOptionDeadlineObj = $leaseObj->getRenewaloptiondate();

            $leaseOptionDeadline= "";

            if(isset($leaseOptionDeadlineObj)){
                $leaseOptionDeadline = $leaseOptionDeadlineObj->format('M d, Y');
            }

            $leaseRenewalComments = $leaseObj->getRenewalcomments();

            $restaurantObj = array(
                'storeNickName' => $storeNickname,
                'storeClass' => $storeClass,
                'leaseExpiryDate' => $leaseExpiryDate,
                'leaseOptionDate' => $leaseOptionDate,
                'leaseOptionDeadline' => $leaseOptionDeadline,
                'leaseRenewalComments' =>$leaseRenewalComments,
                'restaurantId' => $storeId
            );

            array_push($restaurantArray, $restaurantObj);
        }

        return $this->render('EarlsLeaseBundle:LeasesByExpiry:index.html.twig',
            array(
                'leasesByExpiry' => $restaurantArray
            )
        );
    }
}

?>