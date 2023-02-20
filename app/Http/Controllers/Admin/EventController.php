<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use function PHPUnit\Framework\fileExists;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::latest()->get();
        return view('pages.admin.event', compact('event'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:events|max:100',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|dimensions:width=720,height=480'
        ], ["image.dimensions" => "Image dimension must be (720px X 480px)"]);
        try {
            $image = $request->file('image');           
            $imageName = hexdec(uniqid()).$image->getClientOriginalName();
            $lastImage = 'uploads/event/'.$imageName;
            Image::make($image)->resize(720,480)->save('uploads/event/'.$imageName);
            $event = new Event();
            $event->name = $request->name;
            $event->image = $lastImage;
            $event->save();
            return Redirect()->back()->with('success', 'Insertion Successful!');
        } catch (\Exception $e) {
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $eventData = Event::find($id);
        $event = Event::latest()->get();
        return view('pages.admin.event', compact('event', 'eventData'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp|dimensions:width=720,height=480'
        ], ["image.dimensions" => "Image dimension must be (720px X 480px)"]);
        
        try {
            $event = Event::find($id);

            $image = $request->file('image');
            if($image) {
                if(file_exists($event->image) && !empty($event->image)) {
                    unlink($event->image);
                }
                $imageName = hexdec(uniqid()).$image->getClientOriginalName();
                Image::make($image)->resize(720,480)->save('uploads/event/' . $imageName);

                $event['image'] = 'uploads/event/'.$imageName;
            }
            $event->name = $request->name;           
            $event->save();
            return Redirect()->route('admin.event')->with('success', 'Update Successful!');

        } catch (\Exception $e) {
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            if(fileExists($event->image)) {
                unlink($event->image);
            }
            $event->delete();
            return Redirect()->back()->with('success', 'Deleted Successfully!');
        } catch (\Throwable $th) {
            return Redirect()->back()->with('error', 'Deleted Failed!');
        }
        
    }
}
