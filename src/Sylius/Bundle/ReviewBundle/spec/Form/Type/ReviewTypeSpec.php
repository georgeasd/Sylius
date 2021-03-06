<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ReviewBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ReviewBundle\Form\Type\ReviewType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @mixin ReviewType
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 * @author Grzegorz Sadowski <grzegorz.sadowski@lakion.com>
 */
final class ReviewTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('dataClass', ['validation_group'], 'subject');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ReviewType::class);
    }

    function it_is_abstract_type_object()
    {
        $this->shouldHaveType(AbstractResourceType::class);
    }

    function it_builds_form(FormBuilderInterface $builder)
    {
        $builder
            ->add('rating', 'choice', Argument::cetera())
            ->willReturn($builder)
            ->shouldBeCalled()
        ;

        $builder
            ->add('title', 'text', Argument::cetera())
            ->willReturn($builder)
            ->shouldBeCalled()
        ;

        $builder
            ->add('comment', 'textarea', Argument::cetera())
            ->willReturn($builder)
            ->shouldBeCalled()
        ;

        $this->buildForm($builder, ['rating_steps' => 5]);
    }

    function it_configures_options(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'dataClass',
                'validation_groups' => ['validation_group'],
            ]
        )->shouldBeCalled();

        $resolver->setDefaults(
            [
                'rating_steps' => 5,
                'cascade_validation' => true,
            ]
        )->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('sylius_subject_review');
    }
}
