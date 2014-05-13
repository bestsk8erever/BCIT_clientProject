<?php

namespace Earls\LeaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LicenseByExpiryController extends Controller
{
    /**
     * @Route("/", name="_license_byExpiry")
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

            $royaltyFee = $restaurant->getRoyaltyfee();
            $advertisingfee = $restaurant->getAdvertisingFee();
            $regionalmngtfee = $restaurant->getRegionalmngtfee();

            $licenselink = $restaurant->getLicenseid();

            if(empty($licenselink)){
                $licenseAgreement= "";
                $startDate= "";
                $expiryDate="";
                $comments="";
            }else{
                $licenseid = $licenselink->getLicenseid();

                $licenseObj = $this->getDoctrine()
                    ->getRepository('EarlsLeaseBundle:Licenses')
                    ->findOneBy(array(
                        'licenseid' => $licenseid
                    ));

                $licenseAgreement= "";
                $startDate= "";
                $expiryDate="";
                $comments="";

                if(isset($licenseObj)){
                    $licenseAgreementNum = $licenseObj->getLicenseagreement();
                    if($licenseAgreementNum = 1){
                        $licenseAgreement = "YES";
                    }else{
                        $licenseAgreement = "NO";
                    }

                    $startDateObj = $licenseObj->getStartdate();

                    if(isset($startDateObj)){
                        $startDate = $startDateObj->format('M d, Y');
                    }

                    $expiryDateObj = $licenseObj->getExpirarydate();

                    if(isset($expiryDateObj)){
                        $expiryDate = $expiryDateObj->format('M d, Y');
                    }

                    $comments = $licenseObj->getComments();
                }
            }

            $restaurantObj = array(
                'storeNickname' => $storeNickname,
                'licenseAgreement' => $licenseAgreement,
                'startDate' => $startDate,
                'expiryDate' => $expiryDate,
                'royaltyFee' => $royaltyFee,
                'advertisingFee' => $advertisingfee,
                'regionalFee' => $regionalmngtfee,
                'comments' => $comments,
                'restaurantId' => $storeId
            );

            array_push($restaurantArray, $restaurantObj);
        }

        return $this->render('EarlsLeaseBundle:LicenseByExpiry:index.html.twig',
            array(
                'licenseByExpiry' => $restaurantArray
            )
        );
    }


}

?>