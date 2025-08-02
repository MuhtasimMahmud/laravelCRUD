<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function create(){
        return view('create');
    }

    public function ourFileStore(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'image' => 'nullable|mimes:jpeg,png',
        ]);

        // upload image
        $imageName = null;
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        // Add new post
        $post = new Post();

        $post->name = $request->name;
        $post->contact = $request->contact;
        $post->image = $imageName;

        $post->save();

        flash()->success("Contact has been created!");

        return redirect()->route('home');
    }


    public function editData($id){
        $post = Post::findOrFail($id);

        return view('edit', ['ourPost' => $post]);
    }

    public function updateData($id, Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'image' => 'nullable|mimes:jpeg,png',
        ]);


        // update post
        $post = Post::findOrFail($id);
        $post->name = $request->name;
        $post->contact = $request->contact;


        // image
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        flash()->success("Contact has been updated!");


        return redirect()->route('home');
    }

    public function deleteData($id){
        $post = Post::findOrFail($id);

        $post->delete();

        flash()->success("Contact has been deleted");

        return redirect()->route('home');

    }


}
