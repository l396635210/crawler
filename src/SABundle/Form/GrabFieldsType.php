<?php

namespace SABundle\Form;

use SABundle\Entity\GrabFields;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrabFieldsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,["label"=>"名称","attr"=>["class"=>"form-control"]])
            ->add('tagType',ChoiceType::class,["choices"=>GrabFields::getTagTypes()])
            ->add('status',CheckboxType::class,["label"=>"是否有效","data"=>true])
            ->add('data',TextareaType::class,[
                "label"=>"其他数据",
                "attr"=>["class"=>"form-control"],
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
            'data_class' => 'SABundle\Entity\GrabFields'
        ));
    }
}
