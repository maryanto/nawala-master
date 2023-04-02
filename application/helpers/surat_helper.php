<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('nm_status_surat')) {
    function nm_status_surat($id)
    {
        if ($id != NULL) {
            if ($id == '1') {
                echo "Diteruskan";
            } elseif ($id == '0') {
                echo "Diarsipkan";
            } else {
                echo "";
            }
        }
    }
}


if (!function_exists('nm_status_disposisi')) {
    function nm_status_disposisi($id)
    {
        if ($id != NULL) {
            if ($id == '1') {
                echo "Biasa";
            } elseif ($id == '2') {
                echo "Penting";
            } elseif ($id == '3') {
                echo "Rahasia";
            } else {
                echo "";
            }
        } else {
            echo "";
        }
    }
}
