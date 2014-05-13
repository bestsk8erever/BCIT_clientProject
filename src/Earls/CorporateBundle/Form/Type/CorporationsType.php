<?php

namespace Earls\CorporateBundle\Form\Type;

use Earls\CorporateBundle\Entity\Recordsoffices;
use Earls\CorporateBundle\Entity\Jurisdictions;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CorporationsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('filenumber', 'text')
            ->add('respsolicitor', 'text')
            ->add('corporatename', 'text')
            ->add('usage', 'text')
            ->add('fiscalyearend', 'text')
            ->add('registrationnumber', 'text')
            ->add('registrationdate', 'date')
            
            ->add('seal') //boolean
            
            ->add('locationseal', 'text')
            ->add('capitalstructure', 'textarea')
            ->add('namechanges', 'textarea')
            
            ->add('corpstatus') //boolean
            
            ->add('dissolutiondate', 'date')
            
 
                 ->add('corporateid', 'entity', array(
                'class' => 'EarlsCorporateBundle:Corporations',
                'property' => 'corporatename'
            ))
            
            ->add('officeid', 'entity', array(
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
            'data_class' => 'Earls\CorporateBundle\Entity\Corporations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'earls_corporatebundle_corporations';
    }
}
