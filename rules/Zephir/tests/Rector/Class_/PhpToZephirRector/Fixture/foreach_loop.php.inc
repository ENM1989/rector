<?php

class SomeClass
{
    public function run()
    {
        $items = [1, 2, 3];
        foreach ($items as $item) {
            echo $item;
        }
    }
}
-----
namespace App;

class SomeClass
{
    public function run()
    {
        let items = [1, 2, 3];
        for item in items {
            echo item;
        }
    }
}
