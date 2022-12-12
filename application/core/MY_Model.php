<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	
    protected $table = '';
    protected $perPage = 5;


	public function Validate($rule){
		$this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">','</small>'
        );
		$this->form_validation->set_rules($rule);
        return $this->form_validation->run();
	}

    public function paginate($page){
        $this->db->limit(
            $this->perPage,
            $this->calculateRealOffset($page)
        );
		return $this;
    }

	public function count()
	{
		return $this->db->count_all_results($this->table);
	}

    public function calculateRealOffset($page){
        if(is_null($page) || empty($page)){
            $offset = 0;
        }else{
            $offset = ($page * $this->perPage) - $this->perPage;
        }

        return $offset;
    }

    public function makePagination($baseUrl,$perPage, $uriSegment, $totalRows = null)
	{
		$this->load->library('pagination');

		$config = [
			'base_url'			=> $baseUrl,
			'uri_segment'		=> $uriSegment,
			'per_page'			=> $perPage,
			'total_rows'		=> $totalRows,
			'use_page_numbers'	=> true,
			
			'full_tag_open'		=> '<ul class="pagination">',
			'full_tag_close'	=> '</ul>',
			'attributes'		=> ['class' => 'page-link'],
			'first_link'		=> false,
			'last_link'			=> false,
			'first_tag_open'	=> '<li class="page-item">',
			'first_tag_close'	=> '</li>',
			'prev_link'			=> '&laquo',
			'prev_tag_open'		=> '<li class="page-item">',
			'prev_tag_close'	=> '</li>',
			'next_link'			=> '&raquo',
			'next_tag_open'		=> '<li class="page-item">',
			'next_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li class="page-item">',
			'last_tag_close'	=> '</li>',
			'cur_tag_open'		=> '<li class="page-item active"><a href="#" class="page-link">',
			'cur_tag_close'		=> '<span class="sr-only">(current)</span></a></li>',
			'num_tag_open'		=> '<li class="page-item">',
			'num_tag_close'		=> '</li>',
		];

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}

/* End of file MY_Model.php */
