<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\OrderBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\OrderBundle\Form\Type\OrderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @mixin OrderType
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
final class OrderTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Order', ['sylius']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OrderType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_builds_a_form_with_items_collection_field(FormBuilderInterface $builder)
    {
        $builder
            ->add('items', 'collection', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('notes', 'text', [
                'label' => 'sylius.ui.notes',
            ])
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_defines_an_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Order',
                'validation_groups' => ['sylius'],
            ])
            ->shouldBeCalled()
        ;

        $this->configureOptions($resolver);
    }

    function it_has_a_valid_name()
    {
        $this->getName()->shouldReturn('sylius_order');
    }
}
