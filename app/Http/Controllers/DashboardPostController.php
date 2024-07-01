<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 300);
ini_set('memory_limit', '256M');

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function formTopup(Request $request, Post $post)
    {
        $request->validate([
            'email' => 'required|email',
            "name_game" => "required",
            'no_tlp' => 'required|numeric|min:12',
            'nama' => 'required|string',
            'topupOption' => 'required|string',
        ]);

        $payment = new Payments();
        $payment->email = $request->email;
        $payment->name_game = $request->name_game;
        $payment->no_tlp = $request->no_tlp;
        $payment->name = $request->nama;
        $payment->username = Auth::user()->username;
        $payment->option = $request->topupOption;

        session(['payment_data' => $payment, 'post_id' => $post->id]);

        return redirect()->route('invoice');
    }

    public function invoice()
    {
        $payment = session('payment_data');
        $post_id = session('post_id');

        if (!$payment) {
            return redirect()->route('post.topup', ['post' => $post_id]);
        }

        return view('dashboard.post.invoice', compact('payment', 'post_id'), [
            'title' => 'Invoice',
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $payment = session('payment_data');
        $post_id = session('post_id');

        if (!$payment) {
            return redirect()->route('post.topup', ['post' => $post_id]);
        }

        $payment->save();

        $pdf = PDF::loadView('dashboard.post.pdf', compact('payment'));
        session()->forget(['payment_data', 'post_id']);

        session()->flash('success', 'Pembayaran berhasil dikonfirmasi. Invoice telah diunduh.');

        return $pdf->download('invoice.pdf', [
            'Refresh' => '5;url=' . route('post.topup', ['post' => $post_id])
        ])->withHeaders([
            'X-Success-Message' => 'Pembayaran berhasil dikonfirmasi. Invoice telah diunduh.'
        ]);
    }
}
