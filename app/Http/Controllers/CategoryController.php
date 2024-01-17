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
    public function index()
    {
        Inertia::share('flash', session('flash', false));
        $categories = $this->categoryRepo->index();
        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Inertia::share('flash', session('flash', false));
        return Inertia::render('Category/Form', [
            'category' => $this->categoryRepo->create()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), 
            [
                'name'  => 'required',
                'desc'  => 'required'
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $category = $this->categoryRepo->store($request);
        
        if ($category['status']) {
            return redirect(route('category.index'))->withFlash($category['message']);
        }
        else {
            $validator->getMessageBag()->add('errors', 'Gagal menambahkan kategori');
            return redirect()->back()->withErrors($validator->messages());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryRepo->show($id);
        return response($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Inertia::share('flash', session('flash', false));
        return Inertia::render('Category/Form', [
            'category' => $this->categoryRepo->edit($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'desc'  => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $category = $this->categoryRepo->update($request, $id);
        if ($category) {
            return redirect()->back()->withFlash($category['message']);
        }
        $validator->getMessageBag()->add('errors', 'Gagal update kategori');
        return redirect()->back()->withErrors($validator->messages());
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->categoryRepo->destroy($id);
        if ($delete['status']) {
            return redirect(route('category.index'))->withFlash($delete['message']);
        }
        $validator = Validator::make([Request::class], []);
        $validator->getMessageBag()->add('message', $delete['message']);
    }
}
