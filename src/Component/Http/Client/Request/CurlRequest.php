<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use CurlHandle;
use Laventure\Component\Http\Client\Contract\HasOptionInterface;
use Laventure\Component\Http\Client\Contract\HttpClientOptions;
use Laventure\Component\Http\Client\Contract\RequestSenderInterface;
use Laventure\Component\Http\Client\Options\AuthBasic;
use Laventure\Component\Http\Client\Options\AuthToken;
use Laventure\Component\Http\Client\Options\Body;
use Laventure\Component\Http\Client\Options\Header;
use Laventure\Component\Http\Client\Options\Json;
use Laventure\Component\Http\Client\Options\QueryParams;
use Laventure\Component\Http\Client\Request\Exception\CurlException;
use Laventure\Component\Http\Client\Response\CurlResponse;
use Laventure\Component\Http\Client\Traits\HasOptionsTrait;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Response\Utils\JsonEncoder;
use Laventure\Component\Http\Utils\Params\Parameter;
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
class CurlRequest extends ServerRequest implements HasOptionInterface, RequestSenderInterface
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
     * @var mixed
    */
    private $data;




    /**
     * @var array
    */
    protected array $options = [
        'query'              => null,  // type QueryParams($queries)
        'body'               => null,  // type Body($data)
        'json'               => null,  // type Json($data)
        'headers'            => null,  // type Header($headers)
        'proxy'              => null,  // type Proxy()
        'authBasic'          => null,  // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'authToken'          => null,  // type AuthToken('YOUR_ACCESS_TOKEN'), oAuth(), AuthBearer
        'upload'             => null,  // type Upload()
        'download'           => null,  // type Download()
        'files'              => null,  // type File[]
        'cookies'            => null,  // type Cookie[]
        'userAgent'          => null   // type UserAgent()
    ];




    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $options
    */
    public function __construct(string $method, UriInterface|string $uri, array $options = [])
    {
        // important to initialize before
        $this->initialize();
        parent::__construct($method, $uri);
        $this->withOptions(array_merge($this->options, $options));
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
     * @inheritdoc
     * @throws CurlException
     */
    public function send(): ResponseInterface
    {
        // terminate options setting
        $this->flush();

        // returns response body
        $body = $this->responseBody();

        // returns response status code
        $statusCode = $this->responseStatusCode();

        // returns response headers
        $headers = $this->responseHeaders();

        // close curl
        $this->close();

        // returns response
        return $this->createResponse($body, $statusCode, $headers);
    }






    /**
     * @return array
     */
    private function responseHeaders(): array
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
    private function responseBody(): string
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
    private function responseStatusCode(): int
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
    ): ResponseInterface {
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
        $this->ch = curl_init();
        $this->setOptions($this->defaultOptions);
    }




    /**
     * @return void
    */
    private function flush(): void
    {
        $this->setOptions([
            CURLOPT_URL        => $this->target,
            CURLOPT_HTTPHEADER => array_values($this->headers)
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
                $this->setOption(CURLOPT_POSTFIELDS, $this->parsedBody);
                break;
        endswitch;

        return $this;
    }



    /**
     * @param QueryParams $queries
     * @return $this
    */
    private function query(QueryParams $queries): static
    {
        $this->uri->withQuery($queries->toString());

        $this->withRequestTarget(strval($this->uri));

        $this->withQueryParams($queries->all());

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
        $this->headers[$name] = "$name: $value";

        return $this;
    }




    /**
     * @param Header[] $headers
     *
     * @return $this
    */
    private function headers(array $headers): static
    {
        foreach ($headers as $header) {
            $this->header($header);
        }

        return $this;
    }



    /**
     * @param Header $header
     * @return $this
     */
    private function header(Header $header): static
    {
        $this->withHeader($header->name, $header->value);

        return $this;
    }



    /**
     * @param Body $body
     * @return $this
    */
    private function body(Body $body): static
    {
        return $this->withParsedBody($body->data);
    }



    /**
     * @param Json $json
     * @return $this
    */
    private function json(Json $json): static
    {
        return $this->withParsedBody($json->data);
    }






    /**
     * @param AuthBasic $payload
     * @return $this
    */
    private function authBasic(AuthBasic $payload): static
    {
        return $this->setOption(CURLOPT_USERPWD, $payload->toString());
    }




    /**
     * here we can give instance of AuthToken like AuthBearer, oAuth ...
     * @param AuthToken $token
     * @return $this
    */
    private function authToken(AuthToken $token): static
    {
        return $this->withHeader('Authorization', $token->accessToken);
    }




    /*
      'query'              => [],           // type string[]
        'body'               => null,         // type array|string
        'json'               => null,         // type array|string
        'headers'            => [],           // type string[]
        'proxy'              => [],           // type string[]
        'authBasic'          => null,         // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'authToken'          => null,         // type AuthToken('YOUR_ACCESS_TOKEN'),
        'oAuth               => null,         // type oAuth('YOUR_TOKEN')
        'upload'             => null,         // type string
        'download'           => null,         // type string
        'files'              => [],           // type ClientFileInterface[]
        'cookies'            => [],           // type ClientCookieInterface[]
    */
}
