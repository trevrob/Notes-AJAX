<?php
class Notes_model extends CI_Model{

	function create_note($note)
	{
		$query = "INSERT INTO notes (description, title, created_at, updated_at) VALUES (?,?,?,?)";
        $values = array($note['description'], $note['title'], date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
	}

	function show_notes()
	{
		$query = "SELECT notes.id, notes.title, notes.description FROM notes";
		return $this->db->query($query)->result_array();
	}

	function delete_note($id)
	{
		$query = "DELETE FROM notes WHERE id = ?";
		return $this->db->query($query, array($id));
	}

	function update_note($log)
	{
		$query = "UPDATE notes
				  SET description = ? 
				  WHERE id = ?";

		$value = array($log['description'], $log['id']);
		return $this->db->query($query, $value);
	}
}