<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\PromotionBundle\Form\Type\Rule;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\PromotionBundle\Form\Type\Rule\ItemTotalConfigurationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @mixin ItemTotalConfigurationType
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
final class ItemTotalConfigurationTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ItemTotalConfigurationType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_builds_a_form_with_amount_field_and_equals_checkbox(FormBuilderInterface $builder)
    {
        $builder
            ->add('amount', 'sylius_money', Argument::any())
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }
}
