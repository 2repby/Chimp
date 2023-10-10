<?php
namespace Framework;
class Container
{
    public function __construct()
    {
        $this->connection = DbConnection::getConnection();
    }

    public static function getApp(): Application
    {
        return new Application(self::getRouter());
    }


    public static function getRouter(): Router
    {
        return new Router(self::getRequest());
    }


    public static function getRequest(): Request
    {
        return new Request();
    }


}