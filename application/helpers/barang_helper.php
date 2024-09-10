<?php


function getStatusBarang($status = NULL)
{
    if ($status == 0) {
        return 'Active';
    } else{
        return 'Deleted';
    }
}
