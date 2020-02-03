<?php

namespace App\Form;

use App\Entity\VideoGame;
use App\Entity\Editor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $editor = new Editor();
        $builder
            ->add('title', TextType::class)
            ->add('support', ChoiceType::class, [
                'choices'  => [
                    'PC' => 'PC',
                    'XBOX' => 'XBOX',
                    'PS4' => 'PS4',
                    'GameBoy' => 'Gameboy',
                    'Dreamcast' => 'Dreamcast',
                ],
            ])
            ->add('Description', TextType::class)
            ->add('CreationDate', DateType::class)
            ->add('Editor', EntityType::class, [
                'class' => Editor::class,
                'choice_label' => function(Editor $editor) {
                    return $editor->getSocietyName();
                },
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
