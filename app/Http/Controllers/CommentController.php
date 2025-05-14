<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class CommentController extends Controller
{
    public function store(Request $request, $forumId)
    {
        $request->validate([
            'komentar' => 'required|string',
        ]);

        $token = JWTAuth::getToken() ?? session('jwt_token');
    $user = JWTAuth::setToken($token)->authenticate();

        Comment::create([
            'forum_id' => $forumId,
            'user_id' => $user->id,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('message', 'Komentar berhasil ditambahkan.');
    }
}
