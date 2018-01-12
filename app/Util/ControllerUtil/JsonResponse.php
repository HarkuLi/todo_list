<?php
namespace Harku\TodoList\Util\ControllerUtil;

class JsonResponse
{
    /**
     * @param iterable $res an associative array, it will be converted to json
     * @param integer $statusCode http status code, default value is 200(success)
     * @return void
     */
    public static function plain(iterable $res, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header("Content-Type: application/json");
        echo json_encode($res);
    }

    /**
     * Generate a json response for lost required parameters
     *
     * @param iterable $paramList list of lost parameter names, e.g. ["param1", "param2", ...]
     * @return void
     */
    public static function lostRequiredParams(iterable $paramList): void
    {
        $paramNames = "";
        foreach ($paramList as $idx => $name) {
            if ($idx !== 0) {
                $paramNames .= ", ";
            }
            $paramNames .= $name;
        }

        $res = [
            "msg" => "Required parameters: [$paramNames] not set."
        ];

        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode($res);
    }
}
