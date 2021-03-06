<?php

namespace Sprain\SwissQrBill\DataGroups;

use Sprain\SwissQrBill\DataGroups\Interfaces\QrCodeData;
use Sprain\SwissQrBill\Validator\ValidatorTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class AlternativeScheme implements QrCodeData
{
    use ValidatorTrait;

    /**
     * Parameter character chain of the alternative scheme
     * 
     * @var string
     */
    private $parameter;

    public function getParameter(): ?string
    {
        return $this->parameter;
    }

    public function setParameter(string $parameter) : self
    {
        $this->parameter = $parameter;

        return $this;
    }

    public function getQrCodeData() : array
    {
        return [
            $this->getParameter()
        ];
    }

    /**
     * Note that no real-life alternative schemes yet exist. Therefore validation is kept simple yet.
     * @link https://www.paymentstandards.ch/en/home/softwarepartner/qr-bill/alternative-schemes.html
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('parameter', [
            new Assert\NotBlank(),
            new Assert\Length([
                'max' => 100
            ])
        ]);
    }
}