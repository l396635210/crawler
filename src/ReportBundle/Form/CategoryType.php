<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/10
 * Time: 16:42
 */

namespace ReportBundle\Form;

use ReportBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'required' => false,
                'placeholder' => '选择上级栏目',
                'attr' => ['class'=>'form-control']
            ])
            ->add('name', TextType::class, array('label'=>'分类名称'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入分类名称')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReportBundle\Entity\Category'
        ));
    }
}