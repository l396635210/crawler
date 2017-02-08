<?php

namespace QABundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QAListType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site',EntityType::class,array('class'=>'QABundle:Site','choice_label'=>'name'
            , 'attr'=>array('class'=>'form-control')))
            ->add('status', CheckboxType::class, [
                'data'=> true,
            ])
            ->add('tag', EntityType::class,array('class'=>'QABundle:Tag','choice_label'=>'name',
                'attr'=>array('class'=>'form-control')))
            ->add('data', TextareaType::class,[
                'attr'=>['class'=>'form-control'],
                'required' => false,
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QABundle\Entity\QAList'
        ));
    }
}
