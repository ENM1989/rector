<?php

class SomeClass
{
    public function run($a)
    {
        if ($a > 1) {
            $b = 1;
        } elseif ($a < 0) {
            $b = 2;
        } else {
            $b = 3;
        }
    }
}
-----
namespace App;

class SomeClass
{
    public function run(a)
    {
        if a > 1 {
            let b = 1;
        } elseif a < 0 {
            let b = 2;
        } else {
            let b = 3;
        }
    }
}
