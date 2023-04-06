<?php

class AdminLanguageModel extends CI_Model
{
    protected $table = 'languages';
    protected $key = 'language_id';

    public function getLanguage($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('languages');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('languages');
    }

    public function getSelected()
    {
        $this->db->where('is_selected', 1);
        $result = $this->db->get('languages');
        return ($result->num_rows() == 1) ? $result->row(0)->slug : '';
    }

    public function storeLanguage($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('language_id', $edit);
            $langUpdate['updated_at'] = date('Y-m-d G:i:s');
            $langUpdate['title'] = $data['language_title'];
            $langUpdate['slug'] = makeSlug($data['language_title']);
            $this->db->update('languages', $langUpdate);
        } else {
            $data['slug'] = makeSlug($data['title']);
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->insert('languages', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title'], 'slug' => $data['slug']);
        }
    }

    public function changeStatus($language_id, $status)
    {
        $this->db->where('language_id', $language_id);
        $this->db->update('languages', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function changeSelected($language_id)
    {
        //First making all disabled
        $this->db->update('languages', array('is_selected' => 0));

        //Second making selected enabled
        $this->db->where('language_id', $language_id);
        $this->db->update('languages', array('is_selected' => 1));
    }

    public function remove($language_id)
    {
        $this->db->delete('languages', array('language_id' => $language_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('language_id', $ids);
                $this->db->update('languages', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('language_id', $ids);
                $this->db->update('languages', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('language_id !=', $edit);
        }
        $query = $this->db->get('languages');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function languagesList()
    {
        $request = $this->input->get();
        $columns = array(
            "",
            "languages.title",
            "languages.created_at",
            "languages.is_selected",
            "languages.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('languages');
        $this->db->select('
            languages.*
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('languages.status', $request['status']);
        }
        $this->db->group_by('languages.language_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTable($query->result()),
            'recordsTotal' => $this->getTotal(),
            'recordsFiltered' => $this->getTotal($srh, $request),
        );

        return $result;
    }

    public function getTotal($srh = false, $request = '')
    {
        $this->db->from('languages');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('languages.status', $request['status']);
        }
        $this->db->group_by('languages.language_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($languages)
    {
        $sorted = array();
        foreach ($languages as $c) {
            $c = objToArr($c);
            if ($c['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            if ($c['is_selected'] == 1) {
                $button_text_s = 'Selected';
                $button_class_s = 'success';
                $button_title_s = 'Selected';
            } else {
                $button_text_s = 'Click To Select';
                $button_class_s = 'danger';
                $button_title_s = 'Click to select';
            }
            if ($c['is_default'] != 1) {
                $actions = '
                    <button type="button" class="btn btn-primary btn-xs edit-language" data-id="'.$c['language_id'].'"><i class="far fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-xs delete-language" data-id="'.$c['language_id'].'"><i class="far fa-trash-alt"></i></button>
                ';
            } else {
                $actions = 'default language can not be edited or deleted';
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$c['language_id']."' />",
                $c['title'],
                date('d M, Y', strtotime($c['created_at'])),
                '<button type="button" title="'.$button_title_s.'" class="btn btn-'.$button_class_s.' btn-xs change-language-selected" data-selected="'.$c['is_selected'].'" data-id="'.$c['language_id'].'">'.$button_text_s.'</button>',
                $actions
            );
        }
        return $sorted;
    }
}