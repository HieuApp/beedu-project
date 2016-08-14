<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Manager_base
 *
 * Lớp abstract quản lý thông tin bảng của hệ thống admin
 *
 * @package manager_base
 * @author  Pham Trong <phamtrong204@gmail.com>
 * @version 0.0.0
 */
abstract class Manager_base extends Admin_layout {

    /**
     * Mảng config URL được dùng trong các hàm quản lý
     * Biến này được mô tả chi tiết trong lớp này <b>sau khi hàm setting_class được gọi</b>
     * Cấu trúc mảng:
     * <pre>
     * Array (
     *      "view"      => "", <i>String: Url <b>Xem chi tiết</b> bản ghi</i>
     *      "add"       => "", <i>String: Url <b>Thêm</b> bản ghi</i>
     *      "edit"      => "", <i>String: Url <b>Sửa</b> bản ghi</i>
     *      "delete"    => "", <i>String: Url <b>Xóa</b> bản ghi</i>
     *      "manager"   => "", <i>String: Url <b>Quản lý</b> các bản ghi</i>
     *      "search"    => "", <i>String: Url <b>Tìm kiếm</b> bản ghi</i>
     * )
     * </pre>
     *
     * @var Array ()
     */
    public $url = Array(
        "view"    => "",
        "add"     => "",
        "edit"    => "",
        "delete"  => "",
        "manager" => "",
        "search"  => "",
    );

    /**
     * Mảng config name được dùng trong các hàm quản lý
     * <b>Biến này được mô tả chi tiết trong các lớp kế thừa</b>
     * Cấu trúc mảng:
     * <pre>
     * Array (
     *      "class"  => "", <i>String: Tên class
     *      "view"   => "", <i>String: Tên view
     *      "model"  => "", <i>String: Tên model
     *      "object" => "", <i>String: Tên hiển thị của object
     * )
     * </pre>
     *
     * @var Array
     */
    public $name = Array(
        "class"  => "",
        "view"   => "",
        "model"  => "",
        "object" => "",
    );

    /**
     * Số nút hiển thị ở khu vực phân trang
     */
    public $paging_item_display = 7;
    public $item_per_page = 20;
    public $path_theme_view = "admin/";

    public $event_hook = Array();

    public function __construct() {
        parent::__construct();
        $this->setting_class();
        $this->load->model($this->name["model"], "model");
        $this->url["add"] = site_url($this->name["class"] . "/add");
        $this->url["view"] = $this->name["class"] . "/view/";
        $this->url["edit"] = $this->name["class"] . "/edit/";
        $this->url["delete"] = $this->name["class"] . "/delete/";
        $this->url["manager"] = site_url($this->name["class"] . "/manager");
        $this->url["search"] = site_url($this->name["class"] . "/search");
    }

    /**
     * Hàm index, tự động gọi tới hàm manager
     */
    public function index() {
        $this->manager();
    }

    /**
     * Hàm cài đặt biến $name cho controller (xem trong 1 controller bất kỳ để biết chi tiết)
     */
    abstract function setting_class();

    /**
     * Hàm gọi view hiển thị form <b>thêm</b> bản ghi
     *
     * @param Array $data Biến muốn gửi thêm để hiển thị ra view(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi tới)
     *
     * @return action trả dữ liệu về phía client (json nếu là ajax, html nếu ko)
     */
    public function add($data = Array()) {
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        if (!isset($data["save_link"])) {
            $data["save_link"] = site_url($this->name["class"] . "/add_save");
        }
        $this->set_data_part("title", "Thêm  " . $this->name["object"], FALSE);
        $data_return = Array();
        $form_html = $this->get_form_html($data);
        $data_return["callback"] = "get_form_add_response";
        if ($this->input->is_ajax_request()) {
            $data_return["state"] = 1;
            $data_return["html"] = $form_html;
            echo json_encode($data_return);
            return TRUE;
        } else {
            $this->show_page($form_html);
        }
    }

