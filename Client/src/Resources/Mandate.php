<?php

// Mollie Shopware Plugin Version: 1.4.3

namespace Mollie\Api\Resources;

use Mollie\Api\MollieApiClient;
use Mollie\Api\Types\MandateStatus;
class Mandate extends \Mollie\Api\Resources\BaseResource
{
    /**
     * @var string
     */
    public $resource;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $mode;
    /**
     * @var string
     */
    public $method;
    /**
     * @var object|null
     */
    public $details;
    /**
     * @var string
     */
    public $customerId;
    /**
     * @var string
     */
    public $createdAt;
    /**
     * @var string
     */
    public $mandateReference;
    /**
     * Date of signature, for example: 2018-05-07
     *
     * @var string
     */
    public $signatureDate;
    /**
     * @var object
     */
    public $_links;
    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->status === \Mollie\Api\Types\MandateStatus::STATUS_VALID;
    }
    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->status === \Mollie\Api\Types\MandateStatus::STATUS_PENDING;
    }
    /**
     * @return bool
     */
    public function isInvalid()
    {
        return $this->status === \Mollie\Api\Types\MandateStatus::STATUS_INVALID;
    }
    /**
     * Revoke the mandate
     *
     * @return null
     */
    public function revoke()
    {
        if (!isset($this->_links->self->href)) {
            return $this;
        }
        $body = null;
        if ($this->client->usesOAuth()) {
            $body = \json_encode(["testmode" => $this->mode === "test" ? \true : \false]);
        }
        $result = $this->client->performHttpCallToFullUrl(\Mollie\Api\MollieApiClient::HTTP_DELETE, $this->_links->self->href, $body);
        return $result;
    }
}
