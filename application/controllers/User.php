<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('M_User');
    }

	public function index()
	{
		$data['getdata'] = $this->M_User->getAll("user");
		$this->load->view('index',$data);
	}

	public function tambah_data()
	{
		$this->load->view('form_tambah');
	}

    public function t_data()
    {
        $user_id = $this->input->post('user_id');
        $cek_user = $this->M_User->cekdata("user","user_id",$user_id);
        if ($cek_user > 0) {
            echo "<script>
			alert('Data Ganda');
			window.location.href='index';
			</script>";
        }else{
            $fileName  = $_FILES['foto']['name'];
            $fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $userFile  = time().'_'.rand(1000,9999).'.'.$fileExt;
            $config['file_name']        = $userFile;
            $config['upload_path']      = './assets/images/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = 2560;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')){
                if ($this->M_User->tambahdata($userFile)) {
                    echo "<script>
                    alert('Data berhasil ditambah');
                    window.location.href='index';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='form_tambah';
                    </script>";
                }
            }else{
                echo "<script>
                alert(".$this->upload->display_errors().");
                window.location.href='form_tambah';
                </script>";
            }
        }
    }

    public function edit_data($getid)
    {
        $data["getdata"] = $this->M_User->getByField("user","user_id",$getid);
        $this->load->view('form_edit', $data);
    }

    public function e_data()
    {
        $getid = $this->input->post('getid');
        $user_id = $this->input->post('user_id');
        $cek_user = $this->M_User->cekvalidasi("user","user_id",$user_id,$getid);
        if ($cek_user > 0) {
            echo "<script>
			alert('Data Ganda');
			window.location.href='edit_data/$getid';
			</script>";
        }else{
            $cek_gambar = $this->M_User->getByField('user','user_id',$getid);
            $getuserFile = $cek_gambar->gambar;
            $foto = ", gambar='".$cek_gambar->gambar."'";
            if(empty($_FILES['foto']['name'])){
                if ($this->M_User->editdata($foto)) {
                    echo "<script>
                    alert('Data berhasil diubah tanpa ubah foto');
                    window.location.href='index';
                    </script>";
                }else{
                    echo "<script>
                    alert('Data error');
                    window.location.href='edit_data/$getid';
                    </script>";
                }
            }else{
                $fileName  = $_FILES['foto']['name'];
                $fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $userFile  = time().'_'.rand(1000,9999).'.'.$fileExt;
                $foto = ", gambar='".$userFile."'";
                $config['file_name']        = $userFile;
                $config['upload_path']      = './assets/images/';
                $config['allowed_types']    = 'gif|jpg|jpeg|png';
                $config['max_size']         = 2560;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')){
                    unlink('./assets/images/'.$getuserFile);
                    if ($this->M_User->editdata($foto)) {
                        echo "<script>
                        alert('Data berhasil diubah');
                        window.location.href='index';
                        </script>";
                    }else{
                        echo "<script>
                        alert('Data error');
                        window.location.href='edit_data/$getid';
                        </script>";
                    }
                }else{
                    echo "<script>
                    alert(".$this->upload->display_errors().");
                    window.location.href='form_tambah';
                    </script>";
                }
            }
        }
    }

	public function hapus_data()
	{
        if( $this->M_User->hapus_user() > 0 ) {
            echo "<script>
            alert('Data berhasil dihapus');
            window.location.href='index';
			</script>";
        } else {
            echo "<script>
			alert('Data error');
			window.location.href='index';
			</script>";
        }
    }
}
