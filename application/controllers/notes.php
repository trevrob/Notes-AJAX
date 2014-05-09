<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function index()
	{
		$this->load->model("notes_model");
		$show['notes'] = $this->notes_model->show_notes();
		$this->load->view('notes_view', $show);
	}
	public function add_note()
	{
		$this->load->model("notes_model");
		$array = array
		(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description')
		);
		$this->notes_model->create_note($array);
		$array['id'] = $this->db->insert_id();
		echo json_encode($array);
	}

	public function delete_note($id)
	{
		$this->load->model("notes_model");
		$this->notes_model->delete_note($id);
	}

	public function update_note($id)
	{
		$array = array
		(
			'id' => $id,
			'description' => $this->input->post('description')
		);

		$this->load->model("notes_model");
		$this->notes_model->update_note($array);
		echo json_encode($array);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */