<?php

namespace App;

use Routes\Route;

use function PHPSTORM_META\argumentsSet;

class Request
{
    protected $service;
    protected $requestMethod;
    protected $params;
    private $data;
    private $firtsLevel;

    public function __construct()
    {

        $this->requestMethod = requestMethod();
        $route = requestUri();
        $patern = '(\/[a-zA-Z-._]+\/)(\w+)';

        $id = preg_replace("/$patern/i", '$2', $route);
        $route = preg_replace("/$patern/i", '$1anything', $route);
        
        switch ($this->requestMethod) {
            case 'POST':
                $this->params = [
                    $this
                ];
                break;
            case 'PUT':
                $this->params = [
                    $this,
                    $id
                ];
                break;
            case 'GET':
            case 'DELETE':
                $this->params = [
                    $id
                ];
                break;

            default:

                break;
        }
        $this->service = $route;
        $this->loadExternalData();
    }

    public function send()
    {
        try {
            if (!isset(Route::$map[$this->requestMethod][$this->service])) {
                throw new \Exception("Página no encontrada");
            }
            $class = Route::$map[$this->requestMethod][$this->service]['controller'];
            $method = Route::$map[$this->requestMethod][$this->service]['method'];

            if (class_exists($class)) {
                $class = new $class;

                if (method_exists($class, $method)) {
                    $response = $class->{$method}(...$this->params);

                    if ($response instanceof Response) {
                        $response->send();
                    }
                }
            }
        } catch (\Exception $e) {
            $response = view('404');
            $response->send();
        }
    }

    public function loadExternalData(array $data = [])
    {
        $formData = array();
        if (isset($_SERVER['argv'])) {

            if (!empty($_SERVER['argv'])) {
                $array = array();
                foreach ($_SERVER['argv'] as $key_Val) {
                    $key_Val = explode(':', $key_Val);
                    if (!isset($key_Val[1])) continue;
                    $key = $key_Val[0];
                    $val = $key_Val[1];
                    $array[$key] = $val;
                }
                $_SERVER['argv'] = $array;
            }

            $formData[] = $_SERVER['argv'];
        }

        if (!empty($_POST)) {
            $formData[] = $_POST;
        }

        if (!empty($_GET)) {
            $formData[] = $_GET;
        }

        if (!empty($data = @file_get_contents('php://input'))) {
            if ($data = json_decode($data)) {
                $formData[] = $data;
            }
        } {
        }

        $this->data = (object) $formData;
        $this->firtsLevel = (object) ($formData[0] ?? []);
    }

    public function all()
    {
        return $this->firtsLevel;
    }
    public function getData()
    {
        return $this->data;
    }

    public function validate(array $rulesByfield)
    {
        foreach ($rulesByfield as $field => $rules) {
            $rules = explode('|', $rules);
            $value = $this->firtsLevel->{$field} ?? null;

            foreach ($rules as $rule) {

                if ($rule == 'required') {
                    if (!isset($this->firtsLevel->{$field})) {
                        throw new \Exception("El campo $field es obligatorio");
                    }
                }

                if (preg_match('/max:|min:/', $rule)) {

                    list($rule, $lentgh) = explode(':', $rule);

                    $response = call_user_func(
                        "{$rule}String",
                        $value,
                        $lentgh
                    );

                    if ($response) {
                        throw new \Exception("El campo $field no tiene la longitud permitida $rule $lentgh");
                    }
                }

                if (preg_match('/regex/', $rule)) {

                    list($rule, $pattern) = explode(':', $rule);

                    $response = preg_match("/$pattern/i", $value);

                    if (!$response) {
                        throw new \Exception("El campo $field se encuentrá mal diligenciado");
                    }
                }
                if ($rule == 'email') {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        throw new \Exception("El campo $field se encuentrá mal diligenciado, No es un correo válido, ejemplo email@mail.com");
                    }
                }
                if ($rule == 'phone') {
                    $pattern = "^\+\d{9}$";
                    $response = preg_match("/$pattern/i", $value);

                    if (!$response) {
                        throw new \Exception("El campo $field se encuentrá mal diligenciado, 
                        solo se admiten 9 dígitos sin espacios ni caracteres especiales, solo el caracter (+) que debe estar al Inicio");
                    }
                }
                if ($rule == 'password') {

                    $pattern = "^(?=.*[A-Z])(?=.*[\*\-\.])(.{6})$";
                    $response = preg_match("/$pattern/i", $value);

                    if (!$response) {
                        throw new \Exception("El campo $field Debe ser de 6 Caracteres, tener por lo menos una Mayuscula y alguno de estos caracteres <b>'*'  '-'  '.'</b>");
                    }
                }
            }
        }
    }
}
