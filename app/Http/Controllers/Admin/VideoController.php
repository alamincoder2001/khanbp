<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index() {
        $video = Video::latest()->get();
        return view('pages.admin.video.index', compact('video'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'min:2|max:100',
            'link' => 'required|min:4',
        ]);
        try {
            // https://www.youtube.com/embed/Zv11L-ZfrSg
            $video = new Video;
            $video->name = $request->name;
            $video->link = $request->link;
            $video->save();
            return redirect()->back()->with('success', 'Video Inserted!');
        } catch (\Exception $e) {
		    // return ["error" => $e->getMessage()];
            return Redirect()->back()->with('error', 'Insertion failed!');
        }
    }
    public function edit($id) {
        $video = Video::find($id);
        return view('pages.admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'min:2|max:100',
            'link' => 'required|min:4',
        ]);

        try {            
            $video = Video::find($id);
            $video->name = $request->name;
            $video->link = $request->link;
            $video->save();
            return Redirect()->back()->with("success", "Update Successfull");
        } catch(\Exception $e) {
		    // return ["error" => $e->getMessage()];
            return redirect()->back()->with('error', 'Video insert failed!');
        }
    }
    public function delete($id) {
        $video = Video::find($id);
        $video->delete();
        return Redirect()->back()->with("success", "Deleted Successfully");
    }
}
