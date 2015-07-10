<?php

class Mdl extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table($table) {
        $result = $this->db->get($table);
        return $result->result_array();
        ;
    }

    function get($table, $order_by) {
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_with_limit($table, $limit, $offset, $order_by) {
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where($table, $id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table)->result_array();
        return $query;
    }

    function get_where_custom($table, $array) {
        $this->db->where($array);
        $query = $this->db->get($table);
        return $query;
    }

    function _insert($table, $data) {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    function _update($table, $id, $data) {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    function _delete($table, $id) {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function count_where($table, $column, $value) {
        $table = $this->get_table();
        $this->db->where($column, $value);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_all($table) {
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_max($table) {
        $this->db->select_max('id');
        $query = $this->db->get($table);
        $row = $query->row();
        $id = $row->id;
        return $id;
    }

    function _custom_query($sql) {
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

}
