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
        return Inertia::render('Homes/Index', compact('userHomes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Homes/Create');
    }

    /**
     * @param \App\Http\Requests\UserHomeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserHomeStoreRequest $request)
    {

        $userHome = $request->user()->homes()->create($request->validated());
        // $userHome = UserHome::create([
        //     'nickname' => $request->get('nickname'),
        //     // 'address' => $request->get('address'),
        //     // 'city' => $request->get('city'),
        //     // 'state' => $request->get('state'),
        //     // 'zip' => $request->get('zip'),
        //     'updated_by' => 1,
        //     "created_by" => 1,
        // ]);

        // $request->session()->flash('userHome.id', $userHome->id);

        return
            redirect()->route('homes.edit', $userHome->id)->with('success', 'Home added.'); //redirect()->route('Homes.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserHome $home)
    {
        return Inertia::render('Homes.show', compact('userHome'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserHome $home)
    {

        return Inertia::render('Homes/Edit', ['userHome' => $home]);
    }

    /**
     * @param \App\Http\Requests\UserHomeUpdateRequest $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function update(UserHomeUpdateRequest $request, UserHome $home)
    {
        $home->update($request->validated());

        // $request->session()->flash('userHome.id', $userHome->id);

        return redirect()->route('Homes.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserHome $userHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserHome $home)
    {
        $home->delete();

        return redirect()->route('Homes.index');
    }
}
