<?php

namespace Paguesafe\Fitbank\Models;

class DischargeCardRequest
{

    /**
     * @var string
     */
    public $taxNumber;

    /**
     * @var string
     */
    public $prepaidCardId;

    /**
     * @var float
     */
    public $dischargeValue;

    /**
     * @var string
     */
    public $identifier;

    /**
     * @var string
     */
    public $description;

    /**
     * Model constructor.
     * 
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (isset($data['taxNumber'])) {
            $this->taxNumber($data['taxNumber']);
        }
        if (isset($data['prepaidCardId'])) {
            $this->prepaidCardId($data['prepaidCardId']);
        }
        if (isset($data['dischargeValue'])) {
            $this->dischargeValue($data['dischargeValue']);
        }
        if (isset($data['identifier'])) {
            $this->identifier($data['identifier']);
        }
        if (isset($data['description'])) {
            $this->description($data['description']);
        }
    }

    /**
     * @param string $taxNumber
     */
    public function taxNumber(string $taxNumber)
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    /**
     * @param string $prepaidCardId
     */
    public function prepaidCardId(string $prepaidCardId)
    {
        $this->prepaidCardId = $prepaidCardId;
        return $this;
    }

    /**
     * @param float $dischargeValue
     */
    public function dischargeValue(float $dischargeValue)
    {
        $this->dischargeValue = $dischargeValue;
        return $this;
    }

    /**
     * @param string $identifier
     */
    public function identifier(string $identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @param string $description
     */
    public function description(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'TaxNumber'      => $this->taxNumber,
            'PrepaidCardId'  => $this->prepaidCardId,
            'DischargeValue' => $this->dischargeValue,
            'Identifier'     => $this->identifier,
            'Description'    => $this->description,
        ], function ($value) {
            return !is_null($value);
        });
    }
}
