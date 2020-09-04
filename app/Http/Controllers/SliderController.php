<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function addSlide(){
        return view('admin.slider.slide-add-form');
    }


    public function uploadSlide(Request $request){
        $this->validate($request,[
            'slide_image' => 'required',
            'slide_title' => 'required',
            'slide_description' => 'required',
            'status' => 'required'
        ]);

        $data = new Slide();

        $data->slide_image = $this->slideImage($request);
        $data->slide_title = $request->slide_title;
        $data->slide_description = $request->slide_description;
        $data->status = $request->status;
        $data->save();
        return back()->with('msg','New Slide Created Successfully');
    }

    protected function slideImage($request){
        
        $file = $request->file('slide_image');
        $iamgeName = $file->getClientOriginalName();
        $directory = 'admin/assets/slider/';
        $imageUrl = $directory.$iamgeName;
        // $file->move($directory,$imageUrl);

        Image::make($file)->resize(1400, 570)->save($imageUrl);

        return $imageUrl;

    }


    public function manageSlide(){
        $slides = Slide::all();

        return view('admin.slider.manage-slide',compact('slides'));
    }

    public function slideUnpublished($id){
        $slide = Slide::find($id);
        $slide->status = 2;
        $slide->save();
        return redirect('/manage-slide')->with('error','Slide Unpublished Successfully');
    }

    public function slidePublished($id){
        $slide = Slide::find($id);
        $slide->status = 1;
        $slide->save();
        return redirect('/manage-slide')->with('msg','Slide Published Successfully');
    }

    public function photoGallery(){
        $slide = Slide::all();

        return view('admin.slider.photo-gallery',compact('slide'));
    }

    public function sliderEdit($id){
        $slide = Slide::find($id);

        return view('admin.slider.slide-edit',compact('slide'));
    }


    public function updateSlide(Request $request){
        //return $request->all();
        $slide = Slide::find($request->slider_id);
        $slide->slide_title = $request->slide_title;
        $slide->slide_description = $request->slide_description;
        $slide->status = $request->status;
        if($request->file('slide_image')){
            unlink($slide->slide_image);
            $slide->slide_image = $this->slideImage($request);
        }
        $slide->save();
        return redirect('/manage-slide')->with('msg','Slide Updated Successfully');

    }


    public function slideDelete($id){
        $slide = Slide::find($id);
        unlink($slide->slide_image);
        $slide->delete();
        return redirect('/manage-slide')->with('msg','Slide delete Successfully');
    }
}
