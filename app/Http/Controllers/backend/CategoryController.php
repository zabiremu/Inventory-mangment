<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::latest()->get();
        return view('admin.category.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => "Successfully category data uploaded",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.category')
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('admin.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::findOrFail($id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => "Successfully category data updated",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.category')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        $notification = array(
            'message' => "Successfully category data deleted",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.category')
            ->with($notification);
    }

}
