<?php

namespace App\Http\Controllers\Web\App;

use App\DTOs\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\CategoryRequst;
use App\Models\Category\Category;
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
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;

#[Prefix('admin')]
#[Middleware('web')]
#[PathItem]
class CategoryController extends Controller
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/category')]
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();

        return view('category.index', compact('categories'));
    }

    /**
     * @param Category $category
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/category/show/{category}')]
    public function show(Category $category): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $parentCategories = Category::query()->where('parent_id', $category->id)->get();
        return view('category.show', compact('category', 'parentCategories'));
    }

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/category/create')]
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();

        return view('category.create', compact('categories'));
    }

    /**
     * @throws UnknownProperties
     */
    #[Post('/category/store')]
    public function store(CategoryRequst $request): RedirectResponse
    {
        $dtoRequest = new CategoryDTO($request->validated());
        Category::query()->create($this->filterDate($dtoRequest));

        return response()->redirectTo('admin/category');
    }

    /**
     * @param Category $category
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    #[Get('/category/edit/{category}')]
    public function edit(Category $category): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = Category::query()->get();
        return view('category.edit', compact('category', 'categories'));
    }

    /**
     * @throws UnknownProperties
     */
    #[Post('/category/update/{category}')]
    public function update(CategoryRequst $request, Category $category): RedirectResponse
    {
        $dtoRequest = new CategoryDTO($request->validated());
        $category->update($dtoRequest->all());

        return response()->redirectTo('admin/category');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    #[Delete('/category/delete/{category}')]
    public function delete(Category $category): RedirectResponse
    {
        $category->delete();

        return response()->redirectTo('admin/category');
    }
}
