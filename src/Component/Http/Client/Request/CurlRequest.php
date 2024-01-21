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
use Laventure\Component\Http\Client\Request\Exception\CurlException;
use Laventure\Component\Http\Client\Response\CurlResponse;
use Laventure\Component\Http\Client\Traits\HasOptionsTrait;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Stream\Exception\StreamException;
use Laventure\Component\Http\Message\Stream\Stream;
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
 *
 * @see https://snipp.ru/php/curl
*/
class CurlRequest extends ServerRequest implements HasOptionInterface, RequestSenderInterface
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
     * @var CURLFile[]
    */
    private array $files = [];




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
        $this->ch = curl_init();
        $this->curlOptions($this->defaultOptions);
        parent::__construct($method, $uri);
        $this->withOptions(array_merge($this->options, $options));
    }







    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function curlOption($id, $value): static
    {
        curl_setopt($this->ch, $id, $value);

        return $this;
    }





    /**
     * @param array $options
     * @return $this
     */
    public function curlOptions(array $options): static
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
                $this->curlOption(CURLOPT_POST, 1);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->curlOption(CURLOPT_CUSTOMREQUEST, $method);
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

        $this->withQueryParams($queries->all());

        return $this;
    }






    /**
     * @param Body $body
     * @return $this
     */
    public function body(Body $body): static
    {
        return $this->withParsedBody($body->data);
    }





    /**
     * @param Json $json
     * @return $this
     */
    public function json(Json $json): static
    {
        return $this->withParsedBody($json->data);
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
        return $this->curlOptions([
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
        return $this->curlOption(CURLOPT_USERPWD, $payload->toString());
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
     * @return $this
     */
    public function upload(Upload $upload): static
    {
        $this->flush();

        $this->curlOptions([
            CURLOPT_PUT => true,
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILESIZE => filesize($upload->file),
            CURLOPT_INFILE => $upload->resource
        ]);

        $this->exec();
        $this->close();
        return $this;
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
        $this->curlOption(CURLOPT_FILE, $resource);
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

        $this->withUploadedFiles([$id => $file]);

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
        return $this->curlOptions([
            CURLOPT_COOKIEFILE => $cookie->cookieFile,
            CURLOPT_COOKIEJAR =>  $cookie->cookieJar
        ]);
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
    private function initialize(): void
    {

    }





    /**
     * @return void
    */
    private function flush(): void
    {
        $this->curlOptions([
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
                $this->curlOption(CURLOPT_POSTFIELDS, $this->getPostFields());
                break;
        endswitch;

        return $this;
    }




    /**
     * @return array
    */
    private function getPostFields(): array
    {
        if (is_string($this->parsedBody)) {
            return $this->parsedBody;
        }

        return array_merge((array)$this->parsedBody, $this->uploadedFiles);
    }






    /**
     * @return array
     */
    private function getResponseHeaders(): array
    {
        $this->curlOptions([
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
