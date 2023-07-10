<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\OpenApi\Parameters\CategoryParameters;
use App\OpenApi\Parameters\ProductParameters;
use App\OpenApi\Parameters\SearchProductParameters;
use App\OpenApi\Responses\CategoryResponse;
use App\OpenApi\Responses\ProductResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\Parameters;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[Prefix('/product')]
#[PathItem]
class ProductController extends Controller
{
        /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Get('/')]
    #[Operation(tags: ['Product'], method: 'GET' )]
    #[Parameters(factory: SearchProductParameters::class)]
    #[Response(factory: ProductResponse::class)]
    public function getAll(Request $request): JsonResponse
    {
        $search = $request->query('search');

        if ($search){
            $products = Product::search($search)->get();
        } else {
            $products = Product::query()->get();
        }

        return $this->success($products);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    #[Get('/get-one/{product}')]
    #[Operation(tags: ['Product'], method: 'GET')]
    #[Parameters(factory: ProductParameters::class)]
    #[Response(factory: ProductResponse::class)]
    public function getOne(Product $product): JsonResponse
    {
        return $this->success($product);
    }

}
