<?php

namespace App\Form;

use App\Entity\Editor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('SocietyName', TextType::class,
                [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un nom valide',
                        ]),
                        new Length([
                            'min' => 2,
                            'minMessage' => 'Le nom d\'éditeur doit faire 2 caractères au minimum',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ])
            ->add('Nationality', TextType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Editor::class,
        ]);
    }
}
