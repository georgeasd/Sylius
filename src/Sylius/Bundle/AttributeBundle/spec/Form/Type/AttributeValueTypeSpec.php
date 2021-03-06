<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AttributeBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @mixin AttributeValueType
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
final class AttributeValueTypeSpec extends ObjectBehavior
{
    function let(EntityRepository $attributeRepository)
    {
        $this->beConstructedWith('ProductAttributeValue', ['sylius'], 'server', $attributeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AttributeValueType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_builds_attribute_types_prototype_and_passes_it_as_argument(FormBuilder $builder)
    {
        $builder->add('attribute', 'sylius_server_attribute_choice', Argument::any())->willReturn($builder);

        $builder
            ->addEventSubscriber(Argument::any())
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_defines_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'ProductAttributeValue', 'validation_groups' => ['sylius']])->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    function it_has_valid_name()
    {
        $this->getName()->shouldReturn('sylius_server_attribute_value');
    }
}
