<?php

namespace App;

class SomeClass
{
    public function run()
    {
        $a = 1;
        $b = "hello";
    }
}
?>
-----
<?php

namespace App;

class SomeClass
{
    public function run()
    {
        let a = 1;
        let b = "hello";
    }
}
?>
