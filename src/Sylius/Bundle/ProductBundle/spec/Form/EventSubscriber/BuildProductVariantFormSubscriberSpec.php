<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\ProductBundle\Form\EventSubscriber;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\ProductBundle\Form\EventSubscriber\BuildProductVariantFormSubscriber;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Product\Model\ProductVariantInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @mixin BuildProductVariantFormSubscriber
 */
final class BuildProductVariantFormSubscriberSpec extends ObjectBehavior
{
    function let(FormFactoryInterface $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BuildProductVariantFormSubscriber::class);
    }

    function it_subscribes_to_event()
    {
        static::getSubscribedEvents()->shouldReturn(
            [FormEvents::PRE_SET_DATA => 'preSetData']
        );
    }

    function it_adds_options_on_pre_set_data_event(
        FormEvent $event,
        FormFactoryInterface $factory,
        FormInterface $form,
        FormInterface $optionsForm,
        ProductInterface $variable,
        ProductOptionInterface $options,
        ProductOptionValueInterface $optionValue,
        ProductVariantInterface $variant
    ) {
        $event->getForm()->willReturn($form);
        $event->getData()->willReturn($variant);

        $variant->getProduct()->willReturn($variable);
        $variant->getOptionValues()->willReturn([$optionValue]);
        $variable->getOptions()->willReturn([$options]);
        $variable->hasOptions()->willReturn(true);

        $factory->createNamed(
            'optionValues',
            'sylius_product_option_value_collection',
            [$optionValue],
            [
                'options' => [$options],
                'auto_initialize' => false,
            ]
        )->willReturn($optionsForm);

        $form->add($optionsForm)->shouldBeCalled();

        $this->preSetData($event);
    }
}
