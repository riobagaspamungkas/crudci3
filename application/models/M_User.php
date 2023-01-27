<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    public function getAll($table){
        $query=$this->db->query("SELECT * FROM $table");
        return $query->result();
    }
    
    public function getByField($table,$field,$value){
        $query=$this->db->query("SELECT * FROM $table WHERE $field='$value'");
        return $query->row();
    }

    public function cekdata($table,$field,$value){
        $query=$this->db->query("SELECT * FROM $table WHERE $field='$value'");
        return $query->num_rows();
    }

    public function cekvalidasi($table,$field,$value1,$value2){
        $query=$this->db->query("SELECT * FROM $table WHERE $field = '$value1' AND $field != '$value2'");
        return $query->num_rows();
    }

    public function tambahdata($gambar){
        $user_id = $this->input->post('user_id');
        $password = md5($this->input->post('password'));
        $nama = $this->input->post('nama');
        $jk = $this->input->post('jk');
        $alamat = $this->input->post('alamat');
        $query=$this->db->query("insert into user values('$user_id', '$password', '$nama', '$jk', '$alamat', '$gambar')");
        if ($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function editdata($foto){
        $getid = $this->input->post('getid');
        $user_id = $this->input->post('user_id');
        $nama = $this->input->post('nama');
        $jk = $this->input->post('jk');
        $alamat = $this->input->post('alamat');
        $query=$this->db->query("update user set user_id='$user_id', nama='$nama', jk='$jk', alamat='$alamat' $foto where user_id='$getid'");
        if ($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function hapus_user(){
        $user_id=$this->input->post('user_id');
        $rowfoto = $this->getByField('user','user_id',$user_id);
        $foto = $rowfoto->gambar;
        $query=$this->db->query("DELETE FROM user WHERE user_id = '$user_id'");
        if ($query){
            unlink('./assets/images/'.$foto);
            return TRUE;
        }else{
            return FALSE;
        }
    }
}