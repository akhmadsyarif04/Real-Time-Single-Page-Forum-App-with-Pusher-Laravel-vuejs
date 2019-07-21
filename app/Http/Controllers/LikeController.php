<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;

use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]); // default
        // $this->middleware('auth:api', ['except' => ['login', 'signup']]);
        $this->middleware('JWT');  // middleware buatan baru,
        // selain dari pada didlm except tidak bisa digunakan function nya harus pake token JWT
        // yang di except bisa diakses tanpa token

    }

    public function likeIt(Reply $reply) {
      $reply->like()->create([
          'user_id' => auth()->id()
          // 'user_id' => '1'
      ]);
    }

    public function unLikeIt(Reply $reply) {
      $reply->like()->where('user_id', auth()->id())->first()->delete();
      // $reply->like()->where('user_id', '1')->first()->delete();

    }
}
