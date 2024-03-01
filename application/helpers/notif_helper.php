<?php
function notif($msg, $type, $redirect)
{
   $CI = &get_instance();
   $CI->session->set_flashdata(['msg' => $msg, "class" => $type]);
   redirect($redirect);
}
//  function getNamaBulan($nomor_bulan) {
//    $nama_bulan = [
//        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
//    ];

//    return $nama_bulan[$nomor_bulan - 1];
// }