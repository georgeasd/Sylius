<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AttributeBundle\Form\Type\AttributeType;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\AttributeBundle\Form\Type\AttributeType\DatetimeAttributeType;
use Symfony\Component\Form\AbstractType;

/**
 * @mixin DatetimeAttributeType
 *
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
final class DatetimeAttributeTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DatetimeAttributeType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_has_parent()
    {
        $this->getParent()->shouldReturn('datetime');
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('sylius_attribute_type_datetime');
    }
}
