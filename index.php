<?php

$controller = $_GET['controller'] ?? 'login';
$action = $_GET['action'] ?? 'exibir';
$id = $_GET['id'] ?? null;

try {
    $controllerFile = "controllers/" . ucfirst($controller) . "Controller.php";
    if (!file_exists($controllerFile)) {
        throw new Exception("Controller não encontrado: " . $controller);
    }
    require_once $controllerFile;

    $controllerName = ucfirst($controller) . "Controller";
    if (!class_exists($controllerName)) {
        throw new Exception("Classe do controller não encontrada: " . $controllerName);
    }

    $controllerObj = new $controllerName();
    if ($id !== null) {
        $controllerObj->$action($id);
    } else {
        $controllerObj->$action();
    }

} catch (Exception $e) {
    echo "<h1>Erro</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    error_log($e->getMessage());
}

?>
