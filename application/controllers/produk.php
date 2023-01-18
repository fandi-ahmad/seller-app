<?php
class Produk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('user_model');
	}

	function index(){
		if ($this->session->has_userdata('username')) {
			$produks = $this->produk_model->select();
			// $data['produks'] = $this->produk_model->select();
			$data['produks'] = null;
			foreach ($produks as $prd) {
				$prd['url'] = anchor('produk/edit/'.$prd['id'],'EDIT','class="btn btn-sm btn-warning"').
							anchor('produk/hapus/'.$prd['id'],'HAPUS','class="btn btn-sm btn-danger ms-2"');
				$data['produks'][]=$prd;
			}
			$data['username'] = $this->session->userdata('username');
			$username = $this->session->userdata('username');
			$data['user'] = $this->user_model->select(['username' => $username]);
			$this->load->view('produk', $data);
		} else {
			$this->load->view('login');
		}
	}


	function login() {
		$this->load->model('user_model');
		$key['username']=$this->input->post('username');
		$key['password']=$this->input->post('password');
		$user= $this->user_model->select($key);
		if (count($user)>0) {
			$this->session->set_userdata('username', $this->input->post('username'));
			redirect('dashboard');
		}
	}

	function logout() {
		$this->session->unset_userdata('username', $this->input->post('username'));
		redirect('produk');
	}

	function edit($id){
		$key['id']=$id;
		$produk = $this->produk_model->select($key);
		$produks = $this->produk_model->select();

		$data['produk'] = $produk[0];

		$data['produks'] = null;
		foreach ($produks as $prd) {
			$prd['url'] = anchor('produk/edit/'. $prd['id'], 'EDIT', 'class="btn btn-sm btn-warning"').
						anchor('produk/hapus/'. $prd['id'], 'HAPUS', 'class="btn btn-sm btn-danger ms-2"');
			$data['produks'][]=$prd;
		}
		$this->load->view('produk', $data);
	}

	function simpan(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namaproduk', "NAMA PRODUK", 'required');
		$this->form_validation->set_rules('price', "PRICE", 'required|numeric');

		$data['namaproduk'] = $this->input->post('namaproduk');
		$data['price'] = $this->input->post('price');
		if($this -> form_validation -> run()) {
			$data['namaproduk'] = $this -> input -> post ('namaproduk');
			$data['price'] = $this -> input -> post ('price');
			if ($this->input->post('update')) {
				$key['id'] = $this->input->post('id');
				$this->produk_model->update($key, $data);
			} else {
				$this->produk_model->insert($data);
				return redirect('produk');
			}
		}
		redirect('produk');
	}

	function hapus($id) {
		$this->produk_model->delete($id);
		redirect('produk');
	}
}