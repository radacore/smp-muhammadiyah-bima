<?php
namespace App\Controllers;
use App\Models\Konfigurasi_model;
use App\Models\Jenjang_pendidikan_model;
use App\Models\Nav_model;
use App\Models\Jenjang_model;

class Jenjang_pendidikan extends BaseController
{
    // index
    public function index()
    {
        $pager          = service('pager'); 
        $m_site         = new Konfigurasi_model();
        $site           = $m_site->listing();
        $m_jenjang_pendidikan       = new Jenjang_pendidikan_model();
        $status_jenjang_pendidikan  = 'Publish';
        $jenis_jenjang_pendidikan   = 'Jenjang';
        $total          = $m_jenjang_pendidikan->total_jenis_status_jenjang_pendidikan($jenis_jenjang_pendidikan,$status_jenjang_pendidikan);
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $jenjang_pendidikan         = $m_jenjang_pendidikan->jenis_status_jenjang_pendidikan_all($jenis_jenjang_pendidikan,$status_jenjang_pendidikan,$perPage, $page);

        $data = [   'title'         => 'Program Unggulan',
                    'description'   => 'Program Unggulan',
                    'keywords'      => 'Program Unggulan',
                    'site'          => $site,
                    'jenjang_pendidikan'        => $jenjang_pendidikan,
                    'pagination'    => $pager_links,
                    'content'       => 'jenjang_pendidikan/index'
                ];
        return view('layout/wrapper',$data);
    }

    // jenjang
    public function jenjang($id_jenjang)
    {
        $pager          = service('pager'); 
        $m_site         = new Konfigurasi_model();
        $site           = $m_site->listing();
        $m_jenjang_pendidikan       = new Jenjang_pendidikan_model();
        $m_jenjang     = new Jenjang_model();
        $jenjang       = $m_jenjang->detail($id_jenjang);
        $id_jenjang    = $jenjang->id_jenjang;
        $status_jenjang_pendidikan  = 'Publish';
        $jenis_jenjang_pendidikan   = 'Jenjang';
        $total          = $m_jenjang_pendidikan->total_jenjang_status_jenis($id_jenjang,$jenis_jenjang_pendidikan,$status_jenjang_pendidikan,);
        $page           = (int) ($this->request->getGet('page') ?? 1);
        $perPage        = $this->website->paginasi_depan();
        $total          = $total;
        $pager_links    = $pager->makeLinks($page, $perPage, $total,'bootstrap_pagination');
        $page           = ($this->request->getGet('page'))?($this->request->getGet('page')-1)*$perPage:0;
        $jenjang_pendidikan         = $m_jenjang_pendidikan->jenjang_status_jenis_all($id_jenjang,$jenis_jenjang_pendidikan,$status_jenjang_pendidikan,$perPage, $page);
        

        $data = [   'title'         => $jenjang->nama_jenjang,
                    'description'   => $jenjang->nama_jenjang,
                    'keywords'      => $jenjang->nama_jenjang,
                    'site'          => $site,
                    'jenjang_pendidikan'        => $jenjang_pendidikan,
                    'pagination'    => $pager_links,
                    'content'       => 'jenjang_pendidikan/index'
                ];
        return view('layout/wrapper',$data);
    }

    // read
    public function read($slug_jenjang_pendidikan)
    {
        $m_jenjang_pendidikan   = new Jenjang_pendidikan_model();
        $jenjang_pendidikan     = $m_jenjang_pendidikan->read($slug_jenjang_pendidikan);
        $news                   = $m_jenjang_pendidikan->sidebar();
        // print_r($jenjang_pendidikan);
        $data = array(  'id_jenjang_pendidikan' => $jenjang_pendidikan->id_jenjang_pendidikan,
                        'hits'                  => $jenjang_pendidikan->hits+1
                    );
        $m_jenjang_pendidikan->edit($data);
        

        $data = [   'title'                 => $jenjang_pendidikan->judul_jenjang_pendidikan,
                    'description'           => $jenjang_pendidikan->ringkasan,
                    'keywords'              => $jenjang_pendidikan->judul_jenjang_pendidikan.', '.$jenjang_pendidikan->keywords,
                    'jenjang_pendidikan'    => $jenjang_pendidikan,
                    'news'                  => $news,
                    'content'               => 'jenjang_pendidikan/read'
                ];
        return view('layout/wrapper',$data);
    }

    // profil
    public function profil($id_jenjang_pendidikan)
    {
        $m_jenjang_pendidikan   = new Jenjang_pendidikan_model();
        $m_nav      = new Nav_model();
        $jenjang_pendidikan     = $m_jenjang_pendidikan->read($id_jenjang_pendidikan);
        $news       = $m_nav->profil('Profil');

        $data = array(  'id_jenjang_pendidikan' => $jenjang_pendidikan->id_jenjang_pendidikan,
                        'hits'      => $jenjang_pendidikan->hits+1
                    );
        $m_jenjang_pendidikan->edit($data);

        $data = [   'title'         => $jenjang_pendidikan->judul_jenjang_pendidikan,
                    'description'   => $jenjang_pendidikan->ringkasan,
                    'keywords'      => $jenjang_pendidikan->judul_jenjang_pendidikan.', '.$jenjang_pendidikan->keywords,
                    'jenjang_pendidikan'        => $jenjang_pendidikan,
                    'news'          => $news,
                    'content'       => 'jenjang_pendidikan/profil'
                ];
        return view('layout/wrapper',$data);
    }

    // layanan
    public function layanan($id_jenjang_pendidikan)
    {
        $m_jenjang_pendidikan   = new Jenjang_pendidikan_model();
        $m_menu     = new Menu_model();
        $jenjang_pendidikan     = $m_jenjang_pendidikan->read($id_jenjang_pendidikan);
        $news       = $m_menu->profil('Layanan');

        $data = array(  'id_jenjang_pendidikan' => $jenjang_pendidikan->id_jenjang_pendidikan,
                        'hits'      => $jenjang_pendidikan->hits+1
                    );
        $m_jenjang_pendidikan->edit($data);

        $data = [   'title'         => $jenjang_pendidikan->judul_jenjang_pendidikan,
                    'description'   => $jenjang_pendidikan->ringkasan,
                    'keywords'      => $jenjang_pendidikan->judul_jenjang_pendidikan.', '.$jenjang_pendidikan->keywords,
                    'jenjang_pendidikan'        => $jenjang_pendidikan,
                    'news'          => $news,
                    'content'       => 'jenjang_pendidikan/profil'
                ];
        return view('layout/wrapper',$data);
    }

}
