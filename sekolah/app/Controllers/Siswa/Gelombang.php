<?php 
namespace App\Controllers\Siswa;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Galeri_model;
use App\Models\Berita_model;
use App\Models\Siswa_model;
use App\Models\Rombel_model;
use App\Models\Kelas_model;
use App\Models\Tahun_model;
use App\Models\Jenjang_model;
use App\Models\Pekerjaan_model;
use App\Models\Hubungan_model;
use App\Models\Siswa_rombel_model;
use App\Models\Agama_model;
use App\Models\Akun_model;
use App\Models\Jenis_dokumen_model;
use App\Models\Dokumen_model;
use App\Models\Gelombang_model;
use App\Models\Jenjang_pendidikan_model;
use App\Models\Nav_model;

class Gelombang extends BaseController
{
	public function index()
	{
		$m_gelombang 	= new Gelombang_model();
		$gelombang 		= $m_gelombang->aktif();

		$data = [   'title'     	=> 'Periode Pendaftaran Peserta Didik Baru (PPDB)',
					'description'   => 'Dasbor Pendaftar',
                    'keywords'      => 'Dasbor Pendaftar',
                    'gelombang'		=> $gelombang,
					'gelombang2'	=> $gelombang,
					'content'		=> 'siswa/gelombang/index'
                ];
        return view('siswa/layout/wrapper',$data);
	}
}