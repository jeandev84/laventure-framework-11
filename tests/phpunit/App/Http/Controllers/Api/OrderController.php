<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers\Api;

use Laventure\Component\Routing\Route\Attributes\Route;

/**
 * OrderController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers\Api
 */
#[Route(path: '/api/orders',  name: 'api.orders.')]
class OrderController
{


    #[Route(path: '/', methods: ['GET'], name: 'list')]
    public function index(): string
    {
        return __METHOD__;
    }


    #[Route(path: '/show/{id}', methods: ['GET'], name: 'show')]
    public function show(int $id): string
    {
        return __METHOD__;
    }


    #[Route(path: '/store', methods: ['POST'], name: 'store')]
    public function store(array $params): string
    {
        return __METHOD__;
    }



    #[Route(path: '/update/{id}', methods: ['PUT'], name: 'update')]
    public function update($id): string
    {
        return __METHOD__;
    }



    #[Route(path: '/destroy/{id}', methods: ['DELETE'], name: 'destroy')]
    public function destroy($id): string
    {
        return __METHOD__;
    }
}