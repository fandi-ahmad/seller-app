<?php

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this -> load -> model('pembelian_model');
	}

	function index(){
		if ($this->session->has_userdata('username')) {
			$produks = $this->produk_model->select();
			$data_produk['produks'] = null;
			foreach ($produks as $prd) {
				$data_produk['produks'][]=$prd;
			}

			$key['status'] = 'y';
            $pembelian = $this -> pembelian_model -> select($key);
            if(count($pembelian) == 0) {
                unset($pembelian);
                $pembelian['tanggal'] = date('Y-m-d');
                $pembelian['status'] = 'y';
                $this -> pembelian_model -> insert ($pembelian);
            }
            $pembelian = $this -> pembelian_model -> select($key)[0];
            $key_detil['idpembelian'] = $pembelian ['idpembelian'];
            $data['detils'] = $this -> pembelian_model -> select_detil($key_detil);
            $data['produks'] = $this -> produk_model -> select();
            $data['pembelian'] = $pembelian;

			$this->load->view('dashboard', $data);
			
		} else {
			$this->load->view('login');
		}
	}
}
