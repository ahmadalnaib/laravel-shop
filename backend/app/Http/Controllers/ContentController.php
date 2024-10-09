<?php
namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show($page)
    {
        $content = Content::where('page', $page)->first();
        return response()->json($content);
    }
    
    public function update(Request $request, $page)
    {
        $data = $request->only(['content', 'background_color', 'text_color']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $content = Content::updateOrCreate(
            ['page' => $page],
            $data
        );

        return response()->json($content);
    }
    
    public function edit($page)
    {
        $content = Content::where('page', $page)->first();

        if (!$content) {
            $content = new Content(['page' => $page]);
        }
        return view('admin.edit', compact('content', 'page'));
    }
    public function save(Request $request, $page)
    {
        $data = $request->only(['content', 'background_color', 'text_color']);

        if ($page === 'contact') {
            $data = array_merge($data, $request->only(['phone', 'email', 'address']));
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $content = Content::updateOrCreate(
            ['page' => $page],
            $data
        );

        return redirect()->route('admin.dashboard')->with('success', 'Content updated successfully');
    }
    
    public function showContactPage()
    {
        $page = 'contact';
        $content = Content::where('page', $page)->first();
        return view('admin.contact', compact('content', 'page'));
    }

}