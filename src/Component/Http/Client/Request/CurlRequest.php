<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use CurlHandle;
use Laventure\Component\Http\Client\Contract\HasOptionInterface;
use Laventure\Component\Http\Client\Contract\HttpClientOptions;
use Laventure\Component\Http\Client\Response\CurlResponse;
use Laventure\Component\Http\Client\Traits\HasOptionsTrait;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Http\Utils\Params\Parameter;
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
class CurlRequest extends ServerRequest implements HasOptionInterface
{

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
     * @var array
     */
    protected array $options = [
        'query'              => [],           // type string[]
        'body'               => '',           // type array|string
        'json'               => null,         // type array|string
        'headers'            => [],           // type string[]
        'proxy'              => '',           // type string[]
        'auth_basic'         => null,         // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'auth_token'         => '',           // type AuthToken('YOUR_ACCESS_TOKEN')
        'upload'             => null,         // type string
        'download'           => null,         // type string
        'files'              => [],           // type ClientFileInterface[]
        'cookies'            => [],           // type ClientCookieInterface[]
    ];




    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $options
    */
    public function __construct(string $method, UriInterface|string $uri, array $options = [])
    {
        // important to initialize before
        $this->ch = curl_init();
        $this->initialize();
        parent::__construct($method, $uri);
        $this->withOptions(array_merge($this->options, $options));
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
     * @param array $options
     *
     * @return $this
     */
    public function withOptions(array $options): static
    {
        $options = new Parameter($options);
        foreach ($options->all() as $key => $value) {
            if (!empty($value)) {
                if (method_exists($this, $key)) {
                    call_user_func_array([$this, $key], [$value]);
                }
            }
        }

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
            CURLOPT_HTTPHEADER => $this->headers
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
                $this->setOption(CURLOPT_POSTFIELDS, ['salut' => 'les amis']);
                break;
        endswitch;

        return $this;
    }



    /**
     * @param array $queries
     * @return $this
     */
    private function query(array $queries): static
    {
        $this->uri->withQuery(http_build_query($queries));

        $this->withRequestTarget(strval($this->uri));

        return $this;
    }




    /**
     * @param array $headers
     * @return $this
    */
    public function withHeaders(array $headers): static
    {
        foreach ($headers as $key => $value) {
             $this->withHeader($key, $value);
        }

        return $this;
    }


    /**
     * @param $name
     * @param $value
     * @return $this
    */
    public function withHeader($name, $value): static
    {
         $this->headers[] = "$name: $value";

         return $this;
    }




    /**
     * @param array $headers
     * @return $this
    */
    private function headers(array $headers): static
    {
        $this->withHeaders($headers);

        return $this;
    }
}
