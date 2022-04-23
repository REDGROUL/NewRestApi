<?

namespace App;

use App\Controller\NotFound_controller;

class Router
{
    private $handlers;
    const POST = "POST";
    const GET = "GET";

    public function get($path, $callback)
    {
        $this->addHandler(self::GET, $path, $callback);
    }

    private function addHandler($method, $path, $callback)
    {
        $this->handlers[$method.':'.$path] = [
            "method"=>$method,
            "path"=>$path,
            "handler"=>$callback
        ];
    }

    public function post($path, $callback)
    {
        $this->addHandler(self::POST, $path, $callback);
    }

    public function start()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];
        $handlers = $this->handlers;

        foreach ($handlers as $handler)
        {
            if($handler['method'] == $method && $handler['path'] == $url)
            {
                $callback = $handler['handler'];
            }
        }
        if(!$callback)
        {
            header('Location: /404/');
        }
        else
        {
            call_user_func_array($callback,[
                array_merge($_GET, $_POST)
            ]);
        }

    }
}