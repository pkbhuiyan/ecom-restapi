<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



trait ExceptionTrait{
    public function apiException($request, $e)
    {
        if($this->isModel($e)){
            return $this->ModelResponse();
        }

        if($this->isHttpRoute($e)){
            return $this->HttpRouteResponse();
        }

        return parent::render($request, $e);
    }

    private function isModel($e)
    {
        return  $e instanceof ModelNotFoundException;
    }

    private function isHttpRoute($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    private function ModelResponse()
    {
        return response([
            "errors" => "Product model not found"
        ],Response::HTTP_NOT_FOUND);
    }

    private function HttpRouteResponse()
    {
        return response([
            "errors" => "Incorrect Route"
        ],Response::HTTP_NOT_FOUND);
    }
}