<?php
require_once "database.php";

function hang_hoa_all()
{
    $sql = "SELECT * FROM hang_hoa";
    return get_data_all($sql);
}
function hang_hoa_one($id)
{
    $sql = "Select * From hang_hoa Where ma_hh=?";
    return get_one($sql, $id);
}
