<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
//Actionが実行されるとインスタンス化されてTodoControllerにきた。
class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $instanceClass)//(useクラスのインスタンス ただの変数)
    {
        $this->middleware('auth');//認証チェック(authユーザー認証)
        $this->todo = $instanceClass;//Modelを継承したtodoクラスのインスタンス(Todo.php)
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id());
        // dd($this->todo);
        // dd(['todos' => $todos], compact('todos'));
        // return view('todo.index', ['todos' => $todos]);
        return view('todo.index', compact('todos'));
        // collectionがラッピングしている。
        // compact関数は引数に指定した文字列を配列のkey名にする。でその引数に指定した文字列と一致する変数名の中身をvalueとする。
        // https://qiita.com/kyogokutaro/items/12a95ef20af90d892105
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');//todoディレクトリの下のcreateファイル
        //引数にテンプレート指定するとそれがレンダリングされて返されブラウザに表示される。
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        // dd($this->todo->fill($input)->save());
        // dd($this->todo->fill($input));
        $this->todo->fill($input)->save();//fillメソッドはfillableの値を参照する。
        // dd(redirect()->to('todo'));
        return redirect()->to('todo.index');//←Controllerで特定のページへリダイレクトさせたいときに使用//引数なしの場合、redirectインスタンス
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($this->todo);
        $todo = $this->todo->find($id);
        // dd($todo = $this->todo->find($id));
        // dd($todo, compact('todo'));
        return view('todo.edit', compact('todo'));//Blade記法
        // 'todo' => $todo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->todo->find($id)->fill($input)->save();
        return redirect()->to('todo.index');//←なぜGETでtodoにリダイレクトされるのか？aタグがGET methodだから。
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//destroy関数に引数で$IDが入り
    {
        $this->todo->find($id)->delete();
        return redirect()->to('todo.index');
    }
}
