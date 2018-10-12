<?php
    function start_setup() 
    {
        $app = \App\App::getInstance();
        $db = $app->getDb();

        $db_camagru = "./config/camagru.sql";
        $pathSetup = "./config/setup.php";
        $sql = file_get_contents($db_camagru);
        $sql_array = explode(";", $sql);

        if (!file_exists('upload')) {
            mkdir('upload', 0777, true);
        }

        foreach ($sql_array as $val) 
        {
            if (isset($val) === true && $val != '') 
            {
                $query = $db->getPdoInstall()->prepare($val);
                $query->execute();
            }
        }
        $to_del = realpath($db_camagru);
        if (is_writable($to_del))
            unlink($to_del);
        $to_del = realpath($pathSetup);
        if (is_writable($to_del))
            unlink($to_del);
        header("Location: index.php");
    }
    $submit = $_POST["submit"] ?? "";
    if ($submit == "OK") {
        start_setup();
    }
?>

<h1>Cliquez pour installer</h1>
<form action="index.php?p=setup" method="POST">
    <input type="submit" value="OK" name="submit">
</form>