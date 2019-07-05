<?php

namespace Omnipay\ZipPay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\ZipPay\Helper\Uuid;
use Omnipay\ZipPay\ItemBag;

/**
 * Abstract Request.
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://api.zipmoney.com.au/merchant/v1';
    /**
     * @var string
     */
    protected $testEndpoint = 'https://api.sandbox.zipmoney.com.au/merchant/v1';

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getParameter('key');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get Idempotency Key.
     *
     * @return string Idempotency Key
     */
    public function getIdempotencyKey()
    {
        return $this->getParameter('idempotencyKey') ?: Uuid::create();
    }

    /**
     * Set Idempotency Key.
     *
     * @param string $value Idempotency Key
     */
    public function setIdempotencyKey($value)
    {
        return $this->setParameter('idempotencyKey', $value);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function setSSLCertificatePath($value)
    {
        return $this->setParameter('sslCertificatePath', $value);
    }

    /**
     * @return string
     */
    public function getSSLCertificatePath()
    {
        return $this->getParameter('sslCertificatePath');
    }

    /**
     * Set the items in this order
     *
     * @param ItemBag|array $items An array of items in this order
     * @return AbstractRequest
     */
    public function setItems($items)
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new ItemBag($items);
        }

        return $this->setParameter('items', $items);
    }
    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getApiKey(),
            'Zip-Version' => '2017-03-01',
            'Idempotency-Key' => $this->getIdempotencyKey(),
        ];
    }

    /**
     * @param $data
     *
     * @return Response
     */
    public function sendData($data)
    {
        if ($this->getSSLCertificatePath()) {
            $this->httpClient->setSslVerification($this->getSSLCertificatePath());
        }

        $apiEndPoint = $this->getEndpoint();
        $body = null;

        if ($this->getHttpMethod() === 'GET') {
            $apiEndPoint = $apiEndPoint . '?' . http_build_query($data, '', '&');
        } else {
            $body = json_encode($data);
        }

        $response = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $apiEndPoint,
            $this->getHeaders(),
            $body
        )->send();

        return $this->createResponse($response->json(), $response->getHeaders(), $response->getStatusCode());
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function getBaseData()
    {
        return [];
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param $data
     * @param array $headers
     * @param $status
     *
     * @return Response
     */
    protected function createResponse($data, $headers = [], $status = 404)
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
