<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fibonacci extends Model
{
    public static function result($n)
    {
        // nが1or2なら、1を返す。
        if ($n == 1 || $n == 2) {
            return 1;
        }
        // 一つ前の数字
        $previousNumber = gmp_init(1);
        // 現在の数字
        $currentNumber = gmp_init(1);
        // レスポンスに返す予定の値
        $result = gmp_init(0);
        // n-1回ループして一つずつフィボナッチ数列が作成されて、指定のループ回数の時のresultをレスポンスに返す。
        for ($i = 1; $i < $n-1; $i++) {
            $result = gmp_add($previousNumber, $currentNumber);
            $previousNumber = $currentNumber;
            $currentNumber = $result;
        }

        return gmp_strval($result);
    }
}
