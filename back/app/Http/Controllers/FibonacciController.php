<?php

namespace App\Http\Controllers;


use App\Http\Requests\FibonacciRequest;

class FibonacciController extends Controller
{
    public function index(FibonacciRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $n = $validatedData['n'];
            // nが１か2なら1を返す。
            if ($n == 1 || $n == 2) {
                return response()->json(['result' => 1], 200);
            }
            // integerのままだと、オーバフローしてしまうのでGMPを使用。
            // previousNumber変数と$currentNumber変数の初期値を1
            $previousNumber = gmp_init(1);
            $currentNumber = gmp_init(1);
            // result変数の初期値を0
            $result = gmp_init(0);
            // 一つ前の数字と現在の数字の合計をresult変数に代入
            // 現在の数字を一つ前の数字と入れ替えて、現在の数字を合計値と入れ替えている。
            for ($i = 1; $i < $n-1; $i++) {
                $result = gmp_add($previousNumber, $currentNumber);
                $previousNumber = $currentNumber;
                $currentNumber = $result;
            }
            // フィボナッチ数列のn列目をjson形式で返している。
            // string型で返している。
            return response()->json(['result' => gmp_strval($result)], 200);
        } catch (\Exception $error) {
            // エラーが起きた時に返している。
            return response()->json(['message' => 'Bad request','error' => $error->getMessage()], 400);
        }
    }
}
