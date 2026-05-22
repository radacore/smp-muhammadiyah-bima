<?php 
namespace App\Models;

use CodeIgniter\Model;

class Siswa_model extends Model
{

   public function __construct()
    {
        parent::__construct();
        $this->db               = \Config\Database::connect();
    }

    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $allowedFields    = ['*'];

    // listing
    public function listing()
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // status_siswa
    public function status_siswa($status_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('status_siswa',$status_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

     // status_siswa
    public function akun($id_akun)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('id_akun',$id_akun);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // gelombang
    public function gelombang($id_gelombang)
    {
        $builder = $this->db->table('siswa s');
        $builder->select('jp.judul_jenjang_pendidikan, jp.id_jenjang_pendidikan, s.status_pendaftaran, COUNT(s.id_siswa) AS jumlah_siswa');
        $builder->join('jenjang_pendidikan jp', 's.id_jenjang_pendidikan = jp.id_jenjang_pendidikan');
        $builder->where('s.id_gelombang',$id_gelombang);
        $builder->groupBy('jp.judul_jenjang_pendidikan, s.status_pendaftaran');
        $builder->orderBy('jp.judul_jenjang_pendidikan, s.status_pendaftaran');
        $query = $builder->get();
        return $query->getResult();
    }


    // gelombang_status_siswa
    public function gelombang_status_siswa($id_gelombang,$status_pendaftaran,$id_jenjang_pendidikan)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('siswa.id_gelombang',$id_gelombang);

        if($status_pendaftaran != 'Semua') {
            $builder->where('status_pendaftaran',$status_pendaftaran);
        }
        if($id_jenjang_pendidikan != 'Semua') {
            $builder->where('siswa.id_jenjang_pendidikan',$id_jenjang_pendidikan);
        }

        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total_gelombang_status_siswa
    public function total_gelombang_status_siswa($id_gelombang,$status_pendaftaran,$id_jenjang_pendidikan)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $builder->where('id_gelombang',$id_gelombang);
        if($status_pendaftaran != 'Semua') {
            $builder->where('status_pendaftaran',$status_pendaftaran);
        }
        if($id_jenjang_pendidikan != 'Semua') {
            $builder->where('id_jenjang_pendidikan',$id_jenjang_pendidikan);
        }
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // status_siswa_gelombang
    public function status_siswa_gelombang($status_siswa,$id_gelombang)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');

        if($status_siswa != 'Semua') {
            $builder->where('status_siswa',$status_siswa);
        }
        
        $builder->where('id_gelombang',$id_gelombang);
        $query = $builder->get();
        return $query->getRow();
    }

    // paginasi
    public function paginasi($limit,$start)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->limit($limit,$start);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // paginasi
    public function paginasi_cari($keywords,$limit,$start)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->like('nama_siswa',$keywords,'BOTH');
        $builder->orLike('email',$keywords,'BOTH');
        $builder->orLike('nama_ayah',$keywords,'BOTH');
        $builder->orLike('nama_ibu',$keywords,'BOTH');
        $builder->orLike('nama_wali',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orLike('telepon',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->limit($limit,$start);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // total
    public function total_cari($keywords)
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $builder->like('nama_siswa',$keywords,'BOTH');
        $builder->orLike('email',$keywords,'BOTH');
        $builder->orLike('nama_ayah',$keywords,'BOTH');
        $builder->orLike('nama_ibu',$keywords,'BOTH');
        $builder->orLike('nama_wali',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orLike('telepon',$keywords,'BOTH');
        $builder->orLike('alamat',$keywords,'BOTH');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('siswa');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // last_id
    public function last_id()
    {
        $builder = $this->db->table('siswa');
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // detail
    public function detail($id_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('id_siswa',$id_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // listing
    public function login($username,$password)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where([   'email'     => $username,
                            'password'  => $password
                        ]);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // listing
    public function login_nis($username,$password)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where([   'nis'       => $username,
                            'password'  => $password
                        ]);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function read($slug_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('slug_siswa',$slug_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // read
    public function kode_siswa($kode_siswa)
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*,
                        jenjang.nama_jenjang,
                        jenjang_pendidikan.judul_jenjang_pendidikan,
                        kelas.nama_kelas,
                        agama.nama_agama,
                        a.nama_agama AS agama_ayah,
                        b.nama_agama AS agama_ibu,
                        c.nama_agama AS agama_wali,
                        pekerjaan.nama_pekerjaan,
                        d.nama_pekerjaan AS pekerjaan_ibu,
                        e.nama_pekerjaan AS pekerjaan_wali,
                        h.nama_jenjang AS jenjang_ayah,
                        f.nama_jenjang AS jenjang_ibu,
                        g.nama_jenjang AS jenjang_wali,
                        hubungan.nama_hubungan,
                        gelombang.judul,
                        gelombang.tahun_ajaran,
                        jenjang_pendidikan.judul_jenjang_pendidikan');
        $builder->join('jenjang','jenjang.id_jenjang = siswa.id_jenjang','LEFT');
        $builder->join('kelas','kelas.id_kelas = siswa.id_kelas','LEFT');
        $builder->join('agama','agama.id_agama = siswa.id_agama','LEFT');
        $builder->join('agama a','a.id_agama = siswa.id_agama_ayah','LEFT');
        $builder->join('agama b','b.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('agama c','c.id_agama = siswa.id_agama_ibu','LEFT');
        $builder->join('hubungan','hubungan.id_hubungan = siswa.id_hubungan','LEFT');
        $builder->join('pekerjaan','pekerjaan.id_pekerjaan = siswa.id_pekerjaan_ayah','LEFT');
        $builder->join('pekerjaan d','d.id_pekerjaan = siswa.id_pekerjaan_ibu','LEFT');
        $builder->join('pekerjaan e','e.id_pekerjaan = siswa.id_pekerjaan_wali','LEFT');
        $builder->join('jenjang h','h.id_jenjang = siswa.id_jenjang_ayah','LEFT');
        $builder->join('jenjang g','g.id_jenjang = siswa.id_jenjang_ibu','LEFT');
        $builder->join('jenjang f','f.id_jenjang = siswa.id_jenjang_wali','LEFT');
        $builder->join('gelombang','gelombang.id_gelombang = siswa.id_gelombang','LEFT');
        $builder->join('jenjang_pendidikan','jenjang_pendidikan.id_jenjang_pendidikan = siswa.id_jenjang_pendidikan','LEFT');
        $builder->where('kode_siswa',$kode_siswa);
        $builder->orderBy('siswa.id_siswa','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // edit
    public function edit($data)
    {
        $builder = $this->db->table('siswa');
        $builder->where('id_siswa',$data['id_siswa']);
        $builder->update($data);
    }

    // hapus
    public function hapus($data)
    {
        $builder = $this->db->table('siswa');
        $builder->where('slug_siswa',$data['slug_siswa']);
        $builder->where('id_akun',$data['id_akun']);
        $builder->delete();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('siswa');
        $builder->insert($data);
    }

    // tambah  log
    public function siswa_log($data)
    {
        $builder = $this->db->table('siswa_logs');
        $builder->insert($data);
    }
}