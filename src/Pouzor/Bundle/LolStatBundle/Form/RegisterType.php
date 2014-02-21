<?php

namespace Pouzor\Bundle\LolStatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', "text", array(
                "attr" => array(
                "class" => "form-control"
                )))
            ->add('name', "text", array(
                "attr" => array(
                "class" => "form-control"
                )))
            ->add('server', "choice", array(
              "choices" => array(
                "EUW" => "EUW", 
                "NA" => "NA", 
                "EUNE" => "EUNE",
                "TR" => "TR",
                "RU" => "RU",
                "OCE" =>"OCE",
                "LAS" => "LAS",
                "LAN" => "LAN",
                "BR" => "BR"),
              "attr" => array(
                "class" => "form-control"
                )
                ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pouzor\Bundle\LolStatBundle\Entity\Register'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pouzor_bundle_lolstatbundle_register';
    }
}
