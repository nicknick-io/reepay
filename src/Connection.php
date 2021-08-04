<?php

namespace NickNickIO\Reepay;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use NickNickIO\Reepay\Exceptions\{ForbiddenException,
    MethodNotAllowedException,
    MissingException,
    NotFoundException,
    ReepayException};

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
        return $this->call('GET', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function delete(string $url, array $parameters = []) : array
    {
        return $this->call('DELETE', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    public function post(string $url, array $parameters = [])
    {
        return $this->call('POST', $url, $parameters);
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
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @return array
     * @throws ReepayException
     */
    private function call(string $method, string $url, array $parameters = [])
    {
        try {
            return $this->parse(
                $this->connection->request($method, $this->resolve(implode('/', [$this->uri, $url]), $parameters))
            );
        } catch (GuzzleException $exception) {
            $response = json_decode((string)$exception->getResponse()->getBody());
            $this->errors($exception, $response);
        }
    }

    /**
     * Resolve the keys defined in a url.
     * @param string $url
     * @param array $parameters
     * @return string|string[]
     */
    private function resolve(string $url, array $parameters) : string
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
            case 403:
                throw new ForbiddenException($response->error, $response->http_status);
            case 404:
                throw new NotFoundException($response->error, $response->http_status);
            case 405:
                throw new MethodNotAllowedException($response->error, $response->http_status);
            default:
                throw new MissingException('The error code fell through, we are missing an error code.', $response->http_status);
        }
    }
}
