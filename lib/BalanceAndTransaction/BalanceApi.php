<?php
/**
 * BalanceApi
 * PHP version 7.4
 *
 * @category Class
 * @package  Xendit
 */

/**
 * Transaction Service V4 API
 *
 * The version of the OpenAPI document: 3.4.2
 */

/**
 * NOTE: This class is auto generated
 * Do not edit the class manually.
 */

namespace Xendit\BalanceAndTransaction;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Xendit\Model;
use Xendit\ApiException;
use Xendit\Configuration;
use Xendit\HeaderSelector;
use Xendit\ObjectSerializer;

/**
 * BalanceApi Class Doc Comment
 *
 * @category Class
 * @package  Xendit
 */
class BalanceApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'getBalance' => [
            'application/json',
        ],
    ];

/**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    public function setApiKey($apiKey)
    {
        $this->config->setApiKey($apiKey);
        return $this;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getBalance
     *
     * Retrieves balances for a business, default to CASH type
     *
     * @param  string $account_type The selected balance type (optional, default to 'CASH')
     * @param  string $currency Currency for filter for customers with multi currency accounts (optional)
     * @param  string $for_user_id The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBalance'] to see the possible values for this operation
     *
     * @throws \Xendit\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return Xendit\BalanceAndTransaction\Balance|Xendit\BalanceAndTransaction\ValidationError|Xendit\BalanceAndTransaction\ServerError
     */
    public function getBalance($account_type = 'CASH', $currency = null, $for_user_id = null, string $contentType = self::contentTypes['getBalance'][0])
    {
        list($response) = $this->getBalanceWithHttpInfo($account_type, $currency, $for_user_id, $contentType);
        return $response;
    }

    /**
     * Operation getBalanceWithHttpInfo
     *
     * Retrieves balances for a business, default to CASH type
     *
     * @param  string $account_type The selected balance type (optional, default to 'CASH')
     * @param  string $currency Currency for filter for customers with multi currency accounts (optional)
     * @param  string $for_user_id The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBalance'] to see the possible values for this operation
     *
     * @throws \Xendit\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of Xendit\BalanceAndTransaction\Balance|Xendit\BalanceAndTransaction\ValidationError|Xendit\BalanceAndTransaction\ServerError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBalanceWithHttpInfo($account_type = 'CASH', $currency = null, $for_user_id = null, string $contentType = self::contentTypes['getBalance'][0])
    {
        $request = $this->getBalanceRequest($account_type, $currency, $for_user_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('Xendit\BalanceAndTransaction\Balance' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('Xendit\BalanceAndTransaction\Balance' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'Xendit\BalanceAndTransaction\Balance', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('Xendit\BalanceAndTransaction\ValidationError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('Xendit\BalanceAndTransaction\ValidationError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'Xendit\BalanceAndTransaction\ValidationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('Xendit\BalanceAndTransaction\ServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('Xendit\BalanceAndTransaction\ServerError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'Xendit\BalanceAndTransaction\ServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\BalanceAndTransaction\Balance';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'Xendit\BalanceAndTransaction\Balance',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'Xendit\BalanceAndTransaction\ValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'Xendit\BalanceAndTransaction\ServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getBalanceAsync
     *
     * Retrieves balances for a business, default to CASH type
     *
     * @param  Xenditstring $account_type The selected balance type (optional, default to 'CASH')
     * @param  Xenditstring $currency Currency for filter for customers with multi currency accounts (optional)
     * @param  Xenditstring $for_user_id The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBalance'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBalanceAsync($account_type = 'CASH', $currency = null, $for_user_id = null, string $contentType = self::contentTypes['getBalance'][0])
    {
        return $this->getBalanceAsyncWithHttpInfo($account_type, $currency, $for_user_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBalanceAsyncWithHttpInfo
     *
     * Retrieves balances for a business, default to CASH type
     *
     * @param  Xenditstring $account_type The selected balance type (optional, default to 'CASH')
     * @param  Xenditstring $currency Currency for filter for customers with multi currency accounts (optional)
     * @param  Xenditstring $for_user_id The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBalance'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBalanceAsyncWithHttpInfo($account_type = 'CASH', $currency = null, $for_user_id = null, string $contentType = self::contentTypes['getBalance'][0])
    {
        $returnType = '\BalanceAndTransaction\Balance';
        $request = $this->getBalanceRequest($account_type, $currency, $for_user_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getBalance'
     *
     * @param  string $account_type The selected balance type (optional, default to 'CASH')
     * @param  string $currency Currency for filter for customers with multi currency accounts (optional)
     * @param  string $for_user_id The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBalance'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getBalanceRequest($account_type = 'CASH', $currency = null, $for_user_id = null, string $contentType = self::contentTypes['getBalance'][0])
    {





        $resourcePath = '/balance';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $account_type,
            'account_type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $currency,
            'currency', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header param: for-user-id
        if ($for_user_id !== null) {
            $headerParams['for-user-id'] = ObjectSerializer::toHeaderValue($for_user_id);
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getApiKey() . ":");

        $defaultHeaders = [];
        
        // Xendit's custom headers
        $defaultHeaders['xendit-lib'] = 'php';
        $defaultHeaders['xendit-lib-ver'] = '3.0.0-beta.2';

        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
