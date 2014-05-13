<?php
namespace Earls\CorporateBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Earls\CorporateBundle\Entity\Corporations;



class CorporationFinder
{

	protected $corporation;


	public function setCorporation(Corporations $corporation)
	{
		$this->corporation = $corporation;
	}

	public function getCorporation()
	{
		return $this->corporation;
	}

}

?>