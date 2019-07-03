<?php


namespace app\components\exceptions;


use yii\web\HttpException;

class HttpNotAllowedException extends HttpException
{
    public function __construct( $message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(403, $message, $code, $previous);
    }
}