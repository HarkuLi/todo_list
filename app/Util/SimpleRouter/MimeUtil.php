<?php
namespace Harku\TodoList\Util\SimpleRouter;

class MimeUtil
{
    /**
     * This is written for that mime_content_type() doesn't work correctly with
     * css and js files. That will return text/plain for both cases.
     * This function checks types of css and js, and calls mime_content_type() if not matched.
     *
     * @param string $fileName
     * @return string|null
     */
    public static function determineType(string $fileName): ?string
    {
        $lastDotPos = strrpos($fileName, ".");
        if ($lastDotPos === false) {
            return null;
        }

        $extension = substr($fileName, $lastDotPos+1);
        if ($extension === "js") {
            return "text/javascript";
        } elseif ($extension === "css") {
            return "text/css";
        }

        return mime_content_type($fileName);
    }
}
