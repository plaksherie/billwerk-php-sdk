<?php

namespace Billwerk\Sdk\Model\Checkout\Session;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasRequestApiInterface;

class AddressModel extends AbstractModel implements HasRequestApiInterface
{
    /**
     * Address line 1
     *
     * @var string|null $address1
     */
    protected ?string $address1 = null;

    /**
     * Address line 2
     *
     * @var string|null $address2
     */
    protected ?string $address2 = null;

    /**
     * Address line 3
     *
     * @var string|null $address3
     */
    protected ?string $address3 = null;

    /**
     * City
     *
     * @var string|null $city
     */
    protected ?string $city = null;

    /**
     * Country in ISO 3166-1 alpha-2
     *
     * @var string|null $country
     */
    protected ?string $country = null;

    /**
     * Postal code
     *
     * @var string|null $postalCode
     */
    protected ?string $postalCode = null;

    /**
     * State or province. Should be in country subdivision code defined in ISO 3166-2
     *
     * @var string|null $stateOrProvince
     */
    protected ?string $stateOrProvince = null;

    /**
     * Address line 1
     *
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * Address line 2
     *
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * Postal code
     *
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * City
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Country in ISO 3166-1 alpha-2
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * State or province. Should be in country subdivision code defined in ISO 3166-2
     *
     * @return string|null
     */
    public function getStateOrProvince(): ?string
    {
        return $this->stateOrProvince;
    }

    /**
     * Address line 3
     *
     * @return string|null
     */
    public function getAddress3(): ?string
    {
        return $this->address3;
    }

    /**
     * Address line 1
     *
     * @param string|null $address1
     *
     * @return self
     */
    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Address line 2
     *
     * @param string|null $address2
     *
     * @return self
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Postal code
     *
     * @param string|null $postalCode
     *
     * @return self
     */
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * City
     *
     * @param string|null $city
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Country in ISO 3166-1 alpha-2
     *
     * @param string|null $country
     *
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Address line 3
     *
     * @param string|null $address3
     *
     * @return self
     */
    public function setAddress3(?string $address3): self
    {
        $this->address3 = $address3;

        return $this;
    }

    /**
     * State or province. Should be in country subdivision code defined in ISO 3166-2
     *
     * @param string|null $stateOrProvince
     *
     * @return self
     */
    public function setStateOrProvince(?string $stateOrProvince): self
    {
        $this->stateOrProvince = $stateOrProvince;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromArray(array $response): self
    {
        $model = new self();

        if (isset($response['address1'])) {
            $model->setAddress1($response['address1']);
        }

        if (isset($response['address2'])) {
            $model->setAddress2($response['address2']);
        }

        if (isset($response['address3'])) {
            $model->setAddress3($response['address3']);
        }

        if (isset($response['city'])) {
            $model->setCity($response['city']);
        }

        if (isset($response['country'])) {
            $model->setCountry($response['country']);
        }

        if (isset($response['postal_code'])) {
            $model->setPostalCode($response['postal_code']);
        }

        if (isset($response['state_or_province'])) {
            $model->setStateOrProvince($response['state_or_province']);
        }

        return $model;
    }

    public function toArray(): array
    {
        return array_filter([
            'address1' => $this->getAddress1(),
            'address2' => $this->getAddress2(),
            'address3' => $this->getAddress3(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'postal_code' => $this->getPostalCode(),
            'state_or_province' => $this->getStateOrProvince(),
        ], function ($value) {
            return $value !== null;
        });
    }

    public function toApi(): array
    {
        return $this->toArray();
    }
}
