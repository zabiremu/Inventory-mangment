<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::latest()->get();
        return view('admin.customer.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imgExt = $request->image->extension();
        $imgName = time() . '.' . $imgExt;
        $imageSave = $request->image->move(public_path('uploads/customer-images'), $imgName);
        $saveUrl = 'uploads/customer-images/' . $imgName;

        Customer::insert([
            'name' => $request->name,
            'mobile_no' => $request->customer_mb,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $saveUrl,
            'created_by' =>Auth::user()->id,
            'created_at' =>Carbon::now(),
        ]);

        $notification = array(
            'message' => "Successfully customer added",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.customers')
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
        $data = Customer::findOrFail($id);
        return view('admin.customer.edit',compact('data'));
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
        $data = Customer::findOrFail($id);
        $oldImg = explode('/', $data->image);
        $end = end($oldImg);

        if($request->file('image')){
            $path = unlink(public_path($data->image));

            $imgExt = $request->image->extension();
            $imgName = time() . '.' . $imgExt;
            $imageSave = $request->image->move(public_path('uploads/customer-images'), $imgName);
            $saveUrl = 'uploads/customer-images/' . $imgName;
    
            Customer::findOrFail($id)->update([
                'name' => $request->name,
                'mobile_no' => $request->customer_mb,
                'email' => $request->email,
                'address' => $request->address,
                'image' => $saveUrl,
                'updated_by' =>Auth::user()->id,
                'created_at' =>Carbon::now(),
            ]);
    
            $notification = array(
                'message' => "Successfully customer data updated",
                'alert-type' => 'success',
            );
            return redirect()
                ->route('all.customers')
                ->with($notification);
        }else{
            Customer::findOrFail($id)->update([
                'name' => $request->name,
                'mobile_no' => $request->customer_mb,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' =>Auth::user()->id,
                'created_at' =>Carbon::now(),
            ]);
    
            $notification = array(
                'message' => "Successfully customer data updated",
                'alert-type' => 'success',
            );
            return redirect()
                ->route('all.customers')
                ->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::findOrFail($id);
        $path = unlink(public_path($data->image));
        $data->delete();
        $notification = array(
            'message' => "Successfully customer data deleted",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.customers')
            ->with($notification);
    }
}
