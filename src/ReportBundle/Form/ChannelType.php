<?php

namespace ReportBundle\Form;

use ReportBundle\Entity\Category;
use ReportBundle\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('site', EntityType::class, [
                'class' => Site::class,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class ,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('url', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReportBundle\Entity\Channel'
        ));
    }
}
