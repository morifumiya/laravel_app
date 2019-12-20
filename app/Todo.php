<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'user_id'];

    public function getByUserId($id)
    {
        // dd($this->where('user_id', $id)->get());
        return $this->where('user_id', $id)->get();
        //返り値はCollectionクラス(中身はModelのオブジェクト)
    }
}

// ・$fillableに値を定義しているのはなぜですか？
// $fillableの値と配列のキー名が一致していないと取得できないから。
// 一致するとattributeに登録される値が入る。

//titleはclass Todoの(複数形:)Todosテーブルのカラムのこと。
//ModelはDBのデータを取得する。そのデータ（テーブル）はmigrationからDBに作成される。

//protected このクラスと継承クラスからアクセス可
//where 返り値 $this
// (カラム名, 比較演算子, 比較する値)
