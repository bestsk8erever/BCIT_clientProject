<?php

namespace Earls\CorporateBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\Form\FormBuilder;

class CorpFinder extends AbstractType
{
	private $cities = array();

	public function __construct(array $northCities)
	{
		//print_r($this);
		$this->city = $northCities;
		
		//$cities = $northCities;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		// $builder->add('Store Number', 'choice', array(
		// 	'choices' => $this->restaurantNumber,
		// 	));
		// $builder->add('city', 'text')
		// 		->setMethod('POST');

		print_r($this->city);

		//$dummyArray = array('Vancouver' => 'Vancouver', 'Toronto' => 'Toronto');

		$builder->add('City', 'choice', array(
			//'choices' =>$this->$northCities->getCity()
			'choices' => array('Vancouver' => 'Vancouver', 'Toronto' => 'Toronto'),
			'required' => false,
			 ));
	}

	public function getName()
	{
		return 'corporation';
	}
	
}

?>

