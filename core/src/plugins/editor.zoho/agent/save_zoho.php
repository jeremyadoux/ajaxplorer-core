<?php

/**
 * Remove all "../../" tentatives, replace double slashes
 * @static
 * @param string $path
 * @return string
 */
function securePath($path)
{
    if ($path == null) $path = "";
    //
    // REMOVE ALL "../" TENTATIVES
    //
    $path = str_replace(chr(0), "", $path);
    $dirs = explode('/', $path);
    for ($i = 0; $i < count($dirs); $i++) {
        if ($dirs[$i] == '.' or $dirs[$i] == '..') {
            $dirs[$i] = '';
        }
    }
    // rebuild safe directory string
    $path = implode('/', $dirs);

    //
    // REPLACE DOUBLE SLASHES
    //
    while (preg_match('/\/\//', $path)) {
        $path = str_replace('//', '/', $path);
    }
    return $path;
}

// DEFINE A SECRET KEY, DEFINE YOURS!
define('SECRET_KEY', 'z-agent-key');
$vars = array_merge($_GET, $_POST);

if (!isSet($vars["ajxp_action"]) && isset($vars["id"]) && isset($vars["format"])) {

    $filezoho = $_FILES['content']["tmp_name"];
    $cleanId = securePath($vars["id"]);
    move_uploaded_file($filezoho, "files/".$cleanId.".".$vars["format"]);

} else if ($vars["ajxp_action"] == "get_file" && isSet($vars["name"]) && isset($vars['key']) && $vars["key"] == SECRET_KEY) {

    $path = securePath($path);
    if (file_exists("files/".$path)) {
        readfile("files/".$path);
        unlink("files/".$path);
    }

}
