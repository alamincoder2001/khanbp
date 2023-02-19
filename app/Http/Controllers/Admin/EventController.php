<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use PHPUnit\Framework\Constraint\FileExists;

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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp'
        ]);
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
            // throw $e;
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
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp'
        ]);
        
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
            // throw $e
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
            // throw $th;
            return Redirect()->back()->with('error', 'Deleted Failed!');
        }
        
    }
}
