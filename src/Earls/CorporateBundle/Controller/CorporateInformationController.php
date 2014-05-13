<?php

// src/Acme/CorporateBundle/Controller/CorporateInformationController.php
namespace Earls\CorporateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Doctrine\Tests\Common\Annotations\Null;
use Earls\LeaseBundle\Entity\Licenses;
use Earls\LeaseBundle\Entity\Liquorlicenses;
use Earls\LeaseBundle\Entity\Rentandmaintenances;
use Earls\LeaseBundle\Entity\Riskinfo;
use Earls\LeaseBundle\Entity\Utilities;
use Earls\LeaseBundle\Entity\Utilitytypes;
use Earls\LeaseBundle\Form\Model\StoreInformationModel;
use Earls\LeaseBundle\Form\Type\StoreInformationType;

// MY IMPORTS
use Earls\CorporateBundle\Entity\Corporations;
use Earls\CorporateBundle\Form\Model\CorpInfoModel;
use Earls\CorporateBundle\Form\Type\CorpInfoType;
use Earls\CorporateBundle\Entity\Registeredoffices;
use Earls\CorporateBundle\Entity\Offices;
use Earls\CorporateBundle\Entity\Recordsoffices;
use Earls\CorporateBundle\Entity\Regions;
use Earls\CorporateBundle\Entity\Provincestate;


use Earls\CorporateBundle\Form\Type\CorporationFinderType;
use Earls\CorporateBundle\Form\Model\CorporationFinder;



// these import the form
use Earls\LeaseBundle\Form\Type\RestaurantFinderType;
use Earls\LeaseBundle\Form\Model\RestaurantFinder;


use Earls\LeaseBundle\Entity\Restaurants;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;


// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

// these import the Store Information form
use Earls\LeaseBundle\Form\Type\LandlordSectionType;
use Earls\LeaseBundle\Form\Model\LandlordSectionModel;


class CorporateInformationController extends Controller

{
    /**
     * @Route("/", name="_corporateinformation")
     * @Template()
     */
    public function indexAction()
    {   
    
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM EarlsCorporateBundle:Corporations c');

        $data = $query->getResult();
        $corporationID = $data[0]->getCorporateid();

    	return $this->redirect($this->generateUrl('_corporateinformation_display', array('id' => $corporationID)));

    }

