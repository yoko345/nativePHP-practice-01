<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        return view("memo.index");
    }

    public function list()
    {
        return Memo::query()
            ->orderBy("id", "desc")
            ->get();
    }

    public function save(Request $request)
    {
        $memo = Memo::findOrNew($request->id);
        $memo->title = $request->title;
        $memo->body = $request->body;
        $result = $memo->save();
        return ["result" => $result];
    }

    public function destroy(Memo $memo)
    {
        $result = $memo->delete();
        return ["result" => $result];
    }
}
