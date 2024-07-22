<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private $categoryRepo;
    public function __construct() {
        $this->categoryRepo = new CategoryRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        Inertia::share('flash', session('flash', false));
        return Inertia::render('Category/Index', [
            'categories' => $this->categoryRepo->index()['data']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Inertia::share('flash', session('flash', false));
        $category = $this->categoryRepo->create($request);
        return Inertia::render('Category/Form', [
            'category'  => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'desc'     => 'required',
            ]
                
        );
        if ($validator->fails()) {
            return redirect(route('category.create'))->withErrors($validator->messages())->withInput();
        }
        else {
            $category = $this->categoryRepo->store($request);
            return redirect(route('category.index'))->withFlash($category['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Inertia::share('flash', session('flash', false));
        $category = $this->categoryRepo->edit($id);
        return Inertia::render('Category/Form', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'desc'     => 'required',
            ]

        );
        if ($validator->fails()) {
            return redirect(route('category.create'))->withErrors($validator->messages())->withInput();
        } else {
            $update = $this->categoryRepo->update($request, $id);
            return redirect(route('category.edit', $id))->withFlash($update['message']);

        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = $this->categoryRepo->destroy($id);
        return  redirect(route('category.index'))->withFlash($category['message']);
    }
}
