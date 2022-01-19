<?php
function redirect($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit;
    }
}

function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC")
{
    global $conn;
    $getAll = ("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
    $result = mysqli_query($conn, $getAll);
    $all = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all;
}
