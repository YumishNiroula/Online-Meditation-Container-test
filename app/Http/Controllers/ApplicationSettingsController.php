<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSettings;
use Illuminate\Http\Request;

class ApplicationSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Dashboard"], ['link' => "/app-settings", 'name' => 'General Settings'], ['name' => "Index"]
        ];

        $app = ApplicationSettings::latest()->first();
        return view('backend.settings.application_settings.index', ['app' => $app, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $app = ApplicationSettings::latest()->first();

        $appSetup = new ApplicationSettings();
        $appSetup->system_name = $request->name;
        if ($request->file('image')) {
            $file = $request->file('image');
            if ($app->image != 'logo.png') {
                @unlink(public_path('uploads/logo/' . $app->image));
            };
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/logo'), $filename);
            $appSetup['image'] = $filename;
        };
        $appSetup->save();

        // Delete the last uploaded record from the database after a successful upload
        $app->delete();

        $notification = array(
            'message' => 'Application settings saved successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('app-settings.index')->with($notification);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
