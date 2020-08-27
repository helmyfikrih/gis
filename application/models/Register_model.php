<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends CI_Model
{
    var $column_order = array(
        'register_id',
        'register_id',
        'register_name',
        'register_email',
        'register_phone',
        'register_address',
    );
    var $column_search = array(
        'register_id',
        'register_id',
        'register_name',
        'register_email',
        'register_phone',
        'register_address',
    );

    var $order = array('register_id' => 'asc'); // default order


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

        $this->db->select('*');
        $this->db->from('gis_register');
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
        $this->db->select('*
        ');
        $this->db->from('gis_register');
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


    function getData($cond)
    {
        $this->db->where($cond);
        return $this->db->get('gis_register')->result_array();
    }

    function insertData($data)
    {
        return $this->db->insert('gis_register', $data);
    }

    function insertDataAttachment($data)
    {
        return $this->db->insert_batch('gis_register_attachment', $data);
    }

    function verifyEmail($cond)
    {
        $registerStatus = 2;
        $data = array(
            'register_email_verify_status' => 1,
            'register_email_verify_date' => date("Y-m-d H:i:s"),
            'register_status' => $registerStatus
        );
        $this->db->where($cond);
        return $this->db->update('gis_register', $data);
    }

    function getOne($cond = null)
    {
        $this->db->select("*");
        $this->db->where($cond);
        return $this->db->get('gis_register r')->result_array();
    }

    function getOneAttachment($cond = null)
    {
        $this->db->select("ra.*");
        $this->db->from("gis_register r");
        $this->db->join("gis_register_attachment ra", "ra.register_id=r.register_id");
        $this->db->where($cond);
        return $this->db->get()->result_array();
    }

    function updateData($data)
    {
        $this->db->where($data['cond']);
        return $this->db->update('gis_register', $data['data_register']);
    }

    function insertUser($data)
    {
        return $this->db->insert('gis_user', $data);
    }
    function insertDeveloperDetail($data)
    {
        return $this->db->insert('gis_developer_detail', $data);
    }
}
