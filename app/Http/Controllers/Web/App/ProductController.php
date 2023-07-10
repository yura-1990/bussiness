<?php

namespace App\Http\Controllers\Web\App;

use App\DTOs\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;

#[Prefix('admin')]
#[Middleware('web')]
#[PathItem]
class ProductController extends Controller
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */

    #[Get('/product')]
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $products = Product::query()->paginate(5);

        return view('products.index', compact('products',));
    }

    /**
     * @param Product $product
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/product/show/{product}')]
    public function show(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();
        return view('products.show', compact('product', 'categories'));
    }

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/product/create')]
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();
        return view('products.create', compact('categories'));
    }

    /**
     * @throws UnknownProperties
     */
    #[Post('product/store')]
    public function store(ProductRequest $request): RedirectResponse
    {
        $dtoRequest = new ProductDTO($request->validated());

        if ($request->hasFile('image')){
            $dtoRequest->image = $this->uploadFile($request->file('image'), 'products');
        }

        Product::query()->create($this->filterDate($dtoRequest->all()));

        return response()->redirectTo('admin/product');
    }

    /**
     * @param Product $product
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/product/edit/{product}')]
    public function edit(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * @throws UnknownProperties
     */
    #[Put('/product/update/{product}')]
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $dtoRequest = new ProductDTO($request->validated());
        if ($request->hasFile('image')){
            $this->deleteFile($product->image);

            $dtoRequest->image = $this->uploadFile($request->file('image'), 'products');
        } else {
            $dtoRequest->image = $product->image;
        }

        $product->update($this->filterDate($dtoRequest->all()));

        return response()->redirectTo('admin/product');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    #[Delete('/product/delete/{product}')]
    public function delete(Product $product): RedirectResponse
    {
        $product->delete();

        return response()->redirectTo('admin/product');
    }

}
