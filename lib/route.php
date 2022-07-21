<?php
//Định tuyến cho đường dẫn của website

$routes = [];
/*
--Khai báo hàm route định tuyến website
--$path là đường dẫn
--$callback hành động ứng với đường dẫn
*/
function route($path, $callback)
{
    global $routes;
    $routes[$path] = $callback;
}

/*
--Khai báo hàm run
--Hàm này sẽ xác định các đường dẫn ($path) thích hợp để chạy hành động ($callback)
*/
function run()
{
    global $routes;

    //lấy ra đường dẫn hiện tại của website
    $requestURI = parse_url($_SERVER['REQUEST_URI']);
    $uri = $requestURI['path'];

    //khai báo biến xác định có đường dẫn không, nếu không có đường dẫn thì sẽ là false
    // $found = false;
    $action = null;
    //parameter
    $params = [];
    foreach ($routes as $path => $callback) {
        $params = [];
        if ($path === $uri) {
            $action = $callback;
        } elseif (strpos($path, '{')) {
            if (strpos($path, '}')) {
                $pathDefined = explode('/', trim($path, '/'));
                $pathUri = explode('/', trim($uri, '/'));

                //So sánh độ dai của 2 mảng nếu == nhau thì sẽ làm tiếp
                if (count($pathDefined) === count($pathUri)) {
                    //duyệt qua từng phần tử mảng của path được định nghĩa để so sanh với path URI => lây params
                    foreach ($pathDefined as $k => $p) { //$k:key $p:path
                        if ($p === $pathUri[$k]) {
                            $action = $callback;
                            continue;
                        }
                        if (preg_match('/^{\w+}$/', $p)) {
                            $params[] = $pathUri[$k];
                        }
                    }
                }
            }
        }
    }

    if (!$action) {
        $fileNotFound = $routes['/404'];
        return $fileNotFound();
    }
    if (is_callable($action)) {
        return call_user_func_array($action, $params);
    }
}
