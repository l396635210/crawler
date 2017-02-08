<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/5/10
 * Time: 16:42
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('empName', TextType::class, array('label'=>'姓名'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入姓名')))
            ->add('empMail', TextType::class, array('label'=>'邮箱'
                , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入邮箱:example@example.com')))
            ->add('isSendTenders', ChoiceType::class, array('attr'=>array('class'=>'form-control'), 'choices'  => array(
                0 => '不发送', 1=>'发送' ),'label'=>'是否发送招标邮件'))
            ->add('isSendInformation', ChoiceType::class, array('attr'=>array('class'=>'form-control'), 'choices'  => array(
                0 => '不发送', 1=>'发送' ),'label'=>'是否发送资讯邮件'))
            ->add('enterprise', TextType::class, array('label'=>'所属企业'
            , 'attr'=>array('class'=>'form-control', 'placeholder'=>'请输入企业名称')))
            ->add('remarks', TextareaType::class, array('label'=>'备注'
            , 'attr'=>array('class'=>'form-control')))
            ->add('company', HiddenType::class )
            ->add('sites', HiddenType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Emp'
        ));
    }
}