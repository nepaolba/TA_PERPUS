<?php

function checkLogin($allowController)
{
   $CI = &get_instance();
   $role = $CI->session->userdata('role');
   ($role) ? checkRole($allowController,  $role) : redirect('Auth');
}

function checkRole($allowController,  $role)
{
   ($role !== $allowController) ?  redirect('error') : '';
   // var_dump($role);
}

function nameLogin()
{
   $CI = &get_instance();
   $role = $CI->session->userdata('role');
   $id = $CI->session->userdata('id');
   if ($role == 'admin') {
      $query = $CI->db->get_where('petugas', ['kd_petugas' => $id])->row();
      return [$query->nama_petugas, $query->foto_petugas];
   } else if ($role == 'user') {
      $query =  $CI->db->get_where('anggota', ['kd_anggota' => $id])->row();
      return $query->nama_anggota;
   }
}
