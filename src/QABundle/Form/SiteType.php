<?php

namespace QABundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'名称', "attr"=>["class"=>"form-control"]])
            ->add('status', CheckboxType::class, ['label'=>'是否有效'])
            ->add('host', TextType::class, ['label'=>'主机地址', "attr"=>["class"=>"form-control"]])
            ->add('data', TextareaType::class, ['label'=>'其他信息', "attr"=>[
                    "class"=>"form-control",
                ],
                'required' => false ,
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QABundle\Entity\Site'
        ));
    }
}
