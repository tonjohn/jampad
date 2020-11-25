<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\UserProductStoreRequest;
use App\Http\Requests\UserProductUpdateRequest;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userProducts = UserProduct::all();

        return Inertia::render('Products/Index', compact('userProducts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Products/Create');
    }

    /**
     * @param \App\Http\Requests\UserProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProductStoreRequest $request)
    {
        $userProduct = UserProduct::create($request->validated());

        // $request->session()->flash('userProduct.id', $userProduct->id);

        return redirect()->route('userProduct.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Inertia::render('Products/Show');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserProduct $userProduct)
    {
        return Inertia::render('Products/Edit', compact('userProduct'));
    }

    /**
     * @param \App\Http\Requests\UserProductUpdateRequest $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UserProductUpdateRequest $request, UserProduct $userProduct)
    {
        $userProduct->update($request->validated());

        // $request->session()->flash('userProduct.id', $userProduct->id);

        return redirect()->route('userProduct.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserProduct $userProduct)
    {
        $userProduct->delete();

        return redirect()->route('userProduct.index');
    }
}
