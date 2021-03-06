<?php
/**
 * Created by PhpStorm.
 * User: alfredo-ub
 * Date: 06/11/13
 * Time: 7:27 PM
 */

namespace Earls\LeaseBundle\Form\Model;

use Earls\LeaseBundle\Entity\Licenses;
use Earls\LeaseBundle\Entity\Liquorlicenses;
use Earls\LeaseBundle\Entity\Rentandmaintenances;
use Earls\LeaseBundle\Entity\Restaurants;
use Earls\LeaseBundle\Entity\Riskinfo;
use Earls\LeaseBundle\Entity\Utilities;
use Symfony\Component\Validator\Constraints as Assert;

//use Earls\LeaseBundle\Form\Model\LandlordSectionModel;


class StoreInformationModel {


    protected $restaurantinfo;

    protected $liquorlicense;

    protected $licenseinfo;

    protected $riskinfo;

    protected $rentandmaintenance;

    protected $utilities1;

    protected $utilities2;

    protected $utilities3;

    protected $restaurantId;


    public function setRestaurantinfo(Restaurants $restaurantinfo)
    {
        $this->restaurantinfo = $restaurantinfo;
    }

    public function getRestaurantinfo()
    {
        return $this->restaurantinfo;
    }

    public function setLiquorlicense(Liquorlicenses $liquorlicense)
    {
        $this->liquorlicense = $liquorlicense;
    }

    public function getLiquorlicense()
    {
        return $this->liquorlicense;
    }

    public function setLicenseinfo(Licenses $licenseinfo)
    {
        $this->licenseinfo = $licenseinfo;
    }

    public function getLicenseinfo()
    {
        return $this->licenseinfo;
    }

    public function setRiskinfo(Riskinfo $riskinfo)
    {
        $this->riskinfo = $riskinfo;
    }

    public function getRiskinfo()
    {
        return $this->riskinfo;
    }

    public function setRentandmaintenance(Rentandmaintenances $rentandmaintenance)
    {
        $this->rentandmaintenance = $rentandmaintenance;
    }

    public function getRentandmaintenance()
    {
        return $this->rentandmaintenance;
    }

    public function setUtilities1(Utilities $utilities1)
    {
        $this->utilities1 = $utilities1;
    }

    public function getUtilities1()
    {
        return $this->utilities1;
    }

    public function setUtilities2(Utilities $utilities2)
    {
        $this->utilities2 = $utilities2;
    }

    public function getUtilities2()
    {
        return $this->utilities2;
    }

    public function setUtilities3(Utilities $utilities3)
    {
        $this->utilities3 = $utilities3;
    }

    public function getUtilities3()
    {
        return $this->utilities3;
    }

    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function getRestaurantId()
    {
        return $this->restaurantId;
    }


} 