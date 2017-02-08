<?php

namespace SABundle\Form;

use Doctrine\ORM\EntityRepository;
use Sonata\CoreBundle\Tests\Form\Type\Choice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrabRuleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = $options["request"];

        $builder
            ->add('grabOptions',RepeatedType::class,[
                'type' => EntityType::class,
                'first_options' => [
                    'class'=>'SABundle:GrabFields','choice_label'=>'name','label'=>false,
                    'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('sg')
                            ->orderBy("sg.name","ASC");
                    },
                    'attr'=>['class'=>'form-control grabOptions'],'required'=> false,
                    ],
                'second_options' => [
                    'class'=>'SABundle:GrabFields','choice_label'=>'name','label'=>false,
                    'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('sg')
                            ->orderBy('sg.name','ASC');
                    },
                    'attr'=>['class'=>'form-control grabOptions'],'required'=> false,
                    ],
            ])
            ->add('grabRule',RepeatedType::class,[
                'first_options'=>[
                    'label'=>false,'attr'=>['class'=>'form-control grabRule'],
                    'required'=> false,
                ],
                'second_options'=>[
                    'label'=>false,'attr'=>['class'=>'form-control grabRule'],
                    'required'=> false,
                ],
            ])
            ->add('urls', TextareaType::class, ['attr'=>['class'=>'form-control grabRule-urls']])
            ->add('data', TextareaType::class, ['attr'=>['class'=>'form-control grabRule-data']])
            ->add('prefix', TextareaType::class, [
                'attr'=>['class'=>'form-control grabRule-prefix'],
                'required'=> false,
            ])
            ->add('entity', TextType::class, [
                'attr' => ['class'=>'form-control'],
                'data' => $request->get('entity'),
            ])
            ->add('entityId', TextType::class, [
                'attr' => ['class'=>'form-control'],
                'data' => $request->get('entityId'),
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SABundle\Entity\GrabRule',
            'request'    => 'Symfony\Component\HttpFoundation\Request',
        ));
    }
}
