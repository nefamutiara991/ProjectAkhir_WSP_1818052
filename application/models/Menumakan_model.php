<?php

class Menumakan_model extends CI_Model
{
    public function getMenuMakan($nama = null)
    {
        if ($nama === null) {
            return $this->db->get('menu_makan')->result_array();
        } else {
            return $this->db->get_where('menu_makan', ['nama' => $nama])->result_array();
        }
    }

    public function deleteMenuMakan($nama)
    {
        $this->db->delete('menu_makan', ['nama' => $nama]);
        return $this->db->affected_rows();
    }

    public function createMenuMakan($data)
    {
        $this->db->insert('menu_makan', $data);
        return $this->db->affected_rows();
    }

    public function updateMenuMakan($data, $nama)
    {
        $this->db->update('menu_makan', $data, ['nama' => $nama]);
        return $this->db->affected_rows();
    }
}
