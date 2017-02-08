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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array('class'=>'AppBundle:Category','choice_label'=>'name'
                ,'label'=>'选择分类', 'attr'=>array('class'=>'form-control')))
            ->add('name', TextType::class, array('label'=>'名称'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入名称')))
            ->add('urlShow', TextType::class, array('label'=>'填写网址'
                ,'attr'=>array('class'=>'form-control')))
            ->add( 'selectRules', TextType::class, array('label'=>'填写选择规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('titleRules', TextType::class, array('label'=>'填写标题规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('linkRules', TextType::class, array('label'=>'填写跳转详情规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('prefix', TextType::class, array('label'=>'链接前缀为json格式'
            ,'attr'=>array('class'=>'form-control', 'placeholder'=>'{"link":"link prefix","pdf":"pdf prefix"}'), 'required' => false))
            ->add('contentRules', TextType::class, array('label'=>'填写详情页内容规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('sourceRules', TextType::class, array('label'=>'填写详情来源规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('listPageOtherRules', TextType::class, array('label'=>'列表页其他抓取规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('detailPageRules', TextType::class, array('label'=>'详情页其他抓取规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))

            ->add('url', HiddenType::class)
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Site',
        ));
    }
}