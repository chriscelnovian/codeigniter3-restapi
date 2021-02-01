<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model 
{
    var $tbl_user = 'tbl_user';

    /*
    |-------------------------------------------------------------------
    | Fetch All Users
    |-------------------------------------------------------------------
    | 
    */
    function fetch_users()
    {
        $this->db->order_by('full_name', 'asc');

        $query = $this->db->get($this->tbl_user);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Fetch User by ID
    |-------------------------------------------------------------------
    | 
    */
    function fetch_user($id)
    {
        $this->db->where('id', $id);

        $query = $this->db->get($this->tbl_user);
        return $query->row_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert User
    |-------------------------------------------------------------------
    | 
    */
    function insert_user($data)
    {
        $this->db->insert($this->tbl_user, $data);
        return ($this->db->affected_rows() > 0);
    }

    /*
    |-------------------------------------------------------------------
    | Update User
    |-------------------------------------------------------------------
    | 
    */
    function update_user($data)
    {
        $this->db->trans_start();
        $this->db->where('id', $data['id']);

        if(isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }

        $this->db->update($this->tbl_user, $data);
        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    /*
    |-------------------------------------------------------------------
    | Delete User
    |-------------------------------------------------------------------
    | 
    */
    function delete_user($id)
    {
        $this->db->where('id', $id);

        $this->db->delete($this->tbl_user);
        return ($this->db->affected_rows() > 0);
    }
}