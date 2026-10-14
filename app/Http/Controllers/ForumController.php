<?php

namespace App\Http\Controllers;

use App\Models\ForumKomentar;
use App\Models\ForumTopic;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $topics = ForumTopic::with(['user', 'comments'])->orderBy('updated_at', 'desc')->get();

        return view('forum.index', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_topic' => 'required|string|max:255',
            'isi_konten' => 'required|string',
        ]);

        ForumTopic::create([
            'users_id' => auth()->user()->users_id,
            'judul_topic' => $request->judul_topic,
            'isi_konten' => $request->isi_konten,
        ]);

        return redirect()->route('forum.index')->with('success', 'Topik berhasil dibuat!');
    }

    public function show($id)
    {
        $topic = ForumTopic::with(['user', 'comments.user'])->findOrFail($id);

        return view('forum.show', compact('topic'));
    }

    public function storeKomentar(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required|string',
        ]);

        $topic = ForumTopic::findOrFail($id);
        if ($topic->is_locked) {
            return redirect()->back()->with('error', 'Topik ini sudah dikunci.');
        }

        ForumKomentar::create([
            'topic_id' => $id,
            'users_id' => auth()->user()->users_id,
            'isi_komentar' => $request->isi_komentar,
        ]);

        $topic->updated_at = now();
        $topic->save();

        return redirect()->route('forum.show', $id)->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $topic = ForumTopic::findOrFail($id);

        if ($topic->users_id != auth()->user()->users_id) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah topik ini.');
        }

        $request->validate([
            'isi_konten_edit' => 'required|string',
        ]);

        $topic->update([
            'isi_konten' => $request->isi_konten_edit,
        ]);

        return redirect()->route('forum.show', $id)->with('success', 'Topik berhasil diubah.');
    }
}
