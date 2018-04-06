<?php

namespace DBBundle\Form;

use DBBundle\Entity\AdminUser;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AdminUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
              $builder
                  ->add('name', TextType::class,array('label'=>'Name','attr'=>array('class'=>"form-control",'placeholder'=>'Name...')))
                  ->add('email',EmailType::class,array('label'=>'Email','attr'=>array('class'=>"form-control",'placeholder'=>'Email...')))
                  ->add('mobile',TextType::class,array('label'=>'Mobile','attr'=>array('class'=>"form-control",'placeholder'=>'Mobile...')))
                  ->add('status', ChoiceType::class, array(
                      'label' => 'Select Status',
                      'label_attr' => array('style' =>'padding-left:0px'),
                      'choices' => array('Active' => 1,'Inactive' =>0  ),
                      'attr' => array('class'=>"form-control")

                  ))
                  ->add('userrole', EntityType::class, array(
                      'class' =>'DBBundle\Entity\Userrole',
                      'choice_label' => 'name',
                      'query_builder'=>function(EntityRepository $e){
                          return $e->createQueryBuilder('u')->where('u.status=1');
                      },
                      'label' => 'Select Role',
                      'label_attr' => array('style' =>'padding-left:0px'),
                      'attr' => array('class'=>"form-control")
                  ))
                  ->add('imageFile', VichImageType::class, array(
                      'required'      => false,
                      'allow_delete'  => true, // not mandatory, default is true
                      'download_link' => true, // not mandatory, default is true
                  ))
                  ->add('submit', SubmitType::class,array('attr'=>array('class'=>"btn btn-primary",'style' =>'margin-top: 13px;width: 100%;')))

              ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AdminUser::class,
        ));
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'dbbundle_adminuser';
    }
}
