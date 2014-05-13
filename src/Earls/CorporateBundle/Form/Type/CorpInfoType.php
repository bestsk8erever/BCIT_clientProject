<?php

namespace Earls\CorporateBundle\Form\Type;

use Earls\CorporateBundle\Entity\Corporations;

use Earls\LeaseBundle\Entity\Licenses;
use Earls\LeaseBundle\Form\Type\RestaurantsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CorpInfoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('corporationInfo', new CorporationsType())
           // ->add('liquorlicense', new LiquorlicensesType())
           // ->add('licenseinfo', new LicensesType())
           // ->add('riskinfo', new RiskinfoType())
           // ->add('rentandmaintenance', new RentandmaintenancesType())
           // ->add('utilities1', new UtilitiesType())
           // ->add('utilities2', new UtilitiesType())
           // ->add('utilities3', new UtilitiesType())
            ->add('officeInfo', new OfficeType())
            ->add('corporationId', 'hidden')
            ->add('Update', 'submit')
                ->getForm()
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Earls\CorporateBundle\Form\Model\CorpInfoModel',
        ));
    }

    public function getName()
    {
        return 'corp_info_form';
    }

} 