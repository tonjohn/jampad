<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\UserHomeStoreRequest;
use App\Http\Requests\UserHomeUpdateRequest;
use App\Models\UserHome;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userHomes = UserHome::all();

        return Inertia::render('Homes.index', compact('userHomes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Homes.create');
    }

    /**
     * @param \App\Http\Requests\UserHomeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserHomeStoreRequest $request)
    {
        $userHome = UserHome::create($request->validated());

        // $request->session()->flash('userHome.id', $userHome->id);

        return redirect()->route('Homes.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserHome $userHome)
    {
        return Inertia::render('Homes.show', compact('userHome'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserHome $userHome)
    {
        return Inertia::render('Homes.edit', compact('userHome'));
    }

    /**
     * @param \App\Http\Requests\UserHomeUpdateRequest $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function update(UserHomeUpdateRequest $request, UserHome $userHome)
    {
        $userHome->update($request->validated());

        // $request->session()->flash('userHome.id', $userHome->id);

        return redirect()->route('Homes.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserHome $userHome)
    {
        $userHome->delete();

        return redirect()->route('Homes.index');
    }
}
