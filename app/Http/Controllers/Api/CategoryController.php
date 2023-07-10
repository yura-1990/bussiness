<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\OpenApi\Parameters\CategoryParameters;
use App\OpenApi\Responses\CategoryResponse;
use App\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\Parameters;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[Prefix('/category')]
#[PathItem]
class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    #[Get('/')]
    #[Operation(tags: ['Category'], method: 'GET')]
    #[Response(factory: CategoryResponse::class)]
    public function getAll(): JsonResponse
    {
        $categories = Category::query()->get();

        return $this->success($categories);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    #[Get('/get-one/{category}')]
    #[Operation(tags: ['Category'], method: 'GET')]
    #[Parameters(factory: CategoryParameters::class)]
    #[Response(factory: CategoryResponse::class)]
    public function getOne(Category $category): JsonResponse
    {
        return $this->success($category);
    }

}
