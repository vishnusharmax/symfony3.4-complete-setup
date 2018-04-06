<?php

namespace DBBundle\Form;

use DBBundle\Entity\Userrole;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserroleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array('label'=>'Name','attr'=>array('class'=>"form-control",'placeholder'=>'Name...')))
            ->add('description',TextType::class,array('label'=>'Description','attr'=>array('class'=>"form-control",'placeholder'=>'Description...')))
            ->add('status', ChoiceType::class, array(
                'label' => 'Select Status',
                'label_attr' => array('style' =>'padding-left:0px'),
                'choices' => array(1 => 'Active', 0 => 'Inactive'),
                'attr' => array('class'=>"form-control")

            ))
            ->add('submit', SubmitType::class,array('attr'=>array('class'=>"btn btn-primary",'style' =>'margin-top: 13px;width: 100%;')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Userrole::class,
        ));
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'dbbundle_userrole';
    }
}
