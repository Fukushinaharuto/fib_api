<?php

namespace App\Http\Controllers;


use App\Http\Requests\FibonacciRequest;
use App\Models\Fibonacci;

class FibonacciController extends Controller
{
    public function index(FibonacciRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $n = $validatedData['n'];

            $result = Fibonacci::result($n);

            // フィボナッチ数列のn列目をjson形式で返している。
            // string型で返している。
            return response()->json(['result' => gmp_strval($result)], 200);
        } catch (\Exception $error) {
            // エラーが起きた時に返している。
            return response()->json(['message' => 'Bad request','error' => $error->getMessage()], 400);
        }
    }
}
