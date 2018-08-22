<?php
class MyAwesomeClass extends Exception {

    public final function check2()
    {

    }

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return bool Mon super booléen
     */
    public static function check()
    {
        return false;
    }

}