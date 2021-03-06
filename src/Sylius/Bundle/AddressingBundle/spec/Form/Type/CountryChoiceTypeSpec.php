<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AddressingBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Sylius\Bundle\AddressingBundle\Form\Type\CountryChoiceType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @mixin CountryChoiceType
 *
 * @author Jan Góralski <jan.goralski@lakion.com>
 */
final class CountryChoiceTypeSpec extends ObjectBehavior
{
    function let(RepositoryInterface $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CountryChoiceType::class);
    }

    function it_extends_abstract_type()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_has_parent_type()
    {
        $this->getParent()->shouldReturn('choice');
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('sylius_country_choice');
    }
}