    /**
     * Hàm xử lý lưu trữ bản ghi mới
     *
     * @param Array   $data          Biến muốn gửi thêm để <b>hiển thị ra view</b>(dùng khi hàm khác gọi tới hoặc hàm
     *                               ghi đè gọi tới)
     * @param Array   $data_return   Biến muốn gửi thêm <b>vào kết quả trả về</b>(dùng khi hàm khác gọi tới hoặc hàm
     *                               ghi
     *                               đè gọi tới)
     * @param boolean $skip_validate Có cần validate lại dữ liệu hay không?
     *
     * @return action trả dữ liệu về phía client (json nếu là ajax, html nếu ko)
     */
    public function add_save($data = Array(), $data_return = Array(), $skip_validate = FALSE) {
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        $data_return["callback"] = "save_form_add_response";
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
//            $data_return["redirect"] = $this->url["manager"];
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
     * Hàm gọi view hiển thị form <b>sửa</b> bản ghi<br>
     * Trong cơ sở dữ liệu có trường 'is_editable' = 0 thì sẽ ko chỉnh sửa được
     *
     * @param int   $id   id của bản ghi cần sửa
     * @param Array $data Biến muốn gửi thêm để hiển thị ra view(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi tới)
     *
     * @return json trả dữ liệu về phía client JSON
     */
    public function edit($id = 0, $data = Array()) {
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        $data_return = Array();
        $data_return["callback"] = "get_form_edit_response";
        if (!$id) {
            $data_return["state"] = 0;
            $data_return["msg"] = "Id không tồn tại";
            echo json_encode($data_return);
            return FALSE;
        }
        if (!isset($data["save_link"])) {
            $data["save_link"] = site_url($this->name["class"] . "/edit_save/" . $id);
        }
        $this->set_data_part("title", "Sửa " . $this->name["object"], FALSE);
        $data_return["record_data"] = $this->model->get($id);
        $form_html = $this->get_form_html($data, $data_return["record_data"]);
//        $data_return["form"] = $this->model->get_form();
        if ($this->input->is_ajax_request()) {
            $data_return["state"] = 1;
            $data_return["html"] = $form_html;
            echo json_encode($data_return);
            return TRUE;
        } else {
            $this->show_page($form_html);
        }
    }

    /**
     * Hàm xử lý lưu trữ bản ghi mới
     * Trong cơ sở dữ liệu có trường 'is_editable' = 0 thì sẽ ko chỉnh sửa được
     *
     * @param int     $id            id của bản ghi cần sửa
     * @param Array   $data          Biến muốn gửi thêm để <b>hiển thị ra view</b>(dùng khi hàm khác gọi tới hoặc hàm
     *                               ghi đè gọi tới)
     * @param Array   $data_return   Biến muốn gửi thêm <b>vào kết quả trả về</b>(dùng khi hàm khác gọi tới hoặc hàm
     *                               ghi đè gọi tới)
     * @param boolean $skip_validate Có cần validate lại dữ liệu hay không?
     *
     * @return json trả dữ liệu về phía client JSON
     */
    public function edit_save($id = 0, $data = Array(), $data_return = Array(), $skip_validate = FALSE) {
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        if (!isset($data_return["callback"])) {
            $data_return["callback"] = "save_form_edit_response";
        }
        if (sizeof($data) == 0) {
            $data = $this->input->post();
        }

        $id = intval($id);
        if (!$id) {
            $data_return["state"] = 0; /* state = 0 : dữ liệu không hợp lệ */
            $data_return["msg"] = "Bản ghi không tồn tại";
            echo json_encode($data_return);
            return FALSE;
        }
        if (sizeof($data) == 0) {
            $data = $this->input->post();
        }
        $update = $this->model->update($id, $data, $skip_validate);
        if ($update) {
            $data_return["key_name"] = $this->model->get_primary_key();
            $data_return["record"] = $this->standard_record_data($this->model->get($id));
            $data_return["state"] = 1; /* state = 1 : insert thành công */
            $data_return["msg"] = "Sửa bản ghi thành công.";
//            $data_return["redirect"] = $this->url["manager"];
            echo json_encode($data_return);
            return TRUE;
        } else {
            $data_return["data"] = $data;
            $data_return["state"] = 0; /* state = 0 : dữ liệu không hợp lệ */
            $data_return["msg"] = "Dữ liệu gửi lên không hợp lệ";
            $data_return["error"] = $this->model->get_validate_error();
            echo json_encode($data_return);
            return FALSE;
        }
    }

    /**
     * Hàm xóa bản ghi, có 2 cách truyền dữ liệu, 1 là uri khi xóa 1 bản ghi hoặc post lên biến 'list_id' để xóa nhiều
     * bản ghi cùng lúc
     *
     * @param int   $id   ID bản ghi cần xóa
     * @param Array $data Biến muốn gửi thêm để <b>hiển thị ra view</b>(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi
     *                    tới)
     *
     * @return json Gửi biến json về client
     */
    public function delete($id = 0, $data = Array()) {
        $id = intval($id);
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        $data_return["callback"] = "delete_respone";
        if ($this->input->post() || $id > 0) {
            if (isset($data["list_id"]) && sizeof($data["list_id"])) {
                $list_id = $data["list_id"];
            } else {
                if ($this->input->post() && $id == "0") {
                    $list_id = $this->input->post("list_id");
                } elseif ($id > 0) {
                    $list_id = Array($id);
                }
            }
            $affected_row = $this->model->delete_many($list_id);
            if ($affected_row) {
                $data_return["list_id"] = $list_id;
                $data_return["state"] = 1;
                $data_return["msg"] = "Xóa bản ghi thành công";
            } else {
                $data_return["list_id"] = $list_id;
                $data_return["state"] = 0;
                $data_return["msg"] = "Bản ghi đã được xóa từ trước hoặc không thể bị xóa. Vui lòng tải lại trang!";
            }

            echo json_encode($data_return);
            return TRUE;
        } else {
            $data_return["state"] = 0;
            $data_return["msg"] = "Id không tồn tại";
            echo json_encode($data_return);
            return FALSE;
        }
    }

    /**
     * Hàm gọi view hiển thị form <b>xem</b> bản ghi<br>
     *
     * @param int   $id   ID của bản ghi cần sửa
     * @param Array $data Biến muốn gửi thêm để hiển thị ra view(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi tới)
     *
     * @return json trả dữ liệu về phía client JSON, nếu ko ajax thì sẽ hiển thị html
     */
    public function view($id = 0, $data = Array()) {
        if (FALSE) { //Kiểm tra phân quyền
            redirect();
            return FALSE;
        }
        $data_return["callback"] = "get_data_view_response";
        if (!$id) {
            $data_return["state"] = 0;
            $data_return["msg"] = "Id không tồn tại";
            echo json_encode($data_return);
            return FALSE;
        }

        if (!isset($data["save_link"])) {
            $data["save_link"] = site_url($this->name["class"] . "/edit_save");
        }

        if (!isset($data["list_input"])) {
            $data["list_input"] = $this->_get_form($id);
        }
        $data["title"] = $title = "Xem dữ liệu " . $this->name["object"];

        $viewFile = "base_manager/form";
        if (file_exists(APPPATH . "views/" . $this->path_theme_view . $this->name["view"] . '/form.php')) {
            $viewFile = $this->name["view"] . '/form';
        }
        $content = $this->load->view($this->path_theme_view . $viewFile, $data, TRUE);

        $data_return["record_data"] = $this->model->get_one($id);
        if ($this->input->is_ajax_request()) {
            $data_return["state"] = 1;
            $data_return["html"] = $content;
            echo json_encode($data_return);
            return TRUE;
        }
        $head_page = $this->load->view($this->path_theme_view . 'base_manager/header_view', $data, TRUE);
        if (file_exists(APPPATH . "views/" . $this->path_theme_view . $this->name["view"] . '/header.php')) {
            $head_page .= $this->load->view($this->path_theme_view . $this->name["view"] . '/header', $data, TRUE);
        }
        if (file_exists(APPPATH . "views/" . $this->path_theme_view . $this->name["view"] . '/header_view.php')) {
            $head_page .= $this->load->view($this->path_theme_view . $this->name["view"] . '/header_view', $data, TRUE);
        }
        $title = "Sửa " . $this->name["object"];

        $this->master_page($content, $head_page, $title);
    }

    /**
     * Hàm hiển thị bảng quản lý cơ sở dữ liệu
     *
     * @param Array $data Biến muốn gửi thêm để <b>hiển thị ra view</b>(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi
     *                    tới)
     */
    public function manager($data = Array()) {
        if (!isset($data["add_link"])) {
            $data["add_link"] = $this->url["add"];
        }
        if (!isset($data["delete_list_link"])) {
            $data["delete_list_link"] = site_url($this->url["delete"]);
        }
        if (!isset($data["ajax_data_link"])) {
            $data["ajax_data_link"] = site_url($this->name["class"] . "/ajax_list_data");
        }
        if (!isset($data["title"])) {
            $data["title"] = "Quản lý " . $this->name["object"];
        }
        if (isset($data["view_file"])) {
            $view_file = $data["view_file"];
        } else {
            $view_file = $this->path_theme_view . "base_manager/manager_container";
        }
        unset($data["view_file"]);
        $data['filter_html'] = $this->get_filter_html($data);
        $data['table_header'] = $this->get_table_header($data);
        $content = $this->load->view($view_file, $data, TRUE);
        $this->set_html_part('title', "Quản lý " . $this->name["object"]);
        $this->show_page($content);
    }

    /**
     * Hàm lấy dữ liệu của một danh sách bản ghi
     * Hàm này có cấu trúc nhận dữ liệu POST khá phức tạp bao gồm
     *      - q     => chuỗi tìm kiếm
     *      - limit => Số bản ghi muốn lấy ra
     *      - order => sắp xếp theo thứ tự nào
     *      - page  => trang đang xem
     * Mặc định các biến này được quản lý ở file form.js, chỉ cần quan tâm khi viết đè
     *
     * @param Array $data Biến muốn gửi thêm để hiển thị ra view(dùng khi hàm khác gọi tới hoặc hàm ghi đè gọi tới)
     *
     * @return json Gửi dữ liệu json về client
     */
    public function ajax_list_data($data = Array()) {
        $condition = $this->input->post();
        $data_paging = $this->get_paging_data($condition);
        $data_order = $this->get_order_data($condition);
        $data = array_merge($data, $data_paging, $data_order);
        $filter = isset($condition["filter"]) ? $condition["filter"] : [];
        $query_cond = $this->model->standard_filter_data($filter);
        $record = $this->model->get_list_filter(
            $query_cond['where'], $query_cond['where_in'], $query_cond['like'],
            $data['limit'], $data['post'], $data['order_db']
        );
        $data['sql'] = $this->db->last_query();
        $data['columns'] = $this->get_column_data();
        $data['record'] = $this->standard_record_data($record, $data['columns']);
        $data["key_name"] = $this->model->get_primary_key();
        $data["filter"] = $filter;

        if (isset($data['view_file'])) {
            $view_file = $data['view_file'];
        } else {
            $view_file = $this->path_theme_view . "base_manager/table_data";
        }

        $content = $this->load->view($view_file, $data, TRUE);
        if ($this->input->is_ajax_request()) {
            if (isset($data['callback'])) {
                $data_return["callback"] = $data['callback'];
            } else {
                $data_return["callback"] = "get_manager_data_response";
            }
            $data_return["state"] = 1;
//            $data_return["data"] = $data;
            $data_return["html"] = $content;
            echo json_encode($data_return);
            return TRUE;
        } else {
            $this->show_page($content);
        }
    }

    protected function standard_record_data($records, $columns = NULL) {
        if (!$columns) {
            $columns = $this->get_column_data();
        }
        if (is_array($records)) {
            foreach ($records as &$record) {
                $record = $this->standard_record_data($record, $columns);
            }
        } else {
            foreach ($columns as $column_name => $column_data) {
                $origin_column_value = isset($records->$column_name) ? $records->$column_name : NULL;
                if (isset($column_data['table']['callback_render_data'])) {
                    $callback_render_data = $column_data['table']['callback_render_data'];
                    if (is_array($callback_render_data)) {
                        foreach ($callback_render_data as $callback) {
                            if (method_exists($this, $callback)) {
                                $call_scope = $this;
                            } elseif (method_exists($this->model, $callback)) {
                                $call_scope = $this->model;
                            } else {
                                throw new Exception("['table']['callback_render_data'] of '$column_name'(function '$callback') 
                                does not exist at both controller ({$this->name['class']}) and model ({$this->name['model']})!");
                            }
                            $records->$column_name = call_user_func_array(
                                Array($call_scope, $callback),
                                Array($origin_column_value, $column_name, &$records, $column_data, $this)
                            );
                        }
                    } else if (is_string($callback_render_data)) {
                        if (method_exists($this, $callback_render_data)) {
                            $call_scope = $this;
                        } elseif (method_exists($this->model, $callback_render_data)) {
                            $call_scope = $this->model;
                        } else {
                            throw new Exception("['table']['callback_render_data'] of '$column_name'(function '$callback_render_data') 
                            does not exist at both controller ({$this->name['class']}) and model ({$this->name['model']})!");
                        }
                        $records->$column_name = call_user_func_array(
                            Array($call_scope, $callback_render_data),
                            Array($origin_column_value, $column_name, &$records, $column_data, $this)
                        );
                    } else {
                        throw new Exception("['table']['callback_render_data'] of $column_name must be 'string' or 'array'!");
                    }
                }
            }
        }
        return $records;
    }

    protected function get_paging_data($condition) {
        $data = Array();
        $limit = intval(isset($condition["limit"]) ? $condition["limit"] : $this->item_per_page);
        $filter = isset($condition["filter"]) ? $condition["filter"] : [];
        $current_page = intval(isset($condition["page"]) ? $condition["page"] : 1);
        if ($limit < 0) {
            $limit = 0;
        }
        /* If change limit or change filter: reset page to 1 */
        $old_condition = $this->session->userdata('table_manager_condition');
        $old_limit = intval(isset($old_condition["limit"]) ? $old_condition["limit"] : $this->item_per_page);
        $old_filter = isset($old_condition["filter"]) ? $old_condition["filter"] : [];
        ksort($filter);
        ksort($old_filter);
        if (($limit != $old_limit) || (json_encode($filter) != json_encode($old_filter))) {
            $current_page = 1;
        }
        //Update session condition after reset page
        $this->session->set_userdata('table_manager_condition', $condition);
        $post = ($current_page - 1) * $limit;
        if ($post < 0) {
            $post = 0;
            $current_page = 1;
        }
        $query_cond = $this->model->standard_filter_data($filter);
        $total_item = $this->model->get_list_filter_count($query_cond['where'], $query_cond['where_in'], $query_cond['like']);
        if ($limit != 0) {
            $total_page = (int)($total_item / $limit);
        } else {
            $total_page = 0;
        }
        if (($total_page * $limit) < $total_item) {
            $total_page += 1;
        }
        $link = "#";
        $data["paging"] = $this->_get_paging($total_page, $current_page, $this->paging_item_display, $link);
        $data["from"] = $post + 1;
        $data["to"] = $post + $limit;
        if ($data["to"] > $total_item || $limit == 0) {
            $data["to"] = $total_item;
        }
        $data["limit"] = $limit;
        $data["post"] = $post;
        $data["total"] = $total_item;
        return $data;
    }

    /**
     * Chuẩn hoá order data
     *
     * @param $condition
     *
     * @return mixed
     */
    protected function get_order_data($condition) {
        $order = isset($condition["order"]) ? $condition["order"] : NULL;
        $order_db = Array();
        $order_view = Array();
        $temp = explode(",", $order);
        for ($i = 0; $i < sizeof($temp); $i++) {
            $temp[$i] = trim($temp[$i]);
            $order_piece = explode(" ", $temp[$i]);
            /* Kiểm tra xem trường order có trong schema ko và giá trị sắp xếp có là asc hoặc desc ko? */
            if (sizeof($order_piece) == 2 &&
                array_key_exists($order_piece[0], $this->model->schema) &&
                ($order_piece[1] == "asc" || $order_piece[1] == "desc")
            ) {
                $order_key = $order_piece[0];
                $db_key = $this->model->schema[$order_key]['db_field'];
                $order_db[$db_key] = $order_piece[1];
                $order_view[$order_key] = $order_piece[1];
            } else {
                unset($temp[$i]);
            }
        }
        $data["order_db"] = $order_db;
        $data["order_view"] = $order_view;
        return $data;
    }

    protected function get_filter_html($data = Array()) {
        $data['form_id'] = uniqid();
        $data['filter'] = $this->model->get_filter();
        foreach ($data['filter'] as $key => &$item) {
            $item['html'] = $this->render_filter_item($item, $data['form_id']);
        }
        if (isset($data['view_file'])) {
            $view_file = $data['view_file'];
        } else {
            $view_file = $this->path_theme_view . "/base_manager/table_filter";
        }
        $filter_html = $this->load->view($view_file, $data, TRUE);
        return $filter_html;
    }

    protected function render_filter_item($form_item, $form_id) {
        $data = [
            'form_item' => $form_item,
            'form_id'   => $form_id,
        ];
        if (isset($form_item['filter']['callback_render_html'])) {
            $callback = $form_item['filter']['callback_render_html'];
            if (is_string($callback)) {
                if (method_exists($this, $callback)) {
                    $call_scope = $this;
                } elseif (method_exists($this->model, $callback)) {
                    $call_scope = $this->model;
                } else {
                    throw new Exception("['filter']['callback_render_html'] of field '$form_item[field]'(function '$callback') 
                    does not exist at both controller ({$this->name['class']}) and model ({$this->name['model']})!");
                }
                return call_user_func_array(
                    Array($call_scope, $callback),
                    Array($form_item, $form_id, $this)
                );
            } else {
                throw new Exception("['filter']['callback_render_html'] of $form_item[field] must be 'string'!");
            }
        }
        return $this->load->view($this->path_theme_view . "/base_manager/table_filter_item", $data, TRUE);
    }

    protected function get_form_html($data = Array(), $record = NULL) {
        $data['form_id'] = uniqid();
        $data['form_title'] = "Thêm " . $this->name['object'];
        $data['form'] = $this->model->get_form();
        $data['is_edit'] = ($record === NULL) ? "0" : "1";
        foreach ($data['form'] as $key => &$item) {
            $value = NULL;
            if (isset($record->$key)) {
                $value = $record->$key;
            }
            $item['html'] = $this->render_form_item($item, $data['form_id'], $value);
        }
        if (isset($data['view_file'])) {
            $view_file = $data['view_file'];
        } else {
            $view_file = $this->path_theme_view . "/base_manager/form";
        }
        $form_html = $this->load->view($view_file, $data, TRUE);
        return $form_html;
    }

    protected function render_form_item($form_item, $form_id, $value = NULL) {
        $data = [
            'form_item' => $form_item,
            'form_id'   => $form_id,
            'value'     => $value,
        ];
        if (isset($form_item['form']['callback_render_html'])) {
            $callback = $form_item['form']['callback_render_html'];
            if (is_string($callback)) {
                if (method_exists($this, $callback)) {
                    $call_scope = $this;
                } elseif (method_exists($this->model, $callback)) {
                    $call_scope = $this->model;
                } else {
                    throw new Exception("['form']['callback_render_html'] of '$form_item[field]'(function '$callback') 
                    does not exist at both controller ({$this->name['class']}) and model ({$this->name['model']})!");
                }
                return call_user_func_array(
                    Array($call_scope, $callback),
                    Array($form_item, $form_id, $value, $this)
                );
            } else {
                throw new Exception("['form']['callback_render_html'] of $form_item[field] must be 'string'!");
            }
        }
        return $this->load->view($this->path_theme_view . "/base_manager/form_item", $data, TRUE);
    }

    protected function get_table_header($data = Array()) {
        if (!isset($data["delete_list_link"])) {
            $data["delete_list_link"] = site_url($this->url["delete"]);
        }
        $filter_html = $this->load->view($this->path_theme_view . 'base_manager/table_header', $data, TRUE);
        return $filter_html;
    }

    /**
     * Hàm thêm cột vào bản ghi trước khi đưa ra bảng quản lý
     * Mặc định hàm này sẽ thêm 2 cột là cột chứa 3 nút (thêm, sửa xóa) và cột "input"
     *
     * @param Array $record Mảng chứa các bản ghi
     *
     * @return type
     */
    protected function get_column_data() {
        $columns = Array();
        /* Thêm cột check */
        $columns["custom_check"] = Array(
            'label' => "<input type='checkbox' class='e_check_all' />",
            'table' => Array(
                'callback_render_data' => 'add_check_box',
                'class'                => '"min-width center"',
            ),
        );
        $schema_column = $this->model->get_table_field();
        $columns = array_merge($columns, $schema_column);
        /* Thêm cột action */
        $columns["custom_action"] = Array(
            'label' => "Action",
            'table' => Array(
                'callback_render_data' => 'add_action_button',
                'class'                => '"no-wrap center"',
            ),
        );
        return $columns;
    }

    /**
     * Hàm lấy html view khu vực phân trang
     *
     * @param type $total   = Tổng số trang
     * @param type $current = Trang hiện tại
     * @param type $display = Số link hiển thị
     * @param type $link    = Link gốc
     * @param type $key     = Key cần thêm
     *
     * @return type HtmlString
     */
    protected function _get_paging($total, $current, $display, $link, $key = "p") {
        $data["total_page"] = $total;
        $data["current_page"] = $current;
        $data["page_link_display"] = $display;
        $data["link"] = $link;

        $data["key"] = $key;
        return $this->load->view($this->path_theme_view . "base_manager/paging", $data, TRUE);
    }

    protected function add_check_box($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $primary_key = $this->model->get_primary_key();
        return "<input type='checkbox' name='_e_check_all' data-id='" . $record->$primary_key . "' />";
    }

    protected function add_action_button($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $primary_key = $this->model->get_primary_key();
        $custom_action = "<div class='action-buttons'>";
//        $custom_action .= "<a class='e_ajax_link blue' href='" . site_url($this->url["view"] . $record->$primary_key) . "'><i class='ace-icon fa fa-search-plus bigger-130'></i></a>";
        if ((!isset($record->disable_edit) || !$record->disable_edit)) {
            $custom_action .= "<a class='e_ajax_link green' href='" . site_url($this->url["edit"] . $record->$primary_key) . "'><i class='ace-icon fa fa-pencil bigger-130'></i></a>";
            $custom_action .= "<a class='e_ajax_link e_ajax_confirm red' href='" . site_url($this->url["delete"] . $record->$primary_key) . "'><i class='ace-icon fa fa-trash-o  bigger-130'></i></a>";
        }
        $custom_action .= "</div>";
        return $custom_action;
    }

    protected function timestamp_to_date($origin_column_value) {
        if (intval($origin_column_value)) {
            return date('Y-m-d H:i:s', $origin_column_value);
        } else {
            return $origin_column_value;
        }
    }

    protected function is_in_group($group_name, $break = FALSE) {
        return $this->model->is_in_group($group_name, $break);
    }
}

/* End of file manager_base.php */
/* Location: ./application/base/manager_base.php */