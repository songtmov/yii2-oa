<?php
// class MyClass
// {
//     const constant = 'constant value';

//     function showConstant() {
//         echo self::constant . "\n";
//     }
// }

// echo MyClass::constant . "\n";
// echo "<br/>";

// $classname = "MyClass";
// echo $classname::constant . "\n"; // 自 5.3.0 起
// echo "<br/>";

// $class = new MyClass();
// $class->showConstant();
// echo "<br/>";
// echo $class::constant."\n"; // 自 PHP 5.3.0 起
// echo "<br/>";

// spl_autoload_register(function ($name) {
//     var_dump($name);
// });

// class Foo implements ITest {

// }


// spl_autoload_register(function ($name) {
//     echo "Want to load $name.\n";
//     throw new Exception("Unable to load $name.");
// });

// try {
//     $obj = new ClassName();
// } catch (Exception $e) {
//     echo $e->getMessage(), "\n";
// }

// class One
// {
	
// 	function __construct()
// 	{
// 		echo "One";
// 	}
// }

// class ClassName extends One
// {
// 	function __construct()
// 	{
// 		echo "ClassName";
// 	}

// 	function call(){
// 		parent::__construct();
// 	}
// }

// $new = new ClassName;
// echo "<br/>";
// $new -> call();

// class MyDestructableClass {
//    function __construct() {
//        print "In constructor\n";
//        $this->name = "MyDestructableClass";
//    }

//    function __destruct() {
//        print "Destroying " . $this->name . "\n";
//    }
// }

// $obj = new MyDestructableClass();


class MyClass
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

class MyClass2 extends MyClass
{
    function __construct()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

// $obj2 = new MyClass2();
// echo $obj2->public; // 这行能被正常执行
// echo $obj2->private; // 未定义 private
// echo $obj2->protected; // 这行会产生一个致命错误
// $obj2->printHello(); // 输出 Public、Protected2 和 Undefined


$obj = new MyClass2;
// $obj->printHello();

