<?php

namespace Climberdav\HPLayerBundle\Form;

use Doctrine\ORM\EntityRepository;
use SebastianBergmann\GlobalState\Restorer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Climberdav\HPLayerBundle\Entity\Server;
use Symfony\Component\Validator\Constraints\Ip;

/**
 * Class ServerType
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Form
 */
class ServerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'server.name',
                'required' => true
            ])
            ->add('ip', TextType::class, [
                'validation_groups' => Ip::class,
                'label' => 'server.ip',
                'required' => true
            ])
            ->add('port', IntegerType::class, [
                'label' => 'server.port',
                'required' => true
            ])
            ->add('root', TextType::class, [
                'label' => 'server.root'
            ])
            ->add('login', TextType::class, [
                'label' => 'server.username'
            ])
            ->add('protocol', ChoiceType::class, [
                'label' => 'server.protocol',
                'choices' => [
                    "http" => "http",
                    "https" => "https"
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'server.password'
            ])
            ->add('disabled', CheckboxType::class, [
                'label' => 'server.disabled',
                'required' => false
            ])
            ->add('firstDayOfServer', DateType::class, [
//                'widget' => 'single_text',
            ])
            ->add('save',SubmitType::class, [
                'label' => 'server.save',
            ])
            ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event)
            {
                $server = $event->getData();
                $form = $event->getForm();
                if (!$server || null === $server->getId())
                {
                    $form->add('previousServer', EntityType::class, [
                        'class' => 'ClimberdavHPLayerBundle:Server',
                        'query_builder' => function (EntityRepository $er)
                        {
                            return $er->createQueryBuilder('s')
                                ->where('s.disabled = 0')
                                ->orderBy('s.firstDayOfServer', 'ASC');
                        },
                        'choice_label' => 'name',
                        'required' => false,
                        'label' => 'server.previous',
                        'placeholder' => 'server.previous.choice'
                    ]);
                }
                else
                {
                    $form->add('previousServer', EntityType::class, [
                        'class' => 'ClimberdavHPLayerBundle:Server',
                        'query_builder' => function (EntityRepository $er) use ($server)
                        {
                            return $er->createQueryBuilder('s')
                                ->where('s.disabled = 0')
                                ->andWhere('s.id != :server')
                                    ->setParameter('server', $server->getId())
                                ->orderBy('s.firstDayOfServer', 'ASC');
                        },
                        'choice_label' => 'name',
                        'required' => false,
                        'label' => 'server.previous',
                        'placeholder' => 'server.previous.choice'
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Server::class,
                'translation_domain' => 'ClimberdavHPLayer',
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'climberdav_hplayer_bundle_server_form';
    }
}
