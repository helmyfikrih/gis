<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model
{
    var $column_order = array(
        'user_id',
        'user_id',
        'user_username',
        'user_email',
    );
    var $column_search = array(
        'user_id',
        'user_id',
        'user_username',
        'user_email',
    );

    var $order = array('user_id' => 'asc'); // default order


    function getList($cond = null)
    {
        $this->_get_datatables_query($cond);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_query($cond)
    {

        $this->db->select('u.*, r.role_name, r.role_status');
        $this->db->from('gis_user u');
        $this->db->join('gis_user_role r', 'r.role_id=u.role_id');
        if ($cond) {
            $this->db->where($cond);
        }
        // $whereSess = "(bast.created_by_2w='$username' OR bast.created_by_4w='$username')";
        // $this->db->where($whereSess);

        $i = 0;

        foreach ($this->column_search as $item) // lojoining awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // lojoining awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_new($cond = null)
    {
        if ($cond) {
            $this->db->where($cond);
        }
        // $this->db->where(['bast.created_by_2w' => $username]);
        // $this->db->or_where(['bast.created_by_4w' => $username]);
        $this->db->select('*
        ');
        $this->db->from('gis_user u');
        $this->db->join('gis_user_role r', 'r.role_id=u.role_id');
        return $this->db->count_all_results();
    }

    function count_filtered_new($cond = null)
    {
        $this->_get_datatables_query($cond);
        if ($cond) {
            $this->db->where($cond);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function insertUser($data)
    {
        return $this->db->insert('gis_user', $data);
    }

    function updateUser($data, $cond)
    {
        $this->db->where($cond);
        return $this->db->update('gis_user', $data);
    }
    function insertUserDetail($data)
    {
        return $this->db->insert('gis_user_detail', $data);
    }

    function updateUserDetail($data, $cond)
    {
        $this->db->where($cond);
        return $this->db->update('gis_user_detail', $data);
    }

    function getOne($id)
    {
        $this->db->select("u.user_username, u.user_email,u.role_id, u.user_status,r.role_name,ud.*, u.user_id as uid");
        $this->db->where('u.user_id', $id);
        $this->db->from('gis_user u');
        $this->db->join('gis_user_detail ud', 'ud.user_id=u.user_id', 'left');
        $this->db->join('gis_user_role r', 'r.role_id=u.role_id', 'left');
        return $this->db->get()->result_array();
    }

    function deleteData($data)
    {
        $this->db->where($data['cond']);
        return $this->db->delete('gis_user');
    }
}
