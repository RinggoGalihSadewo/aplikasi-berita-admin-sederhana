<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;
use App\Models\Category;

class BeritaController extends Controller
{
    public function index()
    {
        $datas = Content::with('category')->get();

        return view('index', compact('datas'));
    }

    public function categoryView()
    {
        $datas = Category::all();
        return view('category', compact('datas'));
    }

    public function createCategory(Request $request)
    {
        Category::create([
            'category' => $request->category
        ]);

        return redirect('/category');
    }

    public function createView()
    {
        $datas = Category::all();
        return view('create', compact('datas'));
    }

    public function create(Request $request)
    {
        $nameImage = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs(('/public'), $nameImage);
        
        $content = new Content;

        $content->title = $request->title;
        $content->category_id = $request->category;
        $content->slug = \Str::slug($request->title);
        $content->content = $request->content;
        $content->image = $nameImage;

        $content->save();

        return redirect('/');
    }

    public function show($slug)
    {
        $data = Content::where('slug', $slug)->get();
        return view('detail', compact('data'));
    }

    public function editView($id)
    {
        $data = Content::find($id);
        $category = Category::all();
        return view('edit', compact('data','category'));
    }

    public function edit(Request $request)
    {

        $nameImage = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs(('/public'), $nameImage);

        Content::where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image' => $nameImage,
                    'slug' => \Str::slug($request->title),
                    'category_id' => $request->category
                ]);
        
        return redirect('/');
    }

    public function destroy($id)
    {
        Content::destroy($id);
        return redirect('/');
    }
}
