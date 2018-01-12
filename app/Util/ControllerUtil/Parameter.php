<?php
namespace Harku\TodoList\Util\ControllerUtil;

use Harku\TodoList\Util\ControllerUtil\JsonResponse;

class Parameter
{
    /**
     * Note: This function only supports "get" and "post" methods.
     * Check whether required parameters are set.
     * If not set, send a json response and die.
     *
     * @param string ...$paramList List of required parameters. e.g. "param1", "param2", ...
     * @return void
     */
    public static function required(string ...$paramList): void
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $lostParamList = [];

        //check required parameters
        foreach ($paramList as $paramName) {
            if ($method === "GET") {
                if (!isset($_GET[$paramName])) {
                    $lostParamList[] = $paramName;
                }
            } elseif ($method === "POST") {
                if (!isset($_POST[$paramName])) {
                    $lostParamList[] = $paramName;
                }
            }
        }

        //response and die if there is any required parameter not set
        if (count($lostParamList)) {
            JsonResponse::lostRequiredParams($lostParamList);
            die();
        }
    }
}
