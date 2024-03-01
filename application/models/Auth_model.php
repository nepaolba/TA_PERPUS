<?php

class Auth_model extends CI_Model
{
    function getUsername($table, $username, $where)
    {
        // var_dump([$where => $username]);
        return $this->db->get_where($table, [$where => $username])->row_array();
    }
}
