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
            if ($n == 1 || $n == 2) {
                return response()->json(['result' => 1], 200);
            }
            $beforeFirst = gmp_init(1);
            $beforeSecond = gmp_init(1);
            $result = gmp_init(0);
            for ($i = 1; $i < $n-1; $i++) {
                $result = gmp_add($beforeFirst, $beforeSecond);
                $beforeFirst = $beforeSecond;
                $beforeSecond = $result;
            }
            return response()->json(['result' => gmp_strval($result)], 200);
        } catch (\Exception $error) {
            return response()->json(['message' => '予期せぬエラーが発生しました。','error' => $error->getMessage()], 400);
        }
    }
}
