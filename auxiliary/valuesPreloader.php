<?php
function preloadText($name)
{
    if (isset($_POST[$name])) 
        echo(trim($_POST[$name]));
    else 
        echo('');
}

function preloadCheck($name)
{
    if (isset($_POST[$name])) 
        echo('checked');
    else 
        echo('');
}

function preloadDrop($arr, $name) {
    if (isset($_POST[$name])) {
        foreach ($arr as $value) {
            if ($value == $_POST[$name])
                echo('<option selected>' . $value . '</option>');
            else
                echo('<option>' . $value . '</option>');
        }
    } else
        foreach ($arr as $value) {
            echo('<option>' . $value . '</option>');
        }
}

?>