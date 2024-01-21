<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use CurlHandle;
use Laventure\Component\Http\Client\Contract\HasOptionsInterface;
use Laventure\Component\Http\Client\Response\CurlResponse;
use Laventure\Component\Http\Client\Traits\HasOptionsTrait;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
class CurlRequest extends Request implements RequestInterface, HasOptionsInterface
{
    use HasOptionsTrait;


    /**
     * @var CurlHandle|false
    */
    protected $ch;


    /**
     * @var array
    */
    private array $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER         => false
    ];




    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $options
    */
    public function __construct(string $method, UriInterface|string $uri, array $options = [])
    {
        parent::__construct($method, $uri);
        $this->init();
        $this->initialize();
        $this->withOptions($options);
    }







    /**
      * @inheritDoc
    */
    public function query(array $queries): static
    {
        $this->uri->withQuery(http_build_query($queries));

        $this->withRequestTarget(strval($this->uri));

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function headers(array $headers): static
    {
        $this->withHeaders($headers);

        return $this;
    }




    /**
     * @return ResponseInterface
     * @throws CurlException
    */
    public function send(): ResponseInterface
    {
        // terminate options setting
        $this->terminate();

        // returns response body
        $body = $this->getResponseBody();

        // returns response status code
        $statusCode = $this->getResponseStatusCode();

        // returns response headers
        $headers = $this->getResponseHeaders();

        // close curl
        $this->close();

        // returns response
        return $this->createResponse($body, $statusCode, $headers);
    }




    /**
     * @return array
     */
    private function getResponseHeaders(): array
    {
        $this->setOptions([
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true
        ]);

        $response   = $this->exec();
        $headerRows = explode(PHP_EOL, $response);
        $headerRows = array_filter($headerRows, 'trim');
        return $this->filterHeaders($headerRows);
    }




    /**
     * @return string
     * @throws CurlException
     */
    private function getResponseBody(): string
    {
        // returns response body
        $body = $this->exec();

        // check curl error
        if ($errno = $this->errno()) {
            throw new CurlException($this->error(), $errno);
        }

        return strval($body);
    }




    /**
     * @return int
    */
    private function getResponseStatusCode(): int
    {
        return intval($this->info(CURLINFO_HTTP_CODE));
    }





    /**
     * @param string $body
     * @param int $statusCode
     * @param array $headers
     * @return ResponseInterface
    */
    private function createResponse(
        string $body,
        int $statusCode,
        array $headers
    ): ResponseInterface
    {
        $response = new CurlResponse($statusCode);
        $response->getBody()->write($body);
        $response->withHeaders($headers);
        return $response;
    }





    /**
     * @param array $headerRows
     *
     * @return array
    */
    private function filterHeaders(array $headerRows): array
    {
        $headers = [];

        foreach ($headerRows as $header) {
            $position = stripos($header, ':');
            if($position !== false) {
                [$name, $value] = explode(':', $header, 2);
                $headers[$name] = trim($value);
            }
        }

        return $headers;
    }






    /**
     * @param string $uri
     * @return $this
     */
    public function init(string $uri = ''): static
    {
        $this->ch = curl_init($uri);

        return $this;
    }





    /**
     * @param $id
     * @param $value
     * @return $this
     */
    public function setOption($id, $value): static
    {
        curl_setopt($this->ch, $id, $value);

        return $this;
    }





    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): static
    {
        curl_setopt_array($this->ch, $options);

        return $this;
    }




    /**
     * @return string|false
    */
    public function exec(): string|false
    {
        return curl_exec($this->ch);
    }




    /**
     * @return void
    */
    public function close(): void
    {
        curl_close($this->ch);
    }





    /**
     * @return int
    */
    public function errno(): int
    {
        return curl_errno($this->ch);
    }




    /**
     * @return string
    */
    public function error(): string
    {
        return curl_error($this->ch);
    }






    /**
     * @return mixed
     */
    public function infos(): mixed
    {
        return curl_getinfo($this->ch);
    }





    /**
     * @param int $key
     * @return mixed
    */
    public function info(int $key): mixed
    {
        return curl_getinfo($this->ch, $key);
    }



    /**
     * @param string $method
     * @return $this
    */
    public function withMethod(string $method): static
    {
        switch ($method):
            case 'POST':
                $this->setOption(CURLOPT_POST, 1);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
                break;
        endswitch;

        return parent::withMethod($method);
    }




    /**
     * @return void
    */
    private function initialize(): void
    {
        $this->setOptions($this->defaultOptions);
    }




    /**
     * @return void
    */
    private function terminate(): void
    {
        $this->setOptions([
            CURLOPT_URL        => $this->target,
            CURLOPT_HTTPHEADER => ['X-Framework' => 'Laventure']
        ])->setPostFiles();
    }




    /**
     * @return $this
    */
    private function setPostFiles(): static
    {
        switch ($this->method):
            case 'POST':
            case 'PUT':
            case 'PATCH':
                $this->setOption(CURLOPT_POSTFIELDS, []);
                break;
        endswitch;

        return $this;
    }
}
