<?php

declare(strict_types=1);

namespace App\Http;

/**
 * class Request
 * @package App\Http
 */
class Request
{
    /**
     * @var string
     */
    private string $method;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $clientIp;

    /**
     * @var string
     */
    private string $agent;

    /**
     * @var bool
     */
    private bool $isAjax;

    /**
     * @var array
     */
    private array $params;

    /**
     * @var array
     */
    private array $headers;

    /**
     * @var array
     */
    private array $body;

    /**
     * @var string
     */
    private string $user;

    /**
     * @var string
     */
    private string $password;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->params = [];
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->url = $_SERVER['REQUEST_URI'];
        $this->user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $this->password = $_SERVER['PHP_AUTH_PW'] ?? '';
        $this->headers = $this->parseHeaders($_SERVER);
        $this->clientIp = $this->parseClientIp($_SERVER);
        $this->agent = $this->parseAgent();
        $this->isAjax = $this->checkAjax();
        $this->params = $this->parseParams();
        $this->body = $this->parseBody();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
    
    /**
     * @return string
     */
    public function get(): string
    {
        return $this->get;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getBasicAuthUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getBasicAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isAjax(): bool
    {
        return $this->isAjax;
    }

    /**
     * @return bool
     */
    public function isJsonContent(): bool
    {
        return $this->headers['Content-Type'] === 'application/json';
    }

    /**
     * @param array $server
     * @return array
     */
    private function parseHeaders(array $server): array
    {
        $headers = [];

        foreach ($server as $key => $value) {

            if (strpos($key, 'HTTP_') === 0) {
                $newKey = str_replace('', '-', ucwords(
                    strtolower(str_replace('_', '', substr(
                        $key, 5)))));
                $headers[$newKey] = $value;
            }
        }
        return $headers;
    }

    /**
     * @param array $server
     * @return string
     */
    private function parseClientIp(array $server): string
    {
        $expectedHeaders = ['Client-IP', 'X-Forwarded-For', 'REMOTE_ADDR'];
        foreach ($expectedHeaders as $header) {
            if (isset($server[$header])) {
                return $server[$header];
            }
        }
        return '';
    }

    /**
     * @return string
     */
    private function parseAgent(): string
    {
        $expectedHeaders = ['X-Operamini-Phone-UA', 'X-Skyfire-Phone', 'User-Agent'];
        foreach ($expectedHeaders as $header) {
            if (isset($this->headers[$header])) {
                return $this->headers[$header];
            }
        }
        return '';
    }

    /**
     * @return array
     */
    private function parseParams(): array
    {
        $parts = parse_url($this->url);

        parse_str($parts['query'] ?? '', $getParams);

        return array_merge($this->params, $getParams);
    }

    /**
     * @return array
     */
    private function parseBody() : array
    {
        $rawBody = file_get_contents('php://input');

        if (! $rawBody)
        {
            return [];
        }

        if ($this->isJsonContent())
        {
            $body = json_decode($rawBody, true);
        }
        else
        {
            parse_str($rawBody, $body);
        }
        return $body;
    }

    /**
     * @return bool
     */
    private function checkAjax() : bool
    {
        return isset($this->headers['X-Requested-With']) && $this->headers['X-Requested-With'] === 'XMLHttpRequest';
    }
}

