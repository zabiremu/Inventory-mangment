<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display all supplier list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSupplierData = Supplier::latest()->get();
        return view('admin.supplier.view',compact('allSupplierData'));
    }

    /**
     * Display supplier create  view.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saveData = Supplier::insert([
            'name' => $request->name,
            'mobile_no' => $request->supplier_mb,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' =>Auth::user()->id,
            'created_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => "Successfully supplier added",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.suppliers')
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
        $supplierData = Supplier::find($id);
        return view('admin.supplier.edit', compact('supplierData'));
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
        $saveData = Supplier::find($id)->update([
            'name' => $request->name,
            'mobile_no' => $request->supplier_mb,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' =>Auth::user()->id,
            'created_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => "Successfully supplier updated",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.suppliers')
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
        $deleteData = Supplier::findOrFail($id);
        $deleteData->delete();
        $notification = array(
            'message' => "Successfully supplier data deleted",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.suppliers')
            ->with($notification);
    }
}
