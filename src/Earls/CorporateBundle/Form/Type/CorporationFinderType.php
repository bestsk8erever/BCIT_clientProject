<?php
namespace Earls\CorporateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CorporationFinderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('corporation', 'entity', array(
            'class' => 'EarlsCorporateBundle:Corporations',
            'property' => 'corporatename'
        ))
                ->add('Go', 'submit')
                ->getForm();
        
    }

    public function getName()
    {
        return 'corporateFinder';
    }
}

?>