    /**
     * @Route("/{id}", name="_corporateinformation_display")
     * @Template()
     */
    public function displayAction($id)
    {

        $corporationObj = $this->getDoctrine()
            ->getRepository('EarlsCorporateBundle:Corporations')
            ->find($id);
       
       $allCorporations = array();
       
       foreach($corporationObj as $corporation){
       		$recordsOffice = " ";
       		$registeredOffice = " ";
       		
       		$recordsOfficeObj = $corporation->getRecordsOffice();
       		$registeredOfficeObj = $corporation->getRegisteredOffice();
       		
       		if (!empty($recordsOfficeObj)){
       			$recordsOffice = $recordsOfficeObj->getOfficename();
       			}
       		
       		if (!empty($registeredOfficeObj)){
       			$registeredOffice = $registeredOfficeObj->getOfficename();
       			}
       			
       		$corporationObj = array('officeid' => $corporation->getOfficeid(), 'registeredoffice' => $registeredOffice, 'recordsoffice' => $recordsOffice);
       		array_push($allCorporations);
       		}
       
       
	//	$officeObj = $this->getDoctrine()
	//		->getRepository('EarlsCorporateBundle:Offices')
	//		->find($id);
		
	//	$corporatioOfficeObj = $corporationObj->getRecordsOfficeid();
		
	//	if (!empty($corporationOfficeObj)){
			
		
	//		$corporationOffice = $corporationOfficeObj->getOffice
                 
       // $registeredofficeId = $corporationObj->getRegisteredofficeid()->getOfficeid();
                        
      //  $registeredOfficeObj = $this->getDoctrine()
       //     ->getRepository('EarlsCorporateBundle:Registeredoffices')
       //     ->find($registeredofficeId);



        $selectedCorporation = new CorporationFinder();
        $selectedCorporation->setCorporation($corporationObj);
        $formRequested = $this->createForm(new CorporationFinderType(), $selectedCorporation);

        $request = $this->getRequest();
        $formRequested->handleRequest($request);


        if ($formRequested->isValid()) {
            $corporationObjRequested = $formRequested->getData()->getCorporation();
            $corporationID = $corporationObjRequested->getCorporateid();

            return $this->redirect($this->generateUrl('_corporateinformation_display', array('id' => $corporationID)));
        }
        
        $corpinfomodel = new CorpInfoModel();
        
        if (isset($corporationObj))
        	$corpinfomodel -> setCorporationinfo($corporationObj);
        	$corpinfomodel -> setCorporationId($id);
        //	$corpinfomodel -> setOfficeId($officeObj);
        	
        	
        	$corpInfoForm = $this -> createForm(new CorpInfoType(), $corpinfomodel, array(
        		'action' => $this -> generateUrl('_corporateinformation_update', array('id' => $id))
        	));
        
		/** Store Information Form */
        
     /**    $storeinformationnmodel = new StoreInformationModel();

        if (isset($restaurantObj))
            $storeinformationnmodel->setRestaurantinfo($restaurantObj);
        $storeinformationnmodel->setRestaurantId($id);
        if (isset($license))
            $storeinformationnmodel->setLicenseinfo($license);
        if (isset($liquorlicensesObj))
            $storeinformationnmodel->setLiquorlicense($liquorlicensesObj);
        if (isset($riskinfoObj))
            $storeinformationnmodel->setRiskinfo($riskinfoObj);
        if (isset($rentandmaintenancesObj))
            $storeinformationnmodel->setRentandmaintenance($rentandmaintenancesObj);
        if (isset($utilitiesObj1))
            $storeinformationnmodel->setUtilities1($utilitiesObj1);
        if (isset($utilitiesObj2))
            $storeinformationnmodel->setUtilities2($utilitiesObj2);
        if (isset($utilitiesObj3))
            $storeinformationnmodel->setUtilities3($utilitiesObj3);

        $storeInfoForm = $this->createForm(new StoreInformationType(), $storeinformationnmodel, array(
            'action' => $this->generateUrl('_corporateinformation_update', array('id' => $id))
        ));

*/

        return $this->render('EarlsCorporateBundle:CorporateInformation:index.html.twig',
            array(
                'corpFinderForm' => $formRequested->createView(),
                'corpInfoForm' => $corpInfoForm->createView(),
                'corpInfoForm2' => $corpInfoForm->createView(),
                'allCorporations' => $allCorporations,
             //   'RegisteredObj' => $registeredOfficesObj,
               // 'totals' => array('totalSeats' => $totalSeats, 'totalTables' => $totalTables),
            )
        );

    }
    
    /**
     * @Route("/update/{id}", name="_corporateinformation_update")
     * @Template()
     */
  public function UpdateAction($id)
    {
        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        $corpInfoObj = new CorpInfoModel();
        $corporation = $em->getRepository('EarlsCorporateBundle:Corporations')->find($id);
        $coprInfoObj->setCorporationinfo($corporation);

       // $license = $restaurant->getLicenseid()->getLicenseid();
      //  $licenseObj = $em->getRepository('EarlsLeaseBundle:Licenses')->find($license);
       // if (isset($licenseObj)) {
      //      $storeInfoObj->setLicenseinfo($licenseObj);
      //  }

        $form = $this->createForm(new CorpInfoType(), $corpInfoObj);


        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {

                $em->flush();
                return $this->redirect($this->generateUrl('_corporateinformation_display', array('id' => $id)));

            } else {

                print_r('is not Valid');
                print_r($form->getErrorsAsString());

            }
        } else {

            print_r($request->getMethod());

        }


        return $this->render('EarlsCorporateBundle:CorporateInformation:index.html.twig',
            array('form' => $form->createView())
        );

    }
}

?>