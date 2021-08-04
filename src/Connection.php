<?php

namespace NickNickIO\Reepay;

use GuzzleHttp\{Client, Exception\GuzzleException};
use NickNickIO\Reepay\Exceptions\{
    BadRequestException,
    ForbiddenException,
    InternalServerErrorException,
    MethodNotAllowedException,
    MissingException,
    NotFoundException,
    ReepayException,
    RequestLimitingExceededException,
    UnauthorizedException,
    UnprocessableEntityException
};

class Connection
{
    private string $uri;
    private Client $connection;

    /**
     * Connection constructor.
     * @param string $token
     * @param string $uri
     */
    public function __construct(string $token, string $uri = 'https://api.reepay.com/v1')
    {
        $this->uri = $uri;
        $this->connection = new Client([
            'debug' => false,
            'auth' => [$token, '']
        ]);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function get(string $url, array $parameters = []) : array
    {
        return $this->request('GET', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function delete(string $url, array $parameters = []) : array
    {
        return $this->request('DELETE', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function post(string $url, array $parameters = []) : array
    {
        return $this->request('POST', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function put(string $url, array $parameters = []) : array
    {
        return $this->request('PUT', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return string
     */
    public function uri(string $url, array $parameters = [])
    {
        return $this->resolve(implode('/', [$this->uri, $url]), $parameters);
    }

    /**
     * @param $response
     * @return array
     */
    private function parse($response) : array
    {
        return (array)json_decode($response->getBody()->getContents());
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    private function request(string $method, string $url, array $parameters = [])
    {
        try {
            return $this->parse(
                $this->connection->request($method, $this->resolve(implode('/', [$this->uri, $url]), $parameters))
            );
        } catch (GuzzleException $exception) {
            $this->errors($exception, json_decode((string)$exception->getResponse()->getBody()));
        }
    }

    /**
     * Resolve the keys defined in a url.
     * @param string $url
     * @param array $parameters
     * @return string|string[]
     */
    public function resolve(string $url, array $parameters) //: string
    {
        $collector = '';
        foreach ($parameters as $parameter => $options) {
            $current_parameter = '';

            // Takes a string and builds it onto the collector.
            if (is_string($options) || is_bool($options) || is_int($options)) {
                $current_parameter = implode('=', [$parameter, $options]);
            }

            // Takes an array and builds parameters like: customer=customer.handle:cust-007
            if (is_array($options)) {
                $mapped_items = array_map(function($first, $second) {
                    return $first . ':' . $second;
                }, array_keys($options), array_values($options));
                $current_parameter = implode('=', [$parameter, implode(',', $mapped_items)]);
            }

            $collector = (!empty($collector)) ? implode('&', [$collector, $current_parameter]) : $current_parameter;
        }

        return $url . '?' . $collector;
    }

    /**
     * @param $exception
     * @param $response
     * @throws ReepayException
     */
    private function errors($exception, $response)
    {
        $errors = [
            400 => new BadRequestException($response->error, $response->http_status),
            401 => new UnauthorizedException($response->error, $response->http_status),
            403 => new ForbiddenException($response->error, $response->http_status),
            404 => new NotFoundException($response->error, $response->http_status),
            405 => new MethodNotAllowedException($response->error, $response->http_status),
            422 => new UnprocessableEntityException($response->error, $response->http_status),
            429 => new RequestLimitingExceededException($response->error, $response->http_status),
            500 => new InternalServerErrorException($response->error, $response->http_status),
            501 => new InternalServerErrorException($response->error, $response->http_status),
            502 => new InternalServerErrorException($response->error, $response->http_status),
            503 => new InternalServerErrorException($response->error, $response->http_status),
            504 => new InternalServerErrorException($response->error, $response->http_status),
        ];

        if (in_array($exception->getCode(), array_keys($errors))) {
            throw $errors[$exception->getCode()];
        }

        throw new MissingException('We have found an error that is not yet in our collection - Error code: ' . $response->http_status, $response->http_status);
    }
}
