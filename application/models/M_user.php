<?php

/**
 * Created by IntelliJ IDEA.
 * User: phamtrong
 * Date: 14/06/16
 * Time: 15:33
 */
class M_user extends Crud_manager {

    protected $_table = 'users';
    public $schema = [
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[users.email,deleted=0]|min_length[6]',
            'errors' => Array(
                'is_unique' => "Địa chỉ email đã được sử dụng.",
            ),
            'form' => [
                'type' => 'email',
            ],
            'filter' => [
                'type' => 'text',
                'search_type' => 'like',
            ],
            'table' => [
                'callback_render_data' => "add_link",
            ],
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Tên hiển thị',
            'rules' => 'required',
            'form' => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter' => [
                'search_type' => 'like',
                'attr' => 'data-test="filter"',
            ],
            'table' => [
                'label' => 'Tên',
            ],
        ],
        'role_id' => [
            'field' => 'role_id',
            'db_field' => 'g.id',
            'label' => 'Quyền',
            'rules' => 'required',
            'form' => [
                'type' => 'select',
                'target_model' => 'M_role',
                'target_function' => 'dropdown',
                'target_arg' => ['id', 'description'],
            ],
            'filter' => [
                'type' => 'multiple_select',
            ],
        ],
        'role_name' => [
            'field' => 'role_name',
            'db_field' => 'g.description',
            'label' => 'Quyền',
            'rules' => 'required',
            'table' => TRUE,
        ],
        'active' => [
            'field' => 'active',
            'label' => 'Trạng thái',
            'rules' => ['required'],
            'form' => [
                'type' => 'select',
                'target_model' => 'this',
                'target_function' => 'get_status',
                'class' => '',
            ],
            'filter' => [
                'type' => 'multiple_select',
            ],
            'table' => [
                'callback_render_data' => "get_status_text",
                'class' => "hidden-480",
            ],
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Mật khẩu',
            'rules' => 'required|min_length[6]',
            'form' => [
                'type' => 'password',
                'callback_render_html' => 'custom_render_password',
            ],
        ],
        'password_conf' => [
            'field' => 'password_conf',
            'label' => 'Nhập lại mật khẩu',
            'rules' => 'required|matches[password]',
            'form' => [
                'type' => 'password',
            ],
        ],
        'created_on' => [
            'field' => 'created_on',
            'label' => 'Ngày tạo',
            'rules' => 'readonly',
            'table' => [
                'callback_render_data' => "timestamp_to_date",
                'class' => "hidden-480",
                'attr' => 'data-check=\'true\'',
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
        $this->before_get['join_all'] = "join_role_table";
    }

    public function include_my_profile() {
        $this->before_get['include_my_profile'] = "get_my_profile_callback";
    }

    public function get_my_profile_callback() {
        $this->db->or_where("m.id", $this->session->userdata("user_id"));
    }

    public function join_role_table() {
        $this->db->select($this->_table_alias . ".*, g.name as role, g.description as role_name, g.id as role_id");
        $this->db->join("ion_users_groups as ug", $this->_table_alias . ".id=ug.user_id");
        $this->db->join("ion_groups as g", "ug.group_id=g.id");
//        if ($this->is_in_group("admin")) {
//            $this->db->where("g.name", 'corporation');
//        }
//        if ($this->is_in_group("corporation")) {
//            $this->db->where_in("g.name", [
//                'warehouse_manager', 'ppc', 'producer', 'quality_manager',
//            ]);
//            $this->db->where('m.parent_id', $this->session->userdata("user_id"));
//        }
    }

    public function get_status() {
        return [
            '1' => 'Kich hoat',
            '0' => 'Khoa',
        ];
    }

    public function get_status_text($id) {
        $status = $this->get_status();
        if (isset($status[$id])) {
            return $status[$id];
        } else {
            return $id;
        }
    }

    public function insert($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            $data = $this->trigger('before_create', $data);
            $data['parent_id'] = $this->session->userdata("user_id");
            $insert_id = $this->ion_auth->register($data['email'], $data['password'], $data['email'], $data, [$data['role_id']]);
            $this->trigger('after_create', $insert_id);
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    public function update($id, $data, $skip_validation = FALSE) {
        $validate = $this->get_validate_from_schema();
        if ($data['password'] == "" && $data['password_conf'] == "") {
            unset($data['password']);
            unset($data['password_conf']);
            unset($validate['password']);
            unset($validate['password_conf']);
        }
        $validate['email']['rules'] = str_replace(
            'is_unique[users.email,deleted=0]',
            "is_unique[users.email,deleted=0,id!=$id]",
            $validate['email']['rules']
        );
        if ($skip_validation === FALSE) {
            $data = $this->validate($data, $validate);
        }
        if (!$data) {
            return FALSE;
        }
        $new_group = isset($data['role_id']) ? $data['role_id'] : FALSE;
        unset($data['role_id']);
        unset($data['password_conf']);
        $update_result = parent::update($id, $data, TRUE);
        if ($new_group) {
            $this->update_group($id, $new_group);
        }
        if (isset($data['password'])) {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $this->ion_auth->reset_password($data[$identity_column], $data['password']);
        }
        return $update_result;
    }

    public function update_group($id, $new_group) {
        $old_group = $this->ion_auth->get_users_groups($id);
        $change = TRUE;
        foreach ($old_group->result() as $group_item) {
            if ($new_group == $group_item->id) {//Not change
                $change = FALSE;
                break;
            }
        }
        if ($change) {
            $this->ion_auth->remove_from_group(FALSE, $id);
            $this->ion_auth->add_to_group($new_group, $id);
        }
    }

    public function delete_many($primary_values) {
        $result = parent::delete_many($primary_values);
        foreach ($primary_values as $id) {
            $this->ion_auth->deactivate($id);
        }
        return $result;
    }
}