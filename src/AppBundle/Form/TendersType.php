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

class TendersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', EntityType::class, array('class'=>'AppBundle:Company','choice_label'=>'companyName'
            , 'label'=>'渠道'
            , 'attr'=>array('class'=>'form-control')
            , 'group_by' => function($val, $key, $index) {
                    return $val->getArea()->getAreaName();
                }))
            ->add('title', TextType::class, array('label'=>'标题'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'最多不超过50个字')))
            ->add('url', TextType::class, array('label'=>'网址'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'http://开头,建议直接复制网址')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tenders'
        ));
    }
}