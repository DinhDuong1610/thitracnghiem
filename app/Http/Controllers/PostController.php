<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        $categories = Categories::all();

        return view('posts.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'fileExam' => 'mimes:pdf'
        ]);

        $total = $request['_total'];
        $result = array();
        for($i=1; $i<=$total; $i++) {
            $result[$i] = $request['check-'.$i];
        }

        if($request->hasFile('fileExam')){

            $file_name = $this->convert_string($request->title).'.'.$request->file('fileExam')->getClientOriginalExtension();
        
            $request->file('fileExam')->move(public_path('files_upload'), $file_name);
            $path = 'files_upload/'.$file_name;

            $post = new Post();

            $post->title = $request->title;
            $post->path_file = $path;
            $post->result = json_encode($result);
            $post->time = $request->time;
            $post->total = $total;
            $post->cat_id = $request->category;
            $post->user_id = Auth::user()->id;
            // $post->user_id = \Auth::user()->id;

            $post->save();


            return redirect()->route('posts.show', ['id' => $post->id]);

        } else {
            return 'Lỗi';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);

        $cat = $post->categories;

        $results = json_decode($post->result, true);

        $userExams = Auth::user()->id;

        return view('posts.show')->with(['post'=> $post, 'results'=> $results, 'cat' => $cat, 'userExams' => $userExams]);
    }

    private function to_utf8($in)
    {
        if (is_array($in)) {
            foreach ($in as $key => $value) {
                $out[to_utf8($key)] = to_utf8($value);
            }
        } elseif(is_string($in)) {
            if(mb_detect_encoding($in) != "UTF-8")
                return utf8_encode($in);
            else
                return $in;
        } else {
            return $in;
        }
        return $out;
    }

    private function convert_string($str)
    {
        $str = $this->to_utf8($str);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        $str = strtolower($str);
        $str = str_replace(' ','-',$str);

        return $str;
    }
}
