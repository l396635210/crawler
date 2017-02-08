<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/10
 * Time: 16:42
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('areaName', TextType::class, array('label'=>'地区名称'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入地区名称，最多不超过25个字')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Area'
        ));
    }
}