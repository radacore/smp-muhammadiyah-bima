<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Jenjang_pendidikan_model;
use App\Models\Jenjang_model;
use App\Models\User_model;

class Jenjang_pendidikan extends BaseController
{
	
	// index
	public function index()
	{
		
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$m_jenjang 	= new Jenjang_model();
		$jenjang 		= $m_jenjang->listing();
		$pager 			= service('pager'); 
		// jenjang_pendidikan
		if(isset($_GET['keywords'])) 
		{
			$keywords 		= $this->request->getVar('keywords');
			$total 			= $m_jenjang_pendidikan->total_cari($keywords);
			$title 			= 'Hasil pencarian: '.$_GET['keywords'].' - '.$total.' ditemukan';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $jenjang_pendidikan 		= $m_jenjang_pendidikan->paginasi_admin_cari($keywords,$perPage, $page);
		}else{
			$total 			= $m_jenjang_pendidikan->total();
			$title 			= 'Jenjang Pendidikan ('.$total.')';
	        $page    		= (int) ($this->request->getGet('page') ?? 1);
	        $perPage 		= $this->website->paginasi();
	        $total   		= $total;
	        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
	        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
	        $jenjang_pendidikan 		= $m_jenjang_pendidikan->paginasi_admin($perPage, $page);
		}
		// end jenjang_pendidikan
		
		$data = [	'title'			=> $title,
					'jenjang_pendidikan'		=> $jenjang_pendidikan,
					'pagination'	=> $pager_links,
					'jenjang'		=> $jenjang,
					'content'		=> 'admin/jenjang_pendidikan/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// testing
	public function testing()
	{
		$data = [	'title'			=> 'Unggah media',
				];
		echo view('admin/jenjang_pendidikan/unggah',$data);
	}

	// jenjang
	public function jenjang($id_jenjang)
	{
		
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$m_jenjang 	= new Jenjang_model();
		$jenjang 		= $m_jenjang->detail($id_jenjang);
		$total 			= $m_jenjang_pendidikan->total_jenjang($id_jenjang);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $jenjang_pendidikan 		= $m_jenjang_pendidikan->jenjang_all($id_jenjang,$perPage, $page);

		$data = [	'title'			=> $jenjang->nama_jenjang.' ('.$total.')',
					'jenjang_pendidikan'		=> $jenjang_pendidikan,
					'content'		=> 'admin/jenjang_pendidikan/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_jenjang_pendidikan
	public function jenis_jenjang_pendidikan($jenis_jenjang_pendidikan)
	{
		
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$m_jenjang 	= new Jenjang_model();
		$total 			= $m_jenjang_pendidikan->total_jenis_jenjang_pendidikan($jenis_jenjang_pendidikan);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $jenjang_pendidikan 		= $m_jenjang_pendidikan->jenis_jenjang_pendidikan_all($jenis_jenjang_pendidikan,$perPage, $page);

		$data = [	'title'			=> $jenis_jenjang_pendidikan.' ('.$total.')',
					'jenjang_pendidikan'		=> $jenjang_pendidikan,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/jenjang_pendidikan/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// status_jenjang_pendidikan
	public function status_jenjang_pendidikan($status_jenjang_pendidikan)
	{
		
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$m_jenjang 	= new Jenjang_model();
		$total 			= $m_jenjang_pendidikan->total_status_jenjang_pendidikan($status_jenjang_pendidikan);
		$pager 			= service('pager');
        $page    		= (int) ($this->request->getGet('page') ?? 1);
        $perPage 		= $this->website->paginasi();
        $total   		= $total;
        $pager_links 	= $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page 			= ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $jenjang_pendidikan 		= $m_jenjang_pendidikan->status_jenjang_pendidikan_all($status_jenjang_pendidikan,$perPage, $page);

		$data = [	'title'			=> $status_jenjang_pendidikan.' ('.$total.')',
					'jenjang_pendidikan'		=> $jenjang_pendidikan,
					'pagination'	=> $pager_links,
					'content'		=> 'admin/jenjang_pendidikan/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$m_jenjang 	= new Jenjang_model();
		$m_user 		= new User_model();
		$user 			= $m_user->detail($id_user);
		$jenjang_pendidikan 		= $m_jenjang_pendidikan->author_all($id_user);
		$total 			= $m_jenjang_pendidikan->total_author($id_user);

		$data = [	'title'					=> $user->nama.' ('.$total.')',
					'jenjang_pendidikan'	=> $jenjang_pendidikan,
					'content'				=> 'admin/jenjang_pendidikan/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		$m_jenjang 	= new Jenjang_model();
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$jenjang 		= $m_jenjang->listing();

		// Start validasi
		if($this->request->getMethod() === 'POST' && $this->validate(
			[
				'judul_jenjang_pendidikan' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'					=> $this->session->get('id_user'),
					'id_jenjang'				=> $this->request->getVar('id_jenjang'),
					'slug_jenjang_pendidikan'	=> strtolower(url_title($this->request->getVar('judul_jenjang_pendidikan'))),
					'judul_jenjang_pendidikan'	=> $this->request->getVar('judul_jenjang_pendidikan'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_jenjang_pendidikan'		=> $this->request->getVar('status_jenjang_pendidikan'),
					'jenis_jenjang_pendidikan'		=> $this->request->getVar('jenis_jenjang_pendidikan'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'gambar' 			=> $namabaru,
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_jenjang_pendidikan->tambah($data);
	        	return redirect()->to(base_url('admin/jenjang_pendidikan'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user'			=> $this->session->get('id_user'),
					'id_jenjang'		=> $this->request->getVar('id_jenjang'),
					'slug_jenjang_pendidikan'		=> strtolower(url_title($this->request->getVar('judul_jenjang_pendidikan'))),
					'judul_jenjang_pendidikan'		=> $this->request->getVar('judul_jenjang_pendidikan'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_jenjang_pendidikan'		=> $this->request->getVar('status_jenjang_pendidikan'),
					'jenis_jenjang_pendidikan'		=> $this->request->getVar('jenis_jenjang_pendidikan'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_post'		=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_jenjang_pendidikan->tambah($data);
	        	return redirect()->to(base_url('admin/jenjang_pendidikan'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }


		$data = [	'title'			=> 'Tambah Jenjang_pendidikan',
					'jenjang'		=> $jenjang,
					'content'		=> 'admin/jenjang_pendidikan/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_jenjang_pendidikan)
	{
		
		$m_jenjang 	= new Jenjang_model();
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		$jenjang 		= $m_jenjang->listing();
		$jenjang_pendidikan 		= $m_jenjang_pendidikan->detail($id_jenjang_pendidikan);
		// Start validasi
		if($this->request->getMethod() === 'POST' && $this->validate(
			[
				'judul_jenjang_pendidikan' 	=> 'required',
				'gambar'	 	=> [
					                'ext_in[gambar,jpg,jpeg,gif,png,svg]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= $avatar->getRandomName();
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_jenjang_pendidikan'			=> $id_jenjang_pendidikan,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_jenjang'		=> $this->request->getVar('id_jenjang'),
					'slug_jenjang_pendidikan'		=> strtolower(url_title($this->request->getVar('judul_jenjang_pendidikan'))),
					'judul_jenjang_pendidikan'		=> $this->request->getVar('judul_jenjang_pendidikan'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_jenjang_pendidikan'		=> $this->request->getVar('status_jenjang_pendidikan'),
					'jenis_jenjang_pendidikan'		=> $this->request->getVar('jenis_jenjang_pendidikan'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'gambar' 			=> $namabaru,
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_jenjang_pendidikan->edit($data);
       		 	return redirect()->to(base_url('admin/jenjang_pendidikan'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_jenjang_pendidikan'			=> $id_jenjang_pendidikan,
	        		'id_user'			=> $this->session->get('id_user'),
					'id_jenjang'		=> $this->request->getVar('id_jenjang'),
					'slug_jenjang_pendidikan'		=> strtolower(url_title($this->request->getVar('judul_jenjang_pendidikan'))),
					'judul_jenjang_pendidikan'		=> $this->request->getVar('judul_jenjang_pendidikan'),
					'ringkasan'			=> $this->request->getVar('ringkasan'),
					'isi'				=> $this->request->getVar('isi'),
					'status_jenjang_pendidikan'		=> $this->request->getVar('status_jenjang_pendidikan'),
					'jenis_jenjang_pendidikan'		=> $this->request->getVar('jenis_jenjang_pendidikan'),
					'keywords'			=> $this->request->getVar('keywords'),
					'icon'				=> $this->request->getVar('icon'),
					'urutan'			=> $this->request->getVar('urutan'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_jenjang_pendidikan->edit($data);
       		 	return redirect()->to(base_url('admin/jenjang_pendidikan'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'			=> 'Edit Jenjang_pendidikan: '.$jenjang_pendidikan->judul_jenjang_pendidikan,
					'jenjang'		=> $jenjang,
					'jenjang_pendidikan'		=> $jenjang_pendidikan,
					'content'		=> 'admin/jenjang_pendidikan/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// proses
	public function proses()
	{
		
		$m_jenjang 	= new Jenjang_model();
		$m_jenjang_pendidikan 		= new Jenjang_pendidikan_model();
		// proses
		$pengalihan = $this->request->getVar('pengalihan');
		$submit 	= $this->request->getVar('submit');
		$id_jenjang_pendidikan 	= $this->request->getVar('id_jenjang_pendidikan');
		// check jenjang_pendidikan
		if(empty($this->request->getVar('id_jenjang_pendidikan')))
		{
			return redirect()->to($pengalihan)->with('warning', 'Anda belum memilih jenjang_pendidikan. Pilih salah satu jenjang_pendidikan');
		}
		// end check jenjang_pendidikan
		// proses
		if($submit=='Update') {
   			for($i=0; $i < sizeof($id_jenjang_pendidikan);$i++) {
				$data = array(	'id_jenjang_pendidikan'		=> $id_jenjang_pendidikan[$i],
								'id_user'		=> $this->session->get('id_user'),
								'jenis_jenjang_pendidikan'	=> $this->request->getVar('jenis_jenjang_pendidikan')
							);
   				$m_jenjang_pendidikan->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Jenjang_pendidikan berhasil diupdate jenis jenjang_pendidikannya');
		}elseif($submit=='Publish') {
			for($i=0; $i < sizeof($id_jenjang_pendidikan);$i++) {
				$data = array(	'id_jenjang_pendidikan'		=> $id_jenjang_pendidikan[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_jenjang_pendidikan'	=> 'Publish'
							);
   				$m_jenjang_pendidikan->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Jenjang_pendidikan berhasil dipublikasikan');
		}elseif($submit=='Draft') {
			for($i=0; $i < sizeof($id_jenjang_pendidikan);$i++) {
				$data = array(	'id_jenjang_pendidikan'		=> $id_jenjang_pendidikan[$i],
								'id_user'		=> $this->session->get('id_user'),
								'status_jenjang_pendidikan'	=> 'Draft'
							);
   				$m_jenjang_pendidikan->edit($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Jenjang_pendidikan berhasil tidak dipublikasikan');
		}elseif($submit=='Delete') {
			for($i=0; $i < sizeof($id_jenjang_pendidikan);$i++) {
				$data = array(	'id_jenjang_pendidikan'	=> $id_jenjang_pendidikan[$i]);
   				$m_jenjang_pendidikan->delete($data);
   			}
   			return redirect()->to($pengalihan)->with('sukses', 'Data berhasil dihapus');
		}
		// end proses
	}
	
	// Delete
	public function delete($id_jenjang_pendidikan)
	{
		
		$m_jenjang_pendidikan = new Jenjang_pendidikan_model();
		$data = ['id_jenjang_pendidikan'	=> $id_jenjang_pendidikan];
		$m_jenjang_pendidikan->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/jenjang_pendidikan'));
	}
}