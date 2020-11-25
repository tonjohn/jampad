<?php

namespace App\Http\Controllers;

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

        return view('userProduct.index', compact('userProducts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('userProduct.create');
    }

    /**
     * @param \App\Http\Requests\UserProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProductStoreRequest $request)
    {
        $userProduct = UserProduct::create($request->validated());

        $request->session()->flash('userProduct.id', $userProduct->id);

        return redirect()->route('userProduct.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserProduct $userProduct)
    {
        return view('userProduct.show', compact('userProduct'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserProduct $userProduct)
    {
        return view('userProduct.edit', compact('userProduct'));
    }

    /**
     * @param \App\Http\Requests\UserProductUpdateRequest $request
     * @param \App\Models\UserProduct $userProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UserProductUpdateRequest $request, UserProduct $userProduct)
    {
        $userProduct->update($request->validated());

        $request->session()->flash('userProduct.id', $userProduct->id);

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
