<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackImage;

use function PHPUnit\Framework\returnSelf;

class BackImageController extends Controller
{
    public function edit()
    {
        $backimage = BackImage::first();
        return view('pages.admin.backimage.content', compact('backimage'));
    }

    // Company profile Update 
    public function update(Request $request, BackImage $backimage)
    {

        $request->validate([
            'bgimage_other' => 'mimes:jpg,jpeg,png,bmp',
            'bgimage_news' => 'mimes:jpg,jpeg,png,bmp',
        ]);
        try {
            $db_exits = BackImage::first();
        $embededImageName = '';
        if($_FILES['bgimage_other']['name']){
            if(file_exists(public_path('/website/assets/image/section-background/'. $db_exits->bgimage_other)))
            {
                unlink(public_path('/website/assets/image/section-background/'. $db_exits->bgimage_other));
            }

            $image = $_FILES['bgimage_other']['name'];
            $arr = explode('.',$image);
            $extension = end($arr);
            $embededImageName = 'EmbeddedImage.'.$extension;
            move_uploaded_file($_FILES['bgimage_other']['tmp_name'], public_path('/website/assets/image/section-background/'.$embededImageName));
        }

        $embededImage2Name = '';
        if($_FILES['bgimage_news']['name']){
            if(file_exists(public_path('/website/assets/image/section-background/'. $db_exits->bgimage_news)))
            {
                unlink(public_path('/website/assets/image/section-background/'. $db_exits->bgimage_news));
            }

            $image = $_FILES['bgimage_news']['name'];
            $arr = explode('.',$image);
            $extension = end($arr);
            $embededImage2Name = '31.'.$extension;
            move_uploaded_file($_FILES['bgimage_news']['tmp_name'], public_path('/website/assets/image/section-background/'.$embededImage2Name));
        }

        $db_exits->bgimage_other = $embededImageName != '' ? $embededImageName : $db_exits->bgimage_other;
        $db_exits->bgimage_news = $embededImage2Name != '' ? $embededImage2Name : $db_exits->bgimage_news;
        $db_exits->save();
        return redirect()->back()->with('success', 'Update Successfull!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Update Failed!');
        }

    }
}
