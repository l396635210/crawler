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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array('class'=>'AppBundle:Area','choice_label'=>'areaName'
                ,'label'=>'选择地区', 'auto_initialize'=>false , 'attr'=>array('class'=>'form-control')))
            ->add('country', EntityType::class, array('class'=>'AppBundle:Country','choice_label'=>'countryName'
                ,'label'=>'选择国家' , 'attr'=>array('class'=>'form-control')))
            ->add('companyName', TextType::class, array('label'=>'公司名称'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入公司名称，最多不超过25个字')))
            ->add('status', ChoiceType::class, array('attr'=>array('class'=>'form-control'), 'choices'  => array(
                0 => '待定', 1=>'自动', 2=>'手动' ),'label'=>'抓取状态'))
                #'待定' => '0', '自动'=>'1', '手动'=>2 ),'label'=>'抓取状态'))
            ->add('siteUrl', TextType::class, array('label'=>'填写网址'
                ,'attr'=>array('class'=>'form-control')))
            ->add('detailPageIsPDF', ChoiceType::class, array('attr'=>array('class'=>'form-control'), 'choices'  => array(
                0 => '否', 1=>'是' ),'label'=>'详情是否为PDF文件'))
            ->add('remarks', TextareaType::class, array('label'=>'备注'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('withAgent', CheckboxType::class, [
                'label'=>'是否有代理商',
                'required' => false,
            ])
            ->add( 'selectRules', TextType::class, array('label'=>'填写选择规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('titleRules', TextType::class, array('label'=>'填写标题规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('linkRules', TextType::class, array('label'=>'填写跳转详情规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('contentRules', TextType::class, array('label'=>'填写详情页内容规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('listPageOtherRules', TextType::class, array('label'=>'列表页其他抓取规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('detailPageRules', TextType::class, array('label'=>'详情页其他抓取规则'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('cookie', TextType::class, array('label'=>'cookie为json格式'
                ,'attr'=>array('class'=>'form-control'), 'required' => false))
            ->add('prefix', TextType::class, array('label'=>'链接前缀为json格式'
                ,'attr'=>array('class'=>'form-control', 'placeholder'=>'{"link":"link prefix","pdf":"pdf prefix"}'), 'required' => false))
            ->add('isDesc', ChoiceType::class, array('choices'=>array(0=>'asc', 1=>'desc'),'label'=>'排序顺序',
                'expanded' => true,'multiple' => false,))
            ->add('isPush', ChoiceType::class, array('choices'=>array(0=>'否', 1=>'是'),'label'=>'是否推送',
                'expanded' => true,'multiple' => false,))
            ->add('CompanySite', HiddenType::class, array('attr'=>array('class'=>'form-control')))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }
}