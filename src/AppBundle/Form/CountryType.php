<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/10
 * Time: 16:42
 */

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Area;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array('class'=>'AppBundle:Area','choice_label'=>'areaName'
            ,'label'=>'选择地区'
            , 'attr'=>array('class'=>'form-control')))
            ->add('countryName', TextType::class, array('label'=>'国家名称'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入国家名称，最多不超过25个字')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Country'
        ));
    }
}