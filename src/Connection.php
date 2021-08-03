<?php

namespace NickNickIO\Reepay;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NickNickIO\Reepay\Exceptions\NotFoundException;
use Psr\Http\Message\ResponseInterface;

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
            'auth' => [
                $token, ''
            ]
        ]);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws GuzzleException
     */
    public function get(string $url, array $parameters = []) : array
    {
        try {
            return $this->parse(
                $this->connection->get($this->resolve(implode('/', [$this->uri, $url]), $parameters))
            );
        } catch (GuzzleException $exception) {
            $response = json_decode((string)$exception->getResponse()->getBody());
            $this->errors($exception, $response);
        }
    }

    /**
     * @param string $url
     * @param array $parameters
     * @throws GuzzleException
     */
    public function post(string $url, array $parameters = [])
    {
        return $this->parse(
            $this->connection->post(
                $this->resolve(implode('/', [$this->uri, $url]), $parameters)
            )
        );
    }

    public function uri(string $url, array $parameters = [])
    {
        return $this->resolve(implode('/', [$this->uri, $url]), $parameters);
    }

    /**
     * @param string $url
     * @param array $data
     * @return array
     */
    public function put(string $url, array $data = []) : array
    {
        return [];
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function parse(ResponseInterface $response) : array
    {
        return (array)json_decode($response->getBody()->getContents());
    }

    /**
     * Resolve the keys defined in a url.
     * @param string $url
     * @param array $parameters
     * @return string|string[]
     */
    public function resolve(string $url, array $parameters) : string
    {
        $collector = '';
        foreach ($parameters as $parameter => $options) {
            $current_parameter = '';

            // Takes a string and builds it onto the collector.
            if (is_string($options) || is_bool($options)) {
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
     * @throws NotFoundException
     */
    private function errors($exception, $response)
    {
        switch ($exception->getCode()) {
            case 404:
                throw new NotFoundException($response->error, $response->http_status);
        }
    }
}
