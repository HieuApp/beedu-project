<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 29-Jun-16
 * Time: 9:21 AM
 */
class Order extends Manager_base {
    private $_order_id = NULL;

    function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc'], TRUE);
        $this->load->model("m_line", "line");
        $this->load->model("m_materials", "material");
        $this->load->model("m_prepack", "prepack");
        $this->load->model("m_size", "size");
        $this->load->model("m_prepacks_sizes", "prepack_size");
        $this->load->model("m_color", "color");
        $this->load->model("m_prepacks_colors", "prepack_color");
        $this->load->model("m_material_balances", "material_balance");
    }

    /**
     * Hàm cài đặt biến $name cho controller (xem trong 1 controller bất kỳ để biết chi tiết)
     */
    function setting_class() {
        $this->name = Array(
            "class"  => "company/order",
            "view"   => "company/order",
            "model"  => "m_order",
            "object" => "đơn hàng",
        );
    }

    public function manager($data = Array()) {
        $data['view_file'] = 'admin/order/manager_container';
        $data['add_link'] = site_url($this->name["class"] . "/entry/0");
        return parent::manager($data);
    }

    public function entry($order_id = 0, $tab = 'general', $data = Array()) {
        $this->load_more_css("assets/css/page/order.css");
        $data["order_id"] = $order_id;

        switch ($tab) {
            case 'general':
                if ($order_id != 0) $data["order"] = $this->model->get($order_id);
                break;
            case 'detail':
                $this->load_more_js("assets/js/page/order/order-detail.js", TRUE);
                $this->load_more_js("assets/js/page/order/bootstrap-tag.js", TRUE);//for tag input
                $this->load_more_js("assets/js/page/order/elements.typeahead.js", TRUE);//for tag input
                $data['prepacks'] = $this->_get_order_detail($order_id);
                break;
            case 'material':
                $this->load_more_js("assets/js/page/order/order-material.js", TRUE);
                $data["material_detail_list"] = $this->_get_material_detail_list($order_id);//is used to render the table in tab_material
                break;
        }

        $content = $this->load->view("company/order/entry_{$tab}", $data, TRUE);
        $this->show_page($content);
    }

    public function form_order_material($order_id = 0, $material_id = NULL) {
        $data = Array();
        $data["order_id"] = $order_id;
        $data["units"] = [
            'ybs'  => 'ybs',
            'kg'   => 'kg',
            'm'    => 'm',
            'roll' => 'cuộn',
        ];
        //TODO Load colors from table 'colors'
        $data["colors"] = [
            '1' => 'Deep Black',
            '2' => 'Blue',
            '3' => 'Green',
            '4' => 'Black',
        ];

        if (!$material_id) {
            $data["save_link"] = site_url($this->name["class"] . "/save_add_order_material");
        } else {
            $data["save_link"] = site_url($this->name["class"] . "/save_edit_order_material");
            $data["material_detail_list"] = $this->_get_material_detail_list($order_id, $material_id);
        }

        $content = $this->load->view("company/order/form_material_detail", $data, TRUE);
        $this->set_data_part("title", "Thêm  " . $this->name["object"], FALSE);
        $data_return = Array();
        if ($this->input->is_ajax_request()) {
            $data_return["state"] = 1;
            $data_return["html"] = $content;
            echo json_encode($data_return);
            return TRUE;
        } else {
            $this->show_page($content);
        }
    }

    public function save_entry_general($data = Array(), $data_return = Array(), $skip_validate = FALSE) {
        if (!$this->_have_permission()) return FALSE;
//        $data_return["callback"] = "save_form_add_response";
        if (sizeof($data) == 0) {
            $data = $this->input->post();
        }
        if (!$skip_validate) {
            $data_validated = $this->model->validate($data);
            if (!$data_validated) {
                $data_return["data"] = $data;
                $data_return["state"] = 0; /* state = 0 : dữ liệu không hợp lệ */
                $data_return["msg"] = "Dữ liệu gửi lên không hợp lệ";
                $data_return["error"] = $this->model->get_validate_error();
                echo json_encode($data_return);
                return FALSE;
            }
        }
        $insert_id = $this->model->insert($data_validated, TRUE);
        $key_field = $this->model->get_primary_key();
        $data_validated[$key_field] = $insert_id;
        if ($insert_id) {
            $data_return["key_name"] = $key_field;
            $data_return["record"] = $data_validated;
            $data_return["state"] = 1; /* state = 1 : insert thành công */
            $data_return["msg"] = "Thêm bản ghi thành công";
            $data_return["redirect"] = $insert_id;
            echo json_encode($data_return);
            return $insert_id;
        } else {
            $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
            $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
            echo json_encode($data_return);
            return FALSE;
        }
    }

    /**
     * Used by tab_order_detail
     * Save to table 'prepacks', table 'prepacks_colors' and table 'prepacks_sizes'
     *
     * @param array $data
     * @param array $data_return
     * @param bool $skip_validate
     * @return action|null
     */
    public function save_detail($data = Array(), $data_return = Array(), $skip_validate = FALSE) {
        //<editor-fold desc="Check permission and get input->post">
        if (!$this->_have_permission()) return FALSE;
        if (sizeof($data) == 0) {
            $data = $this->input->post();
        }
        $order_id = $data['order_id'];
        if ($order_id == 0) {
            echo json_encode([
                //"callback" => "show_error",
                "state" => 0,
                "msg"   => "Bạn cần gửi 'Thông tin chung' trước khi điền những tab khác!",
            ]);
            return FALSE;
        }
        ////</editor-fold>

        $color_count = $data["color_count"];
        $mce_count = $data["mce_count"];
        if (empty($mce_count)) if (empty($color_count)) {
            echo json_encode([
                //"callback" => "show_error",
                "state" => 0,
                "msg"   => "Bạn vẫn chưa nhập thông tin nào.",
            ]);
            return FALSE;
        }

        $old_color_count = 0;
        $old_mce_count = 0;
        $old_0_colors = FALSE;
        if (isset($old_order_detail)) {
            $old_order_detail = $this->_get_order_detail($order_id);
            $old_color_count = count($old_order_detail[0]['colors']);
            $old_mce_count = count($old_order_detail);
            $old_0_colors = $old_order_detail[0]['colors'];
        }
        $arr_insert_color_id = [];

        //Insert new colors
        for ($color_index = $old_color_count; $color_index < $color_count; $color_index++) {
            $arr_insert_color_id[$color_index] = $this->color->insert([
                'name' => $data["color_name_0_{$color_index}"],
            ], TRUE);
            if (!$arr_insert_color_id[$color_index]) {
                $this->_notify_can_not_insert($data_return);
                return FALSE;
            }
        }

        $arr_size = [1 => 'xs', 2 => 's', 3 => 'm', 4 => 'l', 5 => 'xl', 6 => 'xxl'];

        //<editor-fold desc="Update exited prepacks">
        if (isset($old_order_detail)) foreach ($old_order_detail as $order_detail_id => $order_detail) {
            $old_colors = $order_detail['colors'];
            $prepack_id = $order_detail['detail']->id;

            //update old prepacks_colors
            foreach ($old_colors as $color_id => $color) {
                $this->prepack_color->update($color->id, [
                    'quantity' => $data["color_quantity_{$order_detail_id}_{$color_id}"],
                ], TRUE);
            }

            //insert new prepacks_colors
            for ($color_index = $old_color_count; $color_index < $color_count; $color_index++) {
                $insert_prepack_color_id = $this->prepack_color->insert([
                    'prepack_id' => $prepack_id,
                    'color_id'   => $arr_insert_color_id[$color_index],
                    'quantity'   => $data["color_quantity_{$order_detail_id}_{$color_index}"],
                ], TRUE);
                if (!$insert_prepack_color_id) {
                    $this->_notify_can_not_insert();
                    return FALSE;
                }
            }

            $old_sizes = $order_detail['sizes'];
            //update old prepacks_sizes
            foreach ($old_sizes as $size) {
                $this->prepack_size->update($size->id, [
                    'rate' => $data["mce_rate_{$order_detail_id}_{$size->size_name}"],
                ], TRUE);
            }
        }
        ////</editor-fold>

        //<editor-fold desc="Insert new prepacks">
        for ($mce_index = $old_mce_count; $mce_index < $mce_count; $mce_index++) {
            $insert_mce_id = $this->prepack->insert([
                'name'     => $data["mce_name_{$mce_index}"],
                'order_id' => $order_id,
            ], TRUE);
            if (!$insert_mce_id) {
                $this->_notify_can_not_insert($data_return);
                return FALSE;
            }

            foreach ($arr_size as $size_id => $size_name) {
                $insert_prepack_size_id = $this->prepack_size->insert([
                    'prepack_id' => $insert_mce_id,
                    'size_id'    => $size_id,
                    'rate'       => $data["mce_rate_{$mce_index}_{$size_name}"],
                ], TRUE);
                if (!$insert_prepack_size_id) {
                    $this->_notify_can_not_insert($data_return);
                    return FALSE;
                }
            }

            //insert prepacks_colors with old colors
            if ($old_0_colors) foreach ($old_0_colors as $color_index => $color) {
                $insert_prepack_color_id = $this->prepack_color->insert([
                    'prepack_id' => $insert_mce_id,
                    'color_id'   => $color->color_id,
                    'quantity'   => $data["color_quantity_{$mce_index}_{$color_index}"],
                ], TRUE);
                if (!$insert_prepack_color_id) {
                    $this->_notify_can_not_insert();
                    return FALSE;
                }
            }

            //insert new prepacks_colors
            for ($color_index = $old_color_count; $color_index < $color_count; $color_index++) {
                $insert_prepack_color_id = $this->prepack_color->insert([
                    'prepack_id' => $insert_mce_id,
                    'color_id'   => $arr_insert_color_id[$color_index],
                    'quantity'   => $data["color_quantity_{$mce_index}_{$color_index}"],
                ], TRUE);
                if (!$insert_prepack_color_id) {
                    $this->_notify_can_not_insert();
                    return FALSE;
                }
            }
        }
        ////</editor-fold>

        //<editor-fold desc="Generate $data_return">
        $key_field = $this->model->get_primary_key();
        $data[$key_field] = $order_id;
        $data_return["key_name"] = $key_field;
        $data_return["record"] = $data;
        $data_return["state"] = 1; /* state = 1 : insert thành công */
        $data_return["msg"] = "Thêm bản ghi thành công";
        //$data_return["redirect"] = "detail";
        echo json_encode($data_return);
        ////</editor-fold>

        return $order_id;
    }

    /**
     * Save information to database (tables materials and material_balances) from add_order_material
     * (form_material_detail) in tab_material
     *
     * @param array $data
     * @param array $data_return
     * @param bool $skip_validate
     */
    public function save_add_order_material($data = Array(), $data_return = Array(), $skip_validate = FALSE) {
        //TODO Validate
        if (sizeof($data) == 0) {
            $data = $this->input->post();
        }
        $order_id = NULL;
        if (!isset($data['order_id'])) {
            if (!$this->_order_id) {
                echo json_encode([
//                    "callback" => "show_error",
                    "state" => 0,
                    "msg"   => "Bạn cần gửi 'Thông tin chung' trước khi điền những tab khác!",
                ]);
                return FALSE;
            }
            $order_id = $this->_order_id;
        } else {
            $order_id = $data["order_id"];
        }

        $new_material = [
            'name'        => $data["material_name"],
            'description' => $data["material_description"],
            'unit'        => $data["material_unit"],
            'note'        => $data["material_note"],
        ];
        $insert_material_id = $this->material->insert($new_material, TRUE);

        if (!$insert_material_id) {
            $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
            $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
            echo json_encode($data_return);
            return FALSE;
        }

        $size_count = $data["size_count"];
        for ($i = 0; $i < $size_count; $i++) {
            $new_size = [
                'name' => $data["size_name_$i"],
            ];
            $insert_size_id = $this->size->insert($new_size, TRUE);

            if (!$insert_size_id) {
                $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
                $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
                echo json_encode($data_return);
                return FALSE;
            }

            $quantity_issued = $data["size_quantity_issued_$i"];
            $quantity_factual = $data["size_quantity_factual_$i"];
            $new_material_balance = [
                'order_id'         => $order_id,
                'color_id'         => $data["material_color"],
                'size_id'          => $insert_size_id,
                'material_id'      => $insert_material_id,
                'cons'             => $data["size_cons_$i"],
                'quantity'         => $data["size_quantity_$i"],
                'quantity_issued'  => $quantity_issued,
                'quantity_factual' => $quantity_factual,
                'balance'          => $quantity_issued - $quantity_factual,
                'note'             => $data["material_note"],
            ];
            $insert_material_balance_id = $this->material_balance->insert($new_material_balance, TRUE);

            if (!$insert_material_balance_id) {
                $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
                $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
                echo json_encode($data_return);
                return FALSE;
            }
        }

        $key_field = $this->model->get_primary_key();
        $data[$key_field] = $order_id;
        $data_return["key_name"] = $key_field;
        $data_return["record"] = $data;
        $data_return["state"] = 1; /* state = 1 : insert thành công */
        $data_return["msg"] = "Thêm bản ghi thành công";
        $data_return["redirect"] = "material";
        echo json_encode($data_return);
        return $order_id;
    }

    /**
     * Get the data of entry_detail from table prepacks, prepacks_colors and prepacks_sizes
     *
     * @param int $order_id The id of the order you want to get detail
     * @param array $data_return
     * @return array|null
     */
    private function _get_order_detail($order_id = 0, $data_return = Array()) {
        $prepacks = $this->prepack->get_by_order_id($order_id);
        if (!$prepacks) return NULL;
        foreach ($prepacks as $prepack) {
            $prepack_id = $prepack->id;
            $colors = $this->prepack_color->get_by_prepack_id($prepack_id);
            $sizes = $this->prepack_size->get_by_prepack_id($prepack_id);
            $return_prepack = [
                'detail' => $prepack,
                'colors' => $colors,
                'sizes'  => $sizes,
            ];
            array_push($data_return, $return_prepack);
            //            $data_return[$prepack_id] = $return_prepack;
        }
        return $data_return;
    }

    /**
     * Get the list of material details (of an order) which contain materials and them sizes
     *
     * @param $order_id    The id of the order that you want to get material details, if this param is null, return
     *                     null
     * @param $material_id The id of the material that you want to get details, if this param is null, load all
     *                     materials of the order having id '$order_id'
     * @return array|null Get the list of material details (of an order) which contain materials and them sizes
     */
    private function _get_material_detail_list($order_id = 0, $material_id = NULL) {
        $material_balance_list = $this->material_balance->get_material_balance_list($order_id, $material_id);
        if (!$material_balance_list) return NULL;
        $result = [];

        foreach ($material_balance_list as $material_balance_row) {
            $each_material_id = $material_balance_row->material_id;
            if (empty($result[$each_material_id])) {
                $each_material = [];
                $each_material["detail"] = $this->material->get($each_material_id);
                $each_material["detail"]->{"color_id"} = $material_balance_row->color_id;
                $each_material["sizes"] = [];
                $each_material["sizes"][$material_balance_row->id] = $material_balance_row;
                $result[$each_material_id] = $each_material;
            } else {
                $result[$each_material_id]["size"][$material_balance_row->id] = $material_balance_row;
            }
        }

        return $result;
    }

    private function _have_permission() {
        if (!$this->is_in_group('admin') && !$this->is_in_group('corporation') && !$this->is_in_group("ppc")) {
            echo json_encode([
                "callback" => "permission_error",
                "state"    => 0,
                "msg"      => "Bạn không có quyền thực hiện điều này!",
            ]);
        }
        return TRUE;
    }

    private function _notify_can_not_insert($data_return = Array()) {
        $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
        $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
        echo json_encode($data_return);
    }

    protected function add_action_button($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $primary_key = $this->model->get_primary_key();
        $custom_action = "<div class='action-buttons'>";
        $custom_action .= "<a class='e_ajax_link blue' href='" . site_url($this->url["view"] . $record->$primary_key) . "'><i class='ace-icon fa fa-search-plus bigger-130'></i></a>";
        if ((!isset($record->disable_edit) || !$record->disable_edit)) {
            $custom_action .= "<a class='green' href='" . site_url($this->name["class"] . "/entry/" . $record->$primary_key) . "'><i class='ace-icon fa fa-pencil bigger-130'></i></a>";
            $custom_action .= "<a class='e_ajax_link e_ajax_confirm red' href='" . site_url($this->url["delete"] . $record->$primary_key) . "'><i class='ace-icon fa fa-trash-o  bigger-130'></i></a>";
        }
        $custom_action .= "</div>";
        return $custom_action;
    }
}