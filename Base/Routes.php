<?php

namespace Base;

class Routes
{
    public function start()
    {
        $route = 'Index';
        $action = 'index';
        $param = '';
        $request = trim($_SERVER['REQUEST_URI'], '/');
        $parts = explode('/', $request);

        if (isset($parts[0]) && $this->_validate($parts[0])) {
            $route = ucfirst(strtolower($parts[0]));
        }
        if (isset($parts[1]) && $this->_validate($parts[1])) {
            $action = strtolower($parts[1]);
        }
        if (isset($parts[2]) && $this->_validate($parts[2])) {
            $param = strtolower($parts[2]);
        }

        $this->_action($route, $action, $param);
    }

    private function _action(string $controllerName, string $actionName, $param = '')
    {
        $controllerName = '\App\Controller\\' . $controllerName . '_Controller';
        if (!class_exists($controllerName)) {
            throw new \Exception();
        }
        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action($param);
        }
    }

    private function _validate($urlPart)
    {
        return (bool)preg_match('/^[a-zA-Z0-9]+$/', $urlPart);
    }
}