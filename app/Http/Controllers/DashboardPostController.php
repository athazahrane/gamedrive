<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Payments;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.post.index', compact('posts'), [
            'title' => 'Jasa Kami',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create', [
            'title' => 'Tambah Jasa',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4|max:255',
            'description' => 'required|min:5|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenisTopUp' => 'required|array',
            'jenisTopUp.*' => 'required|string',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/jasa', 'public');
        }

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $imagePath;
        $post->jenisTopUp = $request->jenisTopUp;
        $post->price = $request->price;
        $post->save();

        return redirect()->route('post.index')->with('successCreateData', 'Data jasa topup game berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.post.edit', compact('post'), [
            'title' => 'Edit Data',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenisTopUp' => 'required|array',
            'jenisTopUp.*' => 'required|string',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $imagePath = $request->file('image')->store('images/jasa', 'public');
        } else {
            $imagePath = $post->image;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'jenisTopUp' => $request->jenisTopUp,
            'price' => $request->price,
        ]);

        return redirect()->route('post.index')->with('successUpdateData', 'Data jasa topup game berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        Post::destroy($post->id);

        return redirect()->route('post.index')->with('success', 'Data jasa topup game berhasil dihapus');
    }

    public function topup(Post $post)
    {
        return view('dashboard.post.topup', compact('post'), [
            'title' => 'Topup ' . $post->title,
        ]);
    }

    public function formTopup(Request $request)
    {
        $request->validate([
            'email' => 'email:dns|required',
            'no_tlp' => 'numeric|min:12|required',
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'option' => 'required'
        ]);

        $payment = new Payments();
        $payment->email = $request->email;
        $payment->no_tlp = $request->no_tlp;
        $payment->name = $request->name;
        $payment->username = $request->username;
        $payment->option = $request->option;
        $payment->save();

        return view('dashboard.post.invoice', ['payment' => $payment]);
    }

    public function invoice()
    {
        return view('dashboard.post.invoice', [
            'title' => 'Invoice',
        ]);
    }
}
