<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examresults = User::find( Auth::user()->id )->examresults()->paginate(10);
        $posts = new Post();

        return view('er.index')->with(['examresults' => $examresults, 'posts' => $posts]);
    }


    public function store(Request $request)
    {

        $result = new ExamResult();
        $result->point = $request->point;
        $result->time = $request->time;
        $result->user_id = $request->user_id;
        $result->post_id = $request->post_id;

        $result->save();

        return "succeed";
    }


    public function userscore()
    {
        $users = User::all();
        $userscores = array();
        foreach ($users as $user) {
            $get = (new ExamResult())->where('user_id', $user->id)->orderBy('point', 'desc')->limit(1)->get();
            if(count($get)>0) {
                array_push($userscores, $get);
            }
        }

        return view('er.userscore')->with(["userscores" => $userscores, "users" => $users]);
    }
}
