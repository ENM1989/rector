<?php

class SomeClass
{
    public function run()
    {
        $i = 0;
        while ($i < 10) {
            $i++;
        }
    }
}
-----
namespace App;

class SomeClass
{
    public function run()
    {
        let i = 0;
        while i < 10 {
            i++;
        }
    }
}
