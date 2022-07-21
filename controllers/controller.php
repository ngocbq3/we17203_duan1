<?php
require_once "lib/render.php";
require_once "models/hang_hoa.php";

function hang_hoa_index()
{
    $hang_hoa = hang_hoa_all();
    view('products.index', ['hang_hoa' => $hang_hoa]);
}

function hang_hoa_show($id)
{
    $hang_hoa = hang_hoa_one($id);
    if (!$hang_hoa) {
        header('location: /hang_hoa');
        die;
    }
    view('products.show', ['hang_hoa' => $hang_hoa]);
}
