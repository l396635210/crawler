<?php

namespace ZhanhuiBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChannelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => true ,
                'attr' => ['class'=>'form-control'],
            ])
            ->add('url', TextType::class,[
                'attr' => ['class'=>'form-control'],
            ])
            ->add('area', EntityType::class, [
                'class' => 'ZhanhuiBundle:Area',
            ])
            ->add('status', CheckboxType::class, [
                'data' => true
            ])
            ->add('data', TextareaType::class,[
                'required' => false,
                'attr' => ['class'=>'form-control'],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZhanhuiBundle\Entity\Channel'
        ));
    }
}
