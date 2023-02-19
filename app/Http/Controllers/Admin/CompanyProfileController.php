<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;


class CompanyProfileController extends Controller
{
    // Edit
    public function edit()
    {
        $company = CompanyProfile::first();
        return view('pages.admin.company.content', compact('company'));
    }

    // Company profile Update 
    public function update(Request $request, CompanyProfile $company)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
            'logo' => 'mimes:jpg,jpeg,png,bmp',
            'about_image' => 'mimes:jpg,jpeg,png,bmp',
            'bg_image' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        // Image Update
        try {
            $companyLogo = $company->logo;
            $AboutImage = $company->about_image;
            $BgImage = $company->bg_image;

            if($request->hasFile('logo')) {
                if(!empty($company->logo) && file_exists($company->logo))
                {
                    unlink($company->logo);
                }
                $companyLogo = $this->imageUpload($request, 'logo', 'uploads/about');
            }

            if($request->hasFile('about_image')) {
                if(!empty($company->about_image) && file_exists($company->about_image))
                {
                    unlink($company->about_image);
                }
                $AboutImage = $this->imageUpload($request, 'about_image', 'uploads/about');
            }

            if($request->hasFile('bg_image')) {
                if(!empty($company->bg_image) && file_exists($company->bg_image))
                {
                    unlink($company->bg_image);
                }
                $BgImage = $this->imageUpload($request, 'bg_image', 'uploads/about');
            }
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->about = $request->about;
            $company->facebook = $request->facebook;
            $company->instagram = $request->instagram;
            $company->twitter = $request->twitter;
            $company->linkedin = $request->linkedin;
            $company->logo = $companyLogo;
            $company->about_image = $AboutImage;
            $company->bg_image = $BgImage;
            $company->save();
            return redirect()->back()->with('success','Update Successful!');        

        } catch (\Throwable $th) {
            // return redirect()->back()->withInput();
            return redirect()->back()->with('error', 'Update Failed!');
        }    
    }
}
