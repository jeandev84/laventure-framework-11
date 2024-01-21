<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use CURLFile;
use CurlHandle;
use Laventure\Component\Http\Client\Contract\HasOptionInterface;
use Laventure\Component\Http\Client\Contract\RequestSenderInterface;
use Laventure\Component\Http\Client\Options\Auth\AuthBasic;
use Laventure\Component\Http\Client\Options\Auth\AuthToken;
use Laventure\Component\Http\Client\Options\Body;
use Laventure\Component\Http\Client\Options\ClientCookie;
use Laventure\Component\Http\Client\Options\Download;
use Laventure\Component\Http\Client\Options\ClientFile;
use Laventure\Component\Http\Client\Options\Header;
use Laventure\Component\Http\Client\Options\Json;
use Laventure\Component\Http\Client\Options\Proxy;
use Laventure\Component\Http\Client\Options\QueryParams;
use Laventure\Component\Http\Client\Options\Upload;
use Laventure\Component\Http\Client\Options\UserAgent;
use Laventure\Component\Http\Client\Request\Exception\CurlException;
use Laventure\Component\Http\Client\Response\CurlResponse;
use Laventure\Component\Http\Client\Traits\HasOptionsTrait;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;

/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
 *
 * @see https://snipp.ru/php/curl
*/
class CurlRequest extends Request implements HasOptionInterface, RequestSenderInterface
{
    use HasOptionsTrait;


    /**
     * @var CurlHandle|false
    */
    protected $ch;





    /**
     * @var CURLFile[]
    */
    protected array $files = [];




    /**
     * @var array|string
    */
    protected mixed $data = null;





    /**
     * @var array
    */
    private array $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER         => false
    ];




    /**
     * @var string[]
    */
    protected $browserHeaders = [
        'cache-control: max-age=0',
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
        'sec-fetch-user: ?1',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'x-compress: null',
        'sec-fetch-site: none',
        'sec-fetch-mode: navigate',
        'accept-encoding: deflate, br',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
    ];




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
        'files'              => null,  // type ClientFile[]
        'cookies'            => null,  // type ClientCookie[]
        'userAgent'          => null   // type UserAgent(...)
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
        $this->setOptions($this->defaultOptions);
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
     * @inheritdoc
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
     * @param QueryParams $queries
     * @return $this
     */
    public function query(QueryParams $queries): static
    {
        $this->uri->withQuery($queries->toString());

        $this->withRequestTarget(strval($this->uri));

        return $this;
    }






    /**
     * @param Body $body
     * @return $this
    */
    public function body(Body $body): static
    {
        $this->data = $body->data;

        return $this;
    }





    /**
     * @param Json $json
     * @return $this
     */
    public function json(Json $json): static
    {
        $this->data = $json->data;

        return $this;
    }




    /**
     * @param Header[] $headers
     *
     * @return $this
     */
    public function headers(array $headers): static
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
    public function header(Header $header): static
    {
        $this->withHeader($header->name, $header->value);

        return $this;
    }







    /**
     * @param Proxy $proxy
     * @return $this
    */
    public function proxy(Proxy $proxy): static
    {
        return $this->setOptions([
            CURLOPT_TIMEOUT => $proxy->timeout,
            CURLOPT_PROXY   => $proxy->value
        ]);
    }






    /**
     * @param AuthBasic $payload
     * @return $this
    */
    public function authBasic(AuthBasic $payload): static
    {
        return $this->setOption(CURLOPT_USERPWD, $payload->toString());
    }






    /**
     * here we can give instance of AuthToken like AuthBearer, oAuth ...
     * @param AuthToken $token
     * @return $this
    */
    public function authToken(AuthToken $token): static
    {
        return $this->withHeader('Authorization', $token->accessToken);
    }






    /**
     * @param Upload $upload
     */
    public function upload(Upload $upload): void
    {
        $this->flush();

        $this->setOptions([
            CURLOPT_PUT => true,
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILESIZE => filesize($upload->file),
            CURLOPT_INFILE => $upload->resource
        ]);

        $this->exec();
        $this->close();
    }






    /**
     * First method download file
     *
     * @param Download $download
     *
     * @throws StreamException
    */
    public function download(Download $download): void
    {
        $this->flush();
        $resource = $download->resource;
        $this->setOption(CURLOPT_FILE, $resource);
        $this->withBody(new Stream($download->resource));
        $this->exec();
        $this->close();
    }





    /**
     * Download file 2nd method
     *
     * @param string $path
     * @throws StreamException
    */
    public function writeTo(string $path): void
    {
        $this->flush();
        $body = $this->exec();
        $this->close();
        file_put_contents($path, $body);
        $this->withBody(new Stream($path));
    }






    /**
     * @param ClientFile[] $files
     * @return $this
    */
    public function files(array $files): static
    {
        foreach ($files as $id => $file) {
            $this->file($id, $file);
        }

        return $this;
    }





    /**
     * @param $id
     * @param ClientFile $file
     *
     * @return $this
    */
    public function file($id, ClientFile $file): static
    {
        $file = curl_file_create(
            $file->path,
            $file->mimeType,
            $file->filename
        );

        $this->files[$id] = $file;

        return $this;
    }






    /**
     * @param ClientCookie[] $cookies
     * @return $this
    */
    public function cookies(array $cookies): static
    {
        foreach ($cookies as $cookie) {
            $this->cookie($cookie);
        }

        return $this;
    }







    /**
     * @param ClientCookie $cookie
     * @return $this
    */
    public function cookie(ClientCookie $cookie): static
    {
        $curl = $this->setOptions([
            CURLOPT_COOKIEFILE =>  $cookie->cookieFile,
            CURLOPT_COOKIEJAR  =>  $cookie->cookieFile
        ]);

        if ($cookieParams = $cookie->toStringParams()) {
            $curl->withHeader('Cookie', $cookieParams);
        }

        return $curl;
    }





    /**
     * @param UserAgent $agent
     * @return $this
     */
    public function userAgent(UserAgent $agent): static
    {
        $this->setOptions([
            CURLOPT_USERAGENT => $agent->name,
            CURLOPT_HEADER    => true
        ]);

        $headers       = array_merge($this->browserHeaders, $agent->headers);
        $this->headers = array_merge($this->headers, $headers);

        return $this->cookie(new ClientCookie($agent->cookieFile));
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
     * @return void
    */
    private function flush(): void
    {
        $this->setOptions([
            CURLOPT_URL        => $this->target,
            CURLOPT_HTTPHEADER => array_values($this->headers)
        ])->setPostFields();
    }




    /**
     * @return $this
    */
    private function setPostFields(): static
    {
        if (in_array($this->method, ['POST', 'PUT', 'PATCH'])) {
            $this->setOption(CURLOPT_POSTFIELDS, $this->getPostFields());
        }

        return $this;
    }






    /**
     * @return array
    */
    private function getPostFields(): array
    {
        return array_merge(
            (array)$this->data,
            $this->files
        );
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
    ): ResponseInterface {
        $response = new CurlResponse($statusCode);
        $response->getBody()->write($body);
        $response->withHeaders($headers);
        return $response;
    }
}
