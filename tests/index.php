<?php
class MyAwesomeClass extends Exception {

    private $myawesomefield;

    /**
     * @var bool My public awesome static field!
     */
    public static $publicstaticfield = true;

    public final function check2()
    {

    }

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {

    }

    /**
     * @return bool My awesome boolean value!
     */
    public static function check()
    {
        return false;
    }

}