<?php

namespace Earls\CorporateBundle\Form\Type;

use Earls\CorporateBundle\Entity\Recordsoffices;
use Earls\CorporateBundle\Entity\Jurisdictions;
use Earls\CorporateBundle\Entity\Offices;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class OfficeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('officename', 'text')
            ->add('address', 'text')
            ->add('postalzip', 'text')
            //            ->add('liquorlicenseid', new LiquorlicensesType())
//            ->add('rentandmaintenanceid', new RentandmaintenancesType())
            /*->add('regionid', 'entity', array(
                'class' => 'EarlsLeaseBundle:Regions',
                'property' => 'region'
            ))*/
//            ->add('riskid', new RiskinfoType())



         /**   ->add('storeclassid', 'entity', array(
                'class' => 'EarlsLeaseBundle:Storeclasses',
                'property' => 'storeclass'
            ))
          */
                      
//            ->add('utilityid')

//            ->add('propertymanagerid', 'entity', array(
//                'class' => 'EarlsLeaseBundle:Propertymanagers',
//                'property' => 'propertymanagername'
//            ))


            ->add('city', 'entity', array(
                'class' => 'EarlsCorporateBundle:Northamericancities',
                'property' => 'city'
            ))
            
            ->add('officeid', 'entity', array(
                'class' => 'EarlsCorporateBundle:Offices',
                'property' => 'officename'
            ))
            
            ->add('officename', 'entity', array(
                'class' => 'EarlsCorporateBundle:Offices',
                'property' => 'officename'
            ))
            

                                    
            ->add('provincestateid', 'entity', array(
            'class' => 'EarlsCorporateBundle:Provincestate',
                'property' => 'description'
            ))
    ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Earls\CorporateBundle\Entity\Offices'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'earls_corporatebundle_offices';
    }
}

