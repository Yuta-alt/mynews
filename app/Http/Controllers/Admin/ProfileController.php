<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profiles;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
    
    // public function create()
    // {
    //     return redirect('admin/profile/create');
    // }
    
    // PHP課題16_1
    public function create(Request $request)
  {
      // Varidationを行う
      $this->validate($request, Profiles::$rules);
      $news = new Profiles;
      $form = $request->all();

      // formに画像があれば、保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }

      unset($form['_token']);
      unset($form['image']);
      // データベースに保存する
      $news->fill($form);
      $news->save();

      return redirect('admin/profile/create');
  }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
    //

  // 以下を追記
//   public function index(Request $request)
//   {
//       $cond_title = $request->cond_title;
//       if ($cond_title != '') {
//           // 検索されたら検索結果を取得する
//           $posts = Profiles::where('title', $cond_title)->get();
//       } else {
//           // それ以外はすべてのニュースを取得する
//           $posts = Profiles::all();
//       }
//       return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
//   }
}
