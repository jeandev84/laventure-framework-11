<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Traits;

use Laventure\Component\Http\Client\DTO\HttpClientOptions;

/**
 * HasOptionsTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Traits
*/
trait HasOptionsTrait
{
    /**
     * @var array
    */
    protected array $overrides = [
        'auth_basic'         => 'authBasic',         // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'auth_token'         => 'authToken',           // type AuthToken('YOUR_ACCESS_TOKEN')
    ];




    /**
     * @param array $options
     *
     * @return $this
    */
    public function withOptions(array $options): static
    {
        $options = new HttpClientOptions($options);

        foreach ($options->all() as $key => $value) {
            if (!empty($value)) {
                if (array_key_exists($key, $this->overrides)) {
                    $key = $this->overrides[$key];
                }
                if (method_exists($this, $key)) {
                    call_user_func_array([$this, $key], [$value]);
                }
            }
        }

        return $this;
    }
}
