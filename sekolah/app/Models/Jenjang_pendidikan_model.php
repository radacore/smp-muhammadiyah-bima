<?php 
namespace App\Models;

use CodeIgniter\Model;

class Jenjang_pendidikan_model extends Model
{

    protected $table = 'jenjang_pendidikan';
    protected $primaryKey = 'id_jenjang_pendidikan';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->like('jenjang_pendidikan.judul_jenjang_pendidikan',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.isi',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.keywords',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.ringkasan',$keywords,'BOTH');
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->like('jenjang_pendidikan.judul_jenjang_pendidikan',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.isi',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.keywords',$keywords,'BOTH');
        $this->orLike('jenjang_pendidikan.ringkasan',$keywords,'BOTH');
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // home
    public function main()
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'status_jenjang_pendidikan' => 'Publish']);
        $this->orderBy('jenjang_pendidikan.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function beranda($jenis_jenjang_pendidikan,$jumlah)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [     'status_jenjang_pendidikan' => 'Publish',
                            'jenis_jenjang_pendidikan'  => $jenis_jenjang_pendidikan]);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $this->limit($jumlah);
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function sidebar()
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'status_jenjang_pendidikan' => 'Publish',
                            'jenis_jenjang_pendidikan'  => 'Jenjang_pendidikan']);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $this->limit(10);
        $query = $this->get();
        return $query->getResult();
    }


    // home
    public function home()
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [     'status_jenjang_pendidikan' => 'Publish',
                            'jenis_jenjang_pendidikan'  => 'Jenjang_pendidikan']);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // home
    public function jenis_publish($jenis_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [     'status_jenjang_pendidikan'    => 'Publish',
                            'jenis_jenjang_pendidikan'  => $jenis_jenjang_pendidikan
                        ]);
        $this->orderBy('jenjang_pendidikan.urutan','ASC');
        $query = $this->get();
        return $query->getResult();
    }

    // jenjang
    public function jenjang($id_jenjang)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'status_jenjang_pendidikan'         => 'Publish',
                            'jenis_jenjang_pendidikan'          => 'Jenjang_pendidikan',
                            'jenjang_pendidikan.id_jenjang'    => $id_jenjang]);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // jenjang
    public function jenjang_status_jenis_all($id_jenjang,$jenis_jenjang_pendidikan,$status_jenjang_pendidikan,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [ 'jenjang_pendidikan.id_jenjang'    => $id_jenjang,
                        'jenjang_pendidikan.jenis_jenjang_pendidikan'   => $jenis_jenjang_pendidikan,
                        'jenjang_pendidikan.status_jenjang_pendidikan'  => $status_jenjang_pendidikan,
                    ]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenjang_status_jenis($id_jenjang,$jenis_jenjang_pendidikan,$status_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan');
        $this->where( [ 'jenjang_pendidikan.id_jenjang'    => $id_jenjang,
                        'jenjang_pendidikan.jenis_jenjang_pendidikan'   => $jenis_jenjang_pendidikan,
                        'jenjang_pendidikan.status_jenjang_pendidikan'  => $status_jenjang_pendidikan,
                    ]);
        $query = $this->get();
        return $query->getNumRows();
    }

    // jenjang
    public function jenjang_all($id_jenjang,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'jenjang_pendidikan.id_jenjang'    => $id_jenjang]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.tanggal_publish','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenjang($id_jenjang)
    {
        $this->table('jenjang_pendidikan')->where('id_jenjang',$id_jenjang);
        $query = $this->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'jenjang_pendidikan.id_user'    => $id_user]);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_author($id_user)
    {
        $this->table('jenjang_pendidikan')->where('id_user',$id_user);
        $query = $this->get();
        return $query->getNumRows();
    }

    // jenjang
    public function jenis_jenjang_pendidikan_all($jenis_jenjang_pendidikan,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'jenjang_pendidikan.jenis_jenjang_pendidikan'    => $jenis_jenjang_pendidikan]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_jenjang_pendidikan($jenis_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan')->where('jenis_jenjang_pendidikan',$jenis_jenjang_pendidikan);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_jenjang_pendidikan
    public function status_jenjang_pendidikan_all($status_jenjang_pendidikan,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [  'jenjang_pendidikan.status_jenjang_pendidikan'    => $status_jenjang_pendidikan]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // jenjang
    public function jenis_status_jenjang_pendidikan_all($jenis_jenjang_pendidikan,$status_jenjang_pendidikan,$limit,$start)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where( [     'jenjang_pendidikan.jenis_jenjang_pendidikan'   => $jenis_jenjang_pendidikan,
                            'jenjang_pendidikan.status_jenjang_pendidikan'  => $status_jenjang_pendidikan,  
                        ]);
        $this->limit((int)$limit,(int)$start);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // total
    public function total_jenis_status_jenjang_pendidikan($jenis_jenjang_pendidikan,$status_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan')->where('jenis_jenjang_pendidikan',$jenis_jenjang_pendidikan)->where('status_jenjang_pendidikan',$status_jenjang_pendidikan);
        $query = $this->get();
        return $query->getNumRows();
    }

    // status_jenjang_pendidikan
    public function total_status_jenjang_pendidikan($status_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan')->where('status_jenjang_pendidikan',$status_jenjang_pendidikan);
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $this->table('jenjang_pendidikan');
        $query = $this->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where('jenjang_pendidikan.id_jenjang_pendidikan',$id_jenjang_pendidikan);
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // detail
    public function detail2($id_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan');
        $this->select('*');
        $this->where('jenjang_pendidikan.id_jenjang_pendidikan',$id_jenjang_pendidikan);
        $query = $this->get();
        return $query->getRow();
    }

    // read
    public function read($slug_jenjang_pendidikan)
    {
        $this->table('jenjang_pendidikan');
        $this->select('jenjang_pendidikan.*, jenjang.nama_jenjang, users.nama');
        $this->join('jenjang','jenjang.id_jenjang = jenjang_pendidikan.id_jenjang','LEFT');
        $this->join('users','users.id_user = jenjang_pendidikan.id_user','LEFT');
        $this->where('jenjang_pendidikan.slug_jenjang_pendidikan',$slug_jenjang_pendidikan);
        $this->where('jenjang_pendidikan.status_jenjang_pendidikan','Publish');
        $this->orderBy('jenjang_pendidikan.id_jenjang_pendidikan','DESC');
        $query = $this->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('jenjang_pendidikan');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('jenjang_pendidikan');
        $builder->where('id_jenjang_pendidikan',$data['id_jenjang_pendidikan']);
        $builder->update($data);
    }

    // testing
    public function copypaste($data)
    {
        $builder = $this->db->table('jenjang_pendidikan');
        $builder->insert($data);
    }

}