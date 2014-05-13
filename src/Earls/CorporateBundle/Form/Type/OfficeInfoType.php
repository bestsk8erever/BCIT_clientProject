<?php

namespace Earls\CorporateBundle\Form\Type;

use Earls\CorporateBundle\Entity\Offices;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CorpInfoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('officeInfo', new OfficeType())
           // ->add('liquorlicense', new LiquorlicensesType())
           // ->add('licenseinfo', new LicensesType())
           // ->add('riskinfo', new RiskinfoType())
           // ->add('rentandmaintenance', new RentandmaintenancesType())
           // ->add('utilities1', new UtilitiesType())
           // ->add('utilities2', new UtilitiesType())
           // ->add('utilities3', new UtilitiesType())
           

		//	->add('officeinfo', new OfficeType())
            ->add('officeId', 'hidden')
            ->add('address', 'text')
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