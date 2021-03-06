<?php

namespace Sprain\SwissQrBill\DataGroups\Abstracts;

use Sprain\SwissQrBill\DataGroups\Interfaces\QrCodeData;
use Sprain\SwissQrBill\Validator\Interfaces\Validatable;
use Sprain\SwissQrBill\Validator\ValidatorTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

abstract class Address implements QrCodeData, Validatable
{
    use ValidatorTrait;

    /**
     * Name or company
     *
     * @var string
     */
    private $name;

    /**
     * Country (ISO 3166-1 alpha-2)
     *
     * @var string
     */
    private $country;

    abstract public function getFullAddress() : string;

    abstract public function getQrCodeData() : array;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country) : self
    {
        $this->country = strtoupper($country);

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('name', [
            new Assert\NotBlank(),
            new Assert\Length([
                'max' => 70
            ])
        ]);

        $metadata->addPropertyConstraints('country', [
            new Assert\NotBlank(),
            new Assert\Country()
        ]);
    }
}