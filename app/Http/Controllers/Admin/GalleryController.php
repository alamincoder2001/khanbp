<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Gallery;
use DB;
use Image;

class GalleryController extends Controller
{
    public function gallery() {
        $galleries = Gallery::latest()->get();
        $event = Event::latest()->get();
        return view('pages.admin.gallery.index', compact('galleries', 'event'));
    }
    public function galleryInsert(Request $request) {
        $request->validate([
            'event_id' => 'required',
            'image.*' => 'required|mimes:jpeg,jpg,png,gif,webp',
        ]);
        
        try {
            DB::beginTransaction();

            $eventName = Event::find($request->event_id)->name;
            $eventName = strtolower(preg_replace('/\s+/', '-', $eventName));
            $image = $request->file('image');
            if($request->hasFile('image')) {
                $lastImage = Gallery::where('event_id', $request->event_id)->orderBy('id', 'desc')->first();
                if($lastImage) {
                    $lastImageNameExt = $lastImage->title;
                    $lastImageName = explode('_', $lastImageNameExt);
                    $lastextNumber = explode('.', $lastImageName[1]);
                    $lastNumber = $lastextNumber[0] + 1;
                }
                
                foreach ($image as $key => $item) {
                    //image upload
                    $gallery = new Gallery;
                    // $nameGen = hexdec(uniqid());
                    $imgExt = strtolower($item->getClientOriginalExtension());
                    $imgName = $eventName. '_' . (@$lastImage ? $lastNumber++ : $key) . '.' . $imgExt;
                     
                    $upLocation = 'uploads/gallery/';
                    Image::make($item)->resize(720,480)->save($upLocation . $imgName);
                    //close image upload
                    $gallery->event_id = $request->event_id;
                    $gallery->title = $imgName;
                    $gallery->image = $imgName;
                    $gallery->save();
                    DB::commit();
                }
                return redirect()->back()->with('success', 'photo Inserted!');
            }
            else {
                return redirect()->back()->with('error', 'Insert Image First');
            }
        } catch (\Exception $e) {
            DB::rollback();           
		    // return ["error" => $e->getMessage()];
            return Redirect()->back()->with('Failed', 'Photo insertion failed!');
        }
    }
    public function galleryEdit($id) {
        $event = Event::latest()->get();
        $gallery = Gallery::find($id);
        return view('pages.admin.gallery.edit', compact('gallery', 'event'));
    }

    public function galleryUpdate(Request $request, $id) {
        $validatedData = $request->validate([
            'event_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $gallery = Gallery::find($id);
            $gallery->event_id = $request->event_id;
            // $arr = explode('.', $image);
            // $ext = strtolower($image->getClientOriginalExtension());
            // $name = $arr[0];
            // $gallery->title = $request->title;
            $image = $request->file('image');
            if($image) {
                // $imageName = hexdec(uniqid()).$image->getClientOriginalName();
                $oldimg = $gallery->image;
                $arr = explode('.', $oldimg);
                $firstpart = $arr[0];
                $ext = strtolower($image->getClientOriginalExtension());
                $imageName = $firstpart . '.' . $ext;

                if(file_exists('uploads/gallery/'. $gallery->image) && !empty($gallery->image)) {
                    unlink('uploads/gallery/' . $gallery->image);
                }
                Image::make($image)->resize(720,480)->save('uploads/gallery/' . $imageName);
                $gallery['image'] = $imageName;
            }
            $gallery->save();
            DB::commit();
            return Redirect()->back()->with("success", "Update Successfull");
        } catch(\Exception $e) {
            DB::rollback();         
		    // return ["error" => $e->getMessage()];
            return redirect()->back()->with('error', 'Gallery insert failed!');
        }
    }
    public function galleryDelete($id) {
        $gallery = Gallery::find($id);
        if(file_exists('uploads/gallery/'.$gallery->image) AND !empty($gallery->image)) {
            unlink('uploads/gallery/'.$gallery->image);
        }
        $gallery->delete();
        return Redirect()->back()->with("success", "Photo Deleted Successfully");
    }
}
