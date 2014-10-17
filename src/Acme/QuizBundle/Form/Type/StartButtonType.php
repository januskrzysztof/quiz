<?php

namespace Acme\QuizBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class StartButtonType
 * @package Acme\QuizBundle\Form\Type
 */
class StartButtonType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'start',
            'submit',
            [
                'label' => '-',
                'attr'  => [
                    'class' => 'start-btn'
                ],
            ]
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'start_button_type';
    }
}