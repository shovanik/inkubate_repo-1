<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class mwork extends CI_Model {

	function fiction_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->where('is_show','1')->order_by('work_form_name')->get('work_forms'); //->where('work_type_id', $id)

		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

		}
		$rs->free_result();
		return $data;

	}

	function get_work_type_details() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('*')->where('user_id', $usd['id'])->get('publisher_forms')->row_array();

		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		/*if($rs->num_rows() > 0){
		$data   = $rs->result_array();

		}
		$rs->free_result();*/
		return $data;

	}

	function getWorkTypeDetailsById($usd) {
		$data = array();

		$data = $this->db->select('*')->where('user_id', $usd)->get('publisher_forms')->row_array();

		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		/*if($rs->num_rows() > 0){
		$data   = $rs->result_array();

		}
		$rs->free_result();*/
		return $data;

	}

	function single_fiction_details($id, $formid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('*')->where('work_type_id', $id)->where('work_form_id', $formid)->get('work_forms')->row_array();

		return $data;

	}

	function category_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('work_type_id', $id)->where('is_show', '1')->get('categories');
		$rs = $this->db->select('*')->where('is_show', '1')->get('categories');
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

		}
		$rs->free_result();
		return $data;

	}

	function total_category_details() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->get('categories');

		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

		}
		$rs->free_result();
		return $data;

	}

	function form_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->where('work_type_id', $id)->get('work_forms');

		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			//echo '<option value="0">----Genre----</option>';

			foreach ($data as $each => $details) {

				?>
               <option value="<?php echo $details['work_form_id']?>"><?php echo $details['work_form_name']?></option>
            <?php
}
		}
		$rs->free_result();

	}

	function delete_cat_details($id, $wid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('work_type_id', $id)->get('work_forms');
		$this->db->where('id', $id)->delete('work_categories');

		$work_cat_details = $this->mwork->work_categ_details($wid);

		echo count($work_cat_details) . '@';

		if (!empty($work_cat_details)) {

			foreach ($work_cat_details as $catdetails) {

				?>

            <li class="cat_id" onclick="catshow(<?php echo $catdetails['wcid']?>)"><?php echo $catdetails['category_name']?></li>


         <?php }}

	}

	function delete_tag_details($id, $wid) {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('work_type_id', $id)->get('work_forms');
		$this->db->where('id', $id)->delete('tags');
		//$this->db->where('id',$tagid)->delete('tags');

		$work_tag_details = $this->mwork->work_tags_details($wid);

		echo count($work_tag_details) . '@';

		if (!empty($work_tag_details)) {

			foreach ($work_tag_details as $catdetails) {

				?>

            <li class="cat_id" onclick="tagshow_new(<?php echo $catdetails['id']?>)"><?php echo $catdetails['tag_name']?></li>


         <?php }}

	}

	public function getAuthorList() {
		return $data = $this->db->select('email')->where('user_type', '1')->where('status_id', '1')->get('users')->result_array();
	}

	public function addWork() {
		$data = array();
		$data1 = array();
		$data22 = array();
		$data33 = array();
		$data44 = array();
		$data55 = array();

		$data65 = array();
		$data66 = array();

		$usd = $this->session->userdata('logged_user');

		if (!is_dir('uploadImage/' . $usd['id'])) {
			mkdir('./uploadImage/' . $usd['id'], 0777, TRUE);
			chmod('./uploadImage/' . $usd['id'], 0777);

		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file')) {
			chmod('./uploadImage/' . $usd['id'], 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file/thumbs')) {
			chmod('./uploadImage/' . $usd['id'] . '/extra_file', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file/thumbs', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file/medium')) {
			chmod('./uploadImage/' . $usd['id'] . '/extra_file', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file/medium', 0777, TRUE);
		}

		if ($_FILES['image1']['name'] != "") {

			//print_r($_FILES['image1']['name']);die;
			//echo $_REQUEST['propertyId'];
			// exit();

			$file_element_name = 'image1';
			$image_name = $_FILES['image1']['name'];

			$this->load->library('image_lib');

			$configUpload['upload_path'] = './uploadImage/' . $usd['id'] . '/extra_file';
			$configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg';
			$configUpload['max_size'] = '0';
			$configUpload['max_width'] = '0';
			$configUpload['max_height'] = '0';
			//$configUpload['encrypt_name']   = true;
			$this->load->library('upload', $configUpload);

			if (!$this->upload->do_upload($file_element_name)) {
				//echo "if";die;
				$error = array('error' => $this->upload->display_errors());
				//echo $error['error'];die;
				$this->session->set_flashdata('error', $error['error']);
				//echo "<script>parent.$.fancybox.close();</script>";
				redirect('home/addWork', 'refresh');
			} else {
				//echo "else";die;
				$imgname_extra = $this->upload->data();

			}

		}

		//die("Anwar");
		$data['user_id'] = $usd['id'];
		$data['description'] = 'work_file';

		if ($_FILES['image1']['name'] != "") {
			$data['filename'] = $imgname_extra['file_name'];
		} else {
			$data['filename'] = '';
		}
		$data['status_id'] = '1';
		$data['create_date'] = date("Y-m-d h:i:s");
		$data['modified_date'] = date("Y-m-d h:i:s");
		$this->db->insert('assets', $data);

		if (!is_dir('uploadImage/' . $usd['id'])) {
			mkdir('./uploadImage/' . $usd['id'], 0777, TRUE);
			chmod('./uploadImage/' . $usd['id'], 0777);

		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image')) {
			chmod('./uploadImage/' . $usd['id'], 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image/thumbs')) {
			chmod('./uploadImage/' . $usd['id'] . '/cover_image', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image/thumbs', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image/medium')) {
			chmod('./uploadImage/' . $usd['id'] . '/cover_image', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image/medium', 0777, TRUE);
		}

		if ($_FILES['image']['name'] != "") {

			//print_r($_FILES['image']);die;
			//echo $_REQUEST['propertyId'];
			// exit();
			$this->load->library('image_lib');

			$configUpload22['upload_path'] = './uploadImage/' . $usd['id'] . '/cover_image';
			$configUpload22['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
			$configUpload22['max_size'] = '0';
			$configUpload22['max_width'] = '0';
			$configUpload22['max_height'] = '0';
			$configUpload22['encrypt_name'] = true;

			$this->load->library('upload', $configUpload22);
			$this->upload->initialize($configUpload22);
			/* size 64*72 for comments */
			$configThumb = array();
			$configThumb['image_library'] = 'gd2';
			$configThumb['create_thumb'] = TRUE;
			$configThumb['new_image'] = './uploadImage/' . $usd['id'] . '/cover_image/thumbs/';
			$configThumb['maintain_ratio'] = TRUE;
			$configThumb['width'] = 64;
			$configThumb['height'] = 72;
			$configThumb['thumb_marker'] = "";
			//$this->load->library('image_lib');
			/* size 64*72 for comments */

			/* size 167*167 for profile page */
			$configThumbMedium = array();
			$configThumbMedium['image_library'] = 'gd2';
			$configThumbMedium['create_thumb'] = TRUE;
			$configThumbMedium['new_image'] = './uploadImage/' . $usd['id'] . '/cover_image/medium/';
			$configThumbMedium['maintain_ratio'] = TRUE;
			$configThumbMedium['width'] = 167;
			$configThumbMedium['height'] = 167;
			$configThumbMedium['thumb_marker'] = "";
			/* size 167*167 for profile page */

			if (!$this->upload->do_upload('image')) {

				$error = array('error' => $this->upload->display_errors());
				//echo $error['error'];die;
				$this->session->set_flashdata('error', $error['error']);
				//echo 'kkk';die;
				return 0;
			}

			$uploadedDetails = $this->upload->data();
			if ($uploadedDetails['is_image'] == 1) {
				$configThumb['source_image'] = $uploadedDetails['full_path'];
				$configThumbMedium['source_image'] = $uploadedDetails['full_path'];
				$raw_name = $uploadedDetails['raw_name'];
				$file_ext = $uploadedDetails['file_ext'];
				$imgname = $raw_name . $file_ext;
				$this->image_lib->initialize($configThumb);
				$this->image_lib->resize();
				$this->image_lib->initialize($configThumbMedium);
				$this->image_lib->resize();

				//echo 'kkk';die;
			}
			//echo 'kkk';die;
		}

		$data1['user_id'] = $usd['id'];
		$data1['description'] = 'cover';

		if ($_FILES['image']['name'] != "") {
			$data1['filename'] = $imgname;
		} else {
			$data1['filename'] = '';
		}
		$data1['status_id'] = '1';
		$data1['create_date'] = date("Y-m-d h:i:s");
		$data1['modified_date'] = date("Y-m-d h:i:s");
		$this->db->insert('assets', $data1);
		//echo $this->db->last_query();die;
		//die();
		//echo "<pre>";print_r($_POST);echo "</pre>"; exit();
		/* Upload Image */
		// echo $_FILES['image']['name'].'hi';die;

		//echo $data['attach_file'] = $imgname['file_name'] ;;die;

		$row = $this->db->select('id')->where('user_id', $usd['id'])->where('description', 'cover')->order_by('id', 'desc')->limit(1)->get('assets')->row_array();
		$last_id = $row['id'];
		//$last_id=$this->db->insert_id();

		$row_22 = $this->db->select('id')->where('user_id', $usd['id'])->where('description', 'work_file')->order_by('id', 'desc')->limit(1)->get('assets')->row_array();
		$last_file_id = $row_22['id'];
		//echo $this->db->last_query();
		$data22['title'] = $this->input->post('Title');
		$synopsis = $this->input->post('synopsis');

		if ($synopsis == '') {
			$data22['synopsis'] = '';
		} else {
			$data22['synopsis'] = substr($synopsis, 0, 500);
		}
		$excerpt = $this->input->post('excerpt');

		if ($excerpt == '') {
			$data22['extract'] = '';
		} else {
			$data22['extract'] = substr($excerpt, 0, 1000);
		}

		$data22['user_id'] = $usd['id'];
		$data22['asset_id'] = $last_id;
		$data22['file_asset_id'] = $last_file_id;
		$data22['visibility_id'] = $this->input->post('VisibilityId');
		$data22['work_type_id'] = $this->input->post('WorkTypeId');
		$data22['work_form_id'] = $this->input->post('WorkFormId');

		$data22['status_id'] = '1';
		$data22['self_published'] = $this->input->post('SelfPublished');
		$data22['received_awards'] = $this->input->post('ReceivedAwards');
		$data22['been_reviewed'] = $this->input->post('BeenReviewed');
		$data22['published_abroad'] = $this->input->post('PublishedAbroad');
		$data22['create_date'] = date("Y-m-d h:i:s");
		$data22['modified_date'] = date("Y-m-d h:i:s");

		//unset($data22['tags']);

		$this->db->insert('works', $data22);
		$last_work_id = $this->db->insert_id();
		//echo $this->db->last_query();die;
		// echo "sssssss";die;
		//$last_id=$this->db->insert_id();
		$str1 = $this->input->post('cate_gory_hid');
		//$str1 = explode(',',$str);
		if (!empty($str1)) {
			foreach ($str1 as $cc) {
				//$row=$this->db->select('id')->where('category_name',$cc)->get('categories')->row_array();
				$data33['wid'] = $last_work_id;
				$data33['cid'] = $cc;
				$this->db->insert('work_categories', $data33);
			}
		}
		//$data22['tags']     = $this->input->post('tags');
		if ($this->input->post('tags') != '') {
			$str_tag = $this->input->post('tags');
			$strtags = explode(',', $str_tag);
			if (!empty($strtags)) {
				foreach ($strtags as $tag) {
					//$row=$this->db->select('id')->where('category_name',$cc)->get('categories')->row_array();
					$data44['user_id'] = $usd['id'];
					$data44['wid'] = $last_work_id;
					$data44['tag_name'] = $tag;
					$data44['status_id'] = '1';
					$data44['create_date'] = date("Y-m-d h:i:s");
					$data44['modified_date'] = date("Y-m-d h:i:s");
					$this->db->insert('tags', $data44);
				}
			}

			/*$row55=$this->db->select('id')->where('user_id',$usd['id'])->get('tags')->result_array();
		foreach($row55 as $work_tag)
		{
		//$row=$this->db->select('id')->where('category_name',$cc)->get('categories')->row_array();
		$data55['wid']           = $last_work_id;
		$data55['tid']           = $work_tag['id'];
		$this->db->insert('work_tags', $data55);
		}*/
		}

		$row65 = $this->db->select_max('id')->where('user_id', $usd['id'])->where('description', 'work_file')->get('assets')->row_array();

		$data65['wid'] = $last_work_id;
		$data65['aid'] = $row65['id'];
		$this->db->insert('work_assets', $data65);

		$row66 = $this->db->select_max('id')->where('user_id', $usd['id'])->where('description', 'cover')->get('assets')->row_array();

		$data66['wid'] = $last_work_id;
		$data66['aid'] = $row66['id'];
		$this->db->insert('work_assets', $data66);

		return 1;

	}

	public function addPitchit($id) {
		//echo $id;die;
		$data = array();
		$data22 = array();
		$data33 = array();
		$data43 = array();
		$temp = array();
		$pitch = $this->input->post('desc');
		$usd = $this->session->userdata('logged_user');

		$send = $this->input->post('send');
		$save = $this->input->post('save');

		$row_cnt = $this->db->select('*')->where('user_id', $usd['id'])->get('work_pitchits');

		if ($row_cnt->num_rows() <= 10) {

			if ($send == 'Send') {
				if ($pitch != '') {
					$data['user_id'] = $usd['id'];
					$data['is_pitchited'] = '1';
					$this->db->where('user_id', $usd['id'])->where('id', $id)->update('works', $data);
					//echo $this->db->last_query();die;

					$data22['user_id'] = $usd['id'];
					$data22['wid'] = $id;
					$data22['pitchit'] = $this->input->post('desc');
					$data22['created_date'] = date("Y-m-d h:i:s");
					$data22['is_pitchit'] = '1';
					$data22['is_drafted'] = '0';
					$this->db->insert('work_pitchits', $data22);
					//echo $this->db->last_query();die;

					//$row=$this->db->select('id')->where('user_type','2')->get('users')->result_array();
					$row = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a', 's.cid = a.cid', 'inner')->where('s.wid', $id)->get();
					//echo $this->db->last_query();die;
					//echo '<pre/>'; print_r($row);die;
					/*foreach($row as $key=>$user_publisher)
					{
					$temp[] = $user_publisher['id'];
					}
					$trmp = implode(',',$temp);*/
					if ($row->num_rows() > 0) {
						$row33 = $row->result_array();
						foreach ($row33 as $user_publisher) {
							$data33['from_user_id'] = $usd['id'];
							$data33['to_user_id'] = $user_publisher['user_id'];
							$data33['wid'] = $id;
							$data33['subject'] = $this->input->post('desc');
							$data33['body'] = base_url() . 'home/view_pitchit/' . $id;
							$data33['created'] = date("Y-m-d h:i:s");
							$data33['is_pitchited'] = '1';
							$this->db->insert('messages', $data33);
						}

						return 1;
					}

					$str1 = $this->input->post('cate_gory_hid');

					//$str1 = explode(',',$str);
					if (!empty($str1)) {
						foreach ($str1 as $cc) {
							$data43['from_user_id'] = $usd['id'];
							$data43['to_user_id'] = $cc;
							$data43['wid'] = $id;
							$data43['subject'] = $this->input->post('desc');
							$data43['body'] = base_url() . 'home/view_pitchit/' . $id;
							$data43['created'] = date("Y-m-d h:i:s");
							$data43['is_pitchited'] = '1';
							$this->db->insert('messages', $data43);
						}
					}

				}
			}

			if ($save == 'Save') {
				if ($pitch != '') {
					$data['user_id'] = $usd['id'];
					$data['is_pitchited'] = '1';
					$this->db->where('user_id', $usd['id'])->where('id', $id)->update('works', $data);
					//echo $this->db->last_query();die;

					$data22['user_id'] = $usd['id'];
					$data22['wid'] = $id;
					$data22['pitchit'] = $this->input->post('desc');
					$data22['created_date'] = date("Y-m-d h:i:s");
					$data22['is_pitchit'] = '1';
					$data22['is_drafted'] = '1';
					$this->db->insert('work_pitchits', $data22);

				}
			}

		}

	}

	public function editPitchit($id, $wid) {
		//echo $id;die;
		$data = array();
		$data22 = array();
		$data33 = array();
		$temp = array();
		$pitch = $this->input->post('desc');
		$usd = $this->session->userdata('logged_user');

		//$send = $this->input->post('send');
		//$save = $this->input->post('save');
		if ($pitch != '') {

			$data22['pitchit'] = $this->input->post('desc');
			$data22['created_date'] = date("Y-m-d h:i:s");
			$data22['is_pitchit'] = '1';
			$data22['is_drafted'] = '0';
			//$this->db->insert('work_pitchits', $data22);

			$update_account = $this->db->where('pit_id', $id)->update('work_pitchits', $data22);

			//$row=$this->db->select('id')->where('user_type','2')->get('users')->result_array();
			$row = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a', 's.cid = a.cid', 'inner')->where('s.wid', $wid)->get();
			//echo $this->db->last_query();die;
			//echo '<pre/>'; print_r($row);die;
			/*foreach($row as $key=>$user_publisher)
			{
			$temp[] = $user_publisher['id'];
			}
			$trmp = implode(',',$temp);*/
			if ($row->num_rows() > 0) {
				$row33 = $row->result_array();
				foreach ($row33 as $user_publisher) {
					$data33['from_user_id'] = $usd['id'];
					$data33['to_user_id'] = $user_publisher['user_id'];
					$data33['wid'] = $wid;
					$data33['subject'] = $this->input->post('desc');
					$data33['body'] = base_url() . 'home/view_pitchit/' . $wid;
					$data33['created'] = date("Y-m-d h:i:s");
					$data33['is_pitchited'] = '1';
					$this->db->insert('messages', $data33);
				}

				return 1;
			}
		}

	}

	function get_user_save_pitchit_view() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->from('work_pitchits')->where('user_id', $usd['id'])->where('is_pitchit', '1')->where('is_drafted', '1')->get();
		//$rs=$this->db->select('*')->where('wid',$wid)->get('pitchit_view');
		//echo $this->db->last_query();die;

		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return count($data);

	}

	public function editWork($id) {
		//echo $id;die;
		$data = array();
		$data22 = array();
		$data28 = array();
		$data33 = array();
		$data44 = array();
		$data55 = array();
		$data65 = array();
		$data67 = array();

		$usd = $this->session->userdata('logged_user');

		$row = $this->db->select('*')->where('id', $id)->get('works')->row_array();
		//$row34=$this->db->select('id')->where('user_id',$usd['id'])->where('description','work_file')->order_by('id','desc')->limit(1)->get('assets')->row_array();
		//echo count($row34);die;

		if (!is_dir('uploadImage/' . $usd['id'])) {
			mkdir('./uploadImage/' . $usd['id'], 0777, TRUE);
			chmod('./uploadImage/' . $usd['id'], 0777);

		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file')) {
			chmod('./uploadImage/' . $usd['id'], 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file/thumbs')) {
			chmod('./uploadImage/' . $usd['id'] . '/extra_file', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file/thumbs', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/extra_file/medium')) {
			chmod('./uploadImage/' . $usd['id'] . '/extra_file', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/extra_file/medium', 0777, TRUE);
		}

		if ($_FILES['image1']['name'] != "") {

			//print_r($_FILES['image1']['name']);die;
			//echo $_REQUEST['propertyId'];
			// exit();

			$file_element_name = 'image1';
			$image_name = $_FILES['image1']['name'];

			$this->load->library('image_lib');

			$configUpload['upload_path'] = './uploadImage/' . $usd['id'] . '/extra_file';
			$configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg';
			$configUpload['max_size'] = '0';
			$configUpload['max_width'] = '0';
			$configUpload['max_height'] = '0';
			//$configUpload['encrypt_name']   = true;
			$this->load->library('upload', $configUpload);

			if (!$this->upload->do_upload($file_element_name)) {
				//echo "if";die;
				$error = array('error' => $this->upload->display_errors());
				//echo $error['error'];die;
				$this->session->set_flashdata('error', $error['error']);
				//echo "<script>parent.$.fancybox.close();</script>";
				redirect('home/addWork', 'refresh');
			} else {
				//echo "else";die;
				$imgname_extra = $this->upload->data();

			}

			$data65['user_id'] = $usd['id'];
			$data65['description'] = 'work_file';
			$data65['filename'] = $imgname_extra['file_name'];
			$data65['status_id'] = '1';
			$data65['create_date'] = date("Y-m-d h:i:s");
			$data65['modified_date'] = date("Y-m-d h:i:s");
			//$this->db->where('user_id',$usd['id'])->where('id',$row['file_asset_id'])->where('description','work_file')->update('assets',$data65);
			$this->db->insert('assets', $data65);
			$row34 = $this->db->insert_id();
			//echo $row34;die;

			$data67['file_asset_id'] = "{$row34}";
			$this->db->where('user_id', $usd['id'])->where('id', $id)->update('works', $data67);
			//echo $this->db->last_query();die;

		} else {

			$data65['user_id'] = $usd['id'];
			$data65['description'] = 'work_file';
			//$data['filename']          = $imgname;
			$data65['status_id'] = '1';
			$data65['create_date'] = date("Y-m-d h:i:s");
			$data65['modified_date'] = date("Y-m-d h:i:s");
			$this->db->where('user_id', $usd['id'])->where('id', $row['file_asset_id'])->where('description', 'work_file')->update('assets', $data65);

		}

		if (!is_dir('uploadImage/' . $usd['id'])) {
			mkdir('./uploadImage/' . $usd['id'], 0777, TRUE);
			chmod('./uploadImage/' . $usd['id'], 0777);

		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image')) {
			chmod('./uploadImage/' . $usd['id'], 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image/thumbs')) {
			chmod('./uploadImage/' . $usd['id'] . '/cover_image', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image/thumbs', 0777, TRUE);
		}
		if (!is_dir('./uploadImage/' . $usd['id'] . '/cover_image/medium')) {
			chmod('./uploadImage/' . $usd['id'] . '/cover_image', 0777);
			mkdir('./uploadImage/' . $usd['id'] . '/cover_image/medium', 0777, TRUE);
		}

		if ($_FILES['image']['name'] != "") {

			//print_r($_FILES['image']['name']);die;
			//echo $_REQUEST['propertyId'];
			// exit();
			$this->load->library('image_lib');

			$configUpload22['upload_path'] = './uploadImage/' . $usd['id'] . '/cover_image';
			$configUpload22['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
			$configUpload22['max_size'] = '0';
			$configUpload22['max_width'] = '0';
			$configUpload22['max_height'] = '0';
			$configUpload22['encrypt_name'] = true;

			$this->load->library('upload', $configUpload22);
			$this->upload->initialize($configUpload22);
			/* size 64*72 for comments */
			$configThumb = array();
			$configThumb['image_library'] = 'gd2';
			$configThumb['create_thumb'] = TRUE;
			$configThumb['new_image'] = './uploadImage/' . $usd['id'] . '/cover_image/thumbs/';
			$configThumb['maintain_ratio'] = TRUE;
			$configThumb['width'] = 64;
			$configThumb['height'] = 72;
			$configThumb['thumb_marker'] = "";
			//$this->load->library('image_lib');
			/* size 64*72 for comments */

			/* size 167*167 for profile page */
			$configThumbMedium = array();
			$configThumbMedium['image_library'] = 'gd2';
			$configThumbMedium['create_thumb'] = TRUE;
			$configThumbMedium['new_image'] = './uploadImage/' . $usd['id'] . '/cover_image/medium/';
			$configThumbMedium['maintain_ratio'] = TRUE;
			$configThumbMedium['width'] = 167;
			$configThumbMedium['height'] = 167;
			$configThumbMedium['thumb_marker'] = "";
			/* size 167*167 for profile page */

			if (!$this->upload->do_upload('image')) {
				return 0;
			}

			$uploadedDetails = $this->upload->data();
			if ($uploadedDetails['is_image'] == 1) {
				$configThumb['source_image'] = $uploadedDetails['full_path'];
				$configThumbMedium['source_image'] = $uploadedDetails['full_path'];
				$raw_name = $uploadedDetails['raw_name'];
				$file_ext = $uploadedDetails['file_ext'];
				$imgname = $raw_name . $file_ext;
				$this->image_lib->initialize($configThumb);
				$this->image_lib->resize();
				$this->image_lib->initialize($configThumbMedium);
				$this->image_lib->resize();
			}

			$data['user_id'] = $usd['id'];
			$data['description'] = 'cover';
			$data['filename'] = $imgname;
			$data['status_id'] = '1';
			$data['create_date'] = date("Y-m-d h:i:s");
			$data['modified_date'] = date("Y-m-d h:i:s");
			$this->db->where('user_id', $usd['id'])->where('id', $row['asset_id'])->where('description', 'cover')->update('assets', $data);
			//echo $this->db->last_query();die;

		} else {
			$data['user_id'] = $usd['id'];
			$data['description'] = 'cover';
			//$data['filename']          = $imgname;
			$data['status_id'] = '1';
			$data['create_date'] = date("Y-m-d h:i:s");
			$data['modified_date'] = date("Y-m-d h:i:s");
			$this->db->where('user_id', $usd['id'])->where('id', $row['asset_id'])->where('description', 'cover')->update('assets', $data);
		}

		//echo $this->db->last_query();
		$data22['title'] = $this->input->post('Title');
		//echo $this->input->post('synopsis').'hi';die;
		$synopsis = $this->input->post('synopsis');

		if ($synopsis == '') {
			$data22['synopsis'] = '';
		} else {
			$data22['synopsis'] = substr($synopsis, 0, 500);
		}
		//echo $data22['synopsis'];die;
		$excerpt = $this->input->post('excerpt');
		if ($excerpt == '') {
			$data22['extract'] = '';
		} else {
			$data22['extract'] = substr($excerpt, 0, 1000);
		}
		//echo $data22['extract'].'hi';die;
		//echo $row34;die;
		$data22['user_id'] = $usd['id'];
		$data22['asset_id'] = $row['asset_id'];
		//$data22['file_asset_id']     = $row['file_asset_id'];
		//$data22['file_asset_id']     = $row34;
		$data22['visibility_id'] = $this->input->post('VisibilityId');
		$data22['work_type_id'] = $this->input->post('WorkTypeId');
		$data22['work_form_id'] = $this->input->post('WorkFormId');

		$data22['status_id'] = '1';
		$data22['self_published'] = $this->input->post('SelfPublished');
		$data22['received_awards'] = $this->input->post('ReceivedAwards');
		$data22['been_reviewed'] = $this->input->post('BeenReviewed');
		$data22['published_abroad'] = $this->input->post('PublishedAbroad');
		$data22['create_date'] = date("Y-m-d h:i:s");
		$data22['modified_date'] = date("Y-m-d h:i:s");

		$data22['cout'] = $this->input->post('cout');
		unset($data22['cout']);
		$this->db->where('id', $id)->update('works', $data22);
		//echo $this->db->last_query();die;
		// echo "sssssss";die;
		//$last_id=$this->db->insert_id();

		$str1 = $this->input->post('cate_gory_hid');
		if (!empty($str1)) {
			//print_r($str1);die;
			//$str1 = explode(', ',$str);
			foreach ($str1 as $cc) {
				$row = $this->db->select('*')->where('Wid', $id)->where('cid', $cc)->get('work_categories')->result_array();
				//$wrk_cat = $this->mwork->work_cat_select($id,$cc);
				$cnt_row = count($row);
				//echo $cc;
				if ($cnt_row > 0) {
					$data33['Wid'] = $id;
					$data33['cid'] = $cc;
					$this->db->where('Wid', $id)->where('cid', $cc)->update('work_categories', $data33);
					//echo $this->db->last_query();die;
				} else {
					$data33['Wid'] = $id;
					$data33['cid'] = $cc;
					$this->db->insert('work_categories', $data33);
					//echo $this->db->last_query();die;
				}
			}
		}

		//$data22['tags']     = $this->input->post('tags');
		if ($this->input->post('tags') != '') {
			$str_tag = $this->input->post('tags');
			$strtags = explode(',', $str_tag);
			foreach ($strtags as $tag) {

				$row22 = $this->db->select('*')->where('user_id', $usd['id'])->where('tag_name', $tag)->get('tags')->result_array();
				$cnt_row22 = count($row22);

				if ($cnt_row22 > 0) {

					$data44['user_id'] = $usd['id'];
					$data44['wid'] = $id;
					$data44['tag_name'] = $tag;
					$data44['status_id'] = '1';
					$data44['create_date'] = date("Y-m-d h:i:s");
					$data44['modified_date'] = date("Y-m-d h:i:s");

					//$data44['Wid']           = $id;
					//$data44['tid']           = $tag;
					$this->db->where('tag_name', $tag)->update('tags', $data44);

					/*$row55=$this->db->select('id')->where('user_id',$usd['id'])->where('tag_name',$tag)->get('tags')->row_array();

					$data55['Wid']           = $id;
					$data55['tid']           = $row55['id'];
					$this->db->where('Wid',$id)->where('tid',$row55['id'])->update('work_tags',$data55);*/

					//echo $this->db->last_query();die;
				} else {
					$data44['user_id'] = $usd['id'];
					$data44['wid'] = $id;
					$data44['tag_name'] = $tag;
					$data44['status_id'] = '1';
					$data44['create_date'] = date("Y-m-d h:i:s");
					$data44['modified_date'] = date("Y-m-d h:i:s");
					$this->db->insert('tags', $data44);

					/*$row55=$this->db->select('id')->where('user_id',$usd['id'])->where('tag_name',$tag)->get('tags')->row_array();


				$data55['Wid']           = $id;
				$data55['tid']           = $row55['id'];
				$this->db->insert('work_tags',$data55);*/

				}
			}

		}

		return 1;

	}

	function singleWorkDetails($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->where('id', $id)->where('user_id', $usd['id'])->get('works');
		//echo $this->db->last_query();die;

		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row['filename'])) {
					$data[$each]['cover_image'] = $row['filename'];
				} else {
					$data[$each]['cover_image'] = '';
				}

				$row22 = $this->db->where('id', $value['file_asset_id'])->where('description', 'work_file')->get('assets')->row_array();
				if (!empty($row22['filename'])) {
					$data[$each]['file'] = $row22['filename'];
				} else {
					$data[$each]['file'] = '';
				}

				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;

	}

	function work_form_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('*')->where('work_type_id', $id)->get('work_forms')->result_array();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return $data;
	}

	function work_categ_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('categories as a', 's.cid = a.id', 'inner')->where('s.wid', $id)->get()->result_array();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return $data;
	}

	function work_tags_details($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('*')->where('wid', $id)->get('tags')->result_array();
		//$data  = $this->db->select('s.id as wtid,s.wid,s.tid,a.*')->from('work_tags as s')->join('tags as a','s.tid = a.id','inner')->where('s.wid', $id)->get()->result_array();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return $data;
	}

	function work_cat_select($id = null, $catid = null) {

		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('*')->where('Wid', $id)->where('cid', $catid)->get('work_categories')->result_array();
		//echo $this->db->last_query();die;
		return count($data);

	}

	function allWorkById($wid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->where('id', $wid)->get('works');
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				//$row=$this->db->select('id,name_first,name_middle,name_last,user_type,status_id')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();

				$row = $this->db->select('id,name_first,name_middle,name_last,user_type,status_id')->where('id', $value['user_id'])->get('users')->row_array();

				$data[$each]['user_id'] = $value['user_id'];
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
					//$data[$each]['full_name'] = $row['name_first']." ".$row['name_middle']." ".$row['name_last'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
					//$data[$each]['full_name'] = $row['name_first']." ".$row['name_middle']." ".$row['name_last'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
					//$data[$each]['full_name'] = $row['name_first']." ".$row['name_middle']." ".$row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				$data[$each]['full_name'] = $row['name_first'] . " " . $row['name_middle'] . " " . $row['name_last'];

				$row22 = $this->db->where('work_form_id', $value['work_form_id'])->get('work_forms')->row_array();
				if (!empty($row22['work_form_name'])) {
					$data[$each]['form_name'] = $row22['work_form_name'];
				} else {
					$data[$each]['form_name'] = '';
				}

				$row23 = $this->db->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row23['work_type_name'])) {
					$data[$each]['type_name'] = $row23['work_type_name'];
				} else {
					$data[$each]['type_name'] = '';
				}

				$row33 = $this->db->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row73 = $this->db->where('id', $value['file_asset_id'])->where('description', 'work_file')->get('assets')->row_array();
				if (!empty($row73['filename'])) {
					$data[$each]['work_file'] = $row73['filename'];
				} else {
					$data[$each]['work_file'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allWorkByPitch($wid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->where('wid', $wid)->get('work_pitchits')->row_array();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);

		//$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allWorkByPitchConversation($wid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$data  = $this->db->select('count(*) as count')->where('wid',$wid)->get('work_pitchits')->row_array();
		$data = $this->db->select('count(*) as count,s.pit_id,s.wid,m.is_pitchited,m.pitchit_id,m.from_user_id')->from('work_pitchits as s')->join('messages as m', 's.pit_id = m.pitchit_id', 'inner')->where('s.wid', $wid)->where('m.from_user_id', $usd['id'])->where('m.is_pitchited', '1')->get()->row_array();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);

		//$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allWork($bid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->order_by('create_date','desc')->get('works');
		$rs = $this->db->select('s.id as wcid,s.Wid,s.bid,s.user_id as buid,a.*')->from('bookshelf_works as s')->join('works as a', 's.Wid = a.id', 'inner')->where('s.user_id', $usd['id'])->where('s.bid', $bid)->order_by('s.id', 'asc')->group_by('s.id')->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name'] = $row['name_first'];
				} else {
					$data[$each]['name'] = '';
				}
				$row22 = $this->db->where('work_form_id', $value['work_form_id'])->get('work_forms')->row_array();
				if (!empty($row22['work_form_name'])) {
					$data[$each]['form_name'] = $row22['work_form_name'];
				} else {
					$data[$each]['form_name'] = '';
				}

				$row23 = $this->db->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row23['work_type_name'])) {
					$data[$each]['type_name'] = $row23['work_type_name'];
				} else {
					$data[$each]['type_name'] = '';
				}

				$row33 = $this->db->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row73 = $this->db->where('id', $value['file_asset_id'])->where('description', 'work_file')->get('assets')->row_array();
				if (!empty($row73['filename'])) {
					$data[$each]['work_file'] = $row73['filename'];
				} else {
					$data[$each]['work_file'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}
	function allWorkForBookshelf($bid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->order_by('create_date','desc')->get('works');
		$rs = $this->db->select('s.id as wcid,s.Wid,s.bid,s.user_id as buid,a.*')->from('bookshelf_works as s')->join('works as a', 's.Wid = a.id', 'inner')->where('s.bid', $bid)->order_by('s.id', 'asc')->group_by('s.id')->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name'] = $row['name_first'];
				} else {
					$data[$each]['name'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}
				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}
				$row22 = $this->db->select('categories.category_name')->join('work_categories', 'categories.id = work_categories.cid')->where('work_categories.Wid', $value['Wid'])->get('categories')->result_array();
				if (!empty($row22)) {
					$genre = "";
					foreach ($row22 as $eachC) {
						if (strlen($genre) > 0) {
							$genre .= " , " . $eachC['category_name'];
						} else {
							$genre = $eachC['category_name'];
						}
					}
					$data[$each]['form_name'] = $genre;
				} else {
					$data[$each]['form_name'] = '';
				}

				$row23 = $this->db->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row23['work_type_name'])) {
					$data[$each]['type_name'] = $row23['work_type_name'];
				} else {
					$data[$each]['type_name'] = '';
				}

				$row33 = $this->db->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row73 = $this->db->where('id', $value['file_asset_id'])->where('description', 'work_file')->get('assets')->row_array();
				if (!empty($row73['filename'])) {
					$data[$each]['work_file'] = $row73['filename'];
				} else {
					$data[$each]['work_file'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";die;*/
		return $data;
	}

	function saveTitleWorkForBookshelf() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->order_by('create_date','desc')->get('works');
		$rs = $this->db->select('b.id as bid_id,b.user_id as buser,b.is_status,s.id as wcid,s.Wid,s.bid,s.user_id as buid,a.*')->from('bookshelfs as b')->join('bookshelf_works as s', 'b.id = s.bid', 'left')->join('works as a', 's.Wid = a.id', 'inner')->where('b.user_id', $usd['id'])->where('b.is_status', '0')->order_by('s.id', 'asc')->group_by('s.id')->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('id,name_first,name_middle,name_last')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name'] = $row['name_first'];
				} else {
					$data[$each]['name'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}
				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}
				$row22 = $this->db->where('work_form_id', $value['work_form_id'])->get('work_forms')->row_array();
				if (!empty($row22['work_form_name'])) {
					$data[$each]['form_name'] = $row22['work_form_name'];
				} else {
					$data[$each]['form_name'] = '';
				}

				$row23 = $this->db->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row23['work_type_name'])) {
					$data[$each]['type_name'] = $row23['work_type_name'];
				} else {
					$data[$each]['type_name'] = '';
				}

				$row33 = $this->db->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row73 = $this->db->where('id', $value['file_asset_id'])->where('description', 'work_file')->get('assets')->row_array();
				if (!empty($row73['filename'])) {
					$data[$each]['work_file'] = $row73['filename'];
				} else {
					$data[$each]['work_file'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allUserById($wid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('id',$wid)->where('status_id','1')->get('users');
		$rs = $this->db->select('*')->where('id', $wid)->get('users');
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('biography,traditionally_published,self_published,literary_awards,work_been_reviewed,published_abroad,mfa_program')->where('user_id', $value['id'])->get('profile_writer')->row_array();
				if (!empty($row['biography'])) {
					$data[$each]['bio'] = $row['biography'];
				} else {
					$data[$each]['bio'] = '';
				}
				if (!empty($row['traditionally_published'])) {
					$data[$each]['traditionally_published'] = $row['traditionally_published'];
				} else {
					$data[$each]['traditionally_published'] = '';
				}

				if (!empty($row['self_published'])) {
					$data[$each]['self_published'] = $row['self_published'];
				} else {
					$data[$each]['self_published'] = '';
				}

				if (!empty($row['literary_awards'])) {
					$data[$each]['literary_awards'] = $row['literary_awards'];
				} else {
					$data[$each]['literary_awards'] = '';
				}

				if (!empty($row['work_been_reviewed'])) {
					$data[$each]['work_been_reviewed'] = $row['work_been_reviewed'];
				} else {
					$data[$each]['work_been_reviewed'] = '';
				}

				if (!empty($row['published_abroad'])) {
					$data[$each]['published_abroad'] = $row['published_abroad'];
				} else {
					$data[$each]['published_abroad'] = '';
				}

				if (!empty($row['mfa_program'])) {
					$data[$each]['mfa_program'] = $row['mfa_program'];
				} else {
					$data[$each]['mfa_program'] = '';
				}

				$row33 = $this->db->where('user_id', $value['id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allProfiles() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('*')->where('profile_id', $usd['id'])->order_by('view_date', 'desc')->limit(5)->get('view_profile');
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('*')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				if (!empty($row['user_type'])) {
					$data[$each]['user_type'] = $row['user_type'];
				} else {
					$data[$each]['user_type'] = '';
				}

				$row33 = $this->db->where('user_id', $value['user_id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allBookshelfProfiles() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('profile_id',$usd['id'])->order_by('view_date','desc')->limit(5)->get('view_profile');
		$rs = $this->db->select('s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('bookshelf_works as a', 's.id = a.Wid', 'right')->where('s.user_id', $usd['id'])->order_by('created_date', 'desc')->limit(5)->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('*')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				if (!empty($row['user_type'])) {
					$data[$each]['user_type'] = $row['user_type'];
				} else {
					$data[$each]['user_type'] = '';
				}

				$row33 = $this->db->where('user_id', $value['user_id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row44 = $this->db->where('id', $value['bid'])->get('bookshelfs')->row_array();
				if (!empty($row44['name'])) {
					$data[$each]['bookshelf_name'] = $row44['name'];
				} else {
					$data[$each]['bookshelf_name'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allBookshelfByProfiles($offset = null, $limit = null) {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('profile_id',$usd['id'])->order_by('view_date','desc')->limit(5)->get('view_profile');
		$rs = $this->db->select('s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('bookshelf_works as a', 's.id = a.Wid', 'right')->where('s.user_id', $usd['id'])->order_by('created_date', 'desc')->limit($limit, $offset)->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('id,name_first,name_middle,name_last,user_type')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				if (!empty($row['user_type'])) {
					$data[$each]['user_type'] = $row['user_type'];
				} else {
					$data[$each]['user_type'] = '';
				}

				$row33 = $this->db->where('user_id', $value['user_id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row44 = $this->db->where('id', $value['bid'])->get('bookshelfs')->row_array();
				if (!empty($row44['name'])) {
					$data[$each]['bookshelf_name'] = $row44['name'];
				} else {
					$data[$each]['bookshelf_name'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allBookshelfByWriterProfiles() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('profile_id',$usd['id'])->order_by('view_date','desc')->limit(5)->get('view_profile');
		//$rs  = $this->db->select('s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('bookshelf_works as a','s.id = a.Wid','right')->where('a.user_id', $usd['id'])->order_by('created_date','desc')->limit(10)->get();

		$rs = $this->db->select('s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('bookshelf_works as a', 's.id = a.Wid', 'right')->where('a.user_id !=', '')->where('a.user_id !=', $usd['id'])->order_by('created_date', 'desc')->limit(10)->get();

		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				//$row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['wuid'])->where('status_id','1')->get('users')->row_array();
				$row = $this->db->select('id,name_first,name_middle,name_last,user_type')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				if (!empty($row['user_type'])) {
					$data[$each]['user_type'] = $row['user_type'];
				} else {
					$data[$each]['user_type'] = '';
				}

				$row33 = $this->db->where('user_id', $value['user_id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row44 = $this->db->where('id', $value['bid'])->get('bookshelfs')->row_array();
				if (!empty($row44['name'])) {
					$data[$each]['bookshelf_name'] = $row44['name'];
				} else {
					$data[$each]['bookshelf_name'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function allBookshelfByProfilesCount() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('profile_id',$usd['id'])->order_by('view_date','desc')->limit(5)->get('view_profile');
		$data = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('bookshelf_works as a', 's.id = a.Wid', 'right')->where('s.user_id', $usd['id'])->get()->row_array();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);

		return $data;
	}

	function allDownloadProfiles() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$rs  = $this->db->select('*')->where('profile_id',$usd['id'])->order_by('view_date','desc')->limit(5)->get('view_profile');
		$rs = $this->db->select('s.id as wcid,s.user_id as wuid,s.title,a.*')->from('works as s')->join('view_downloaded_file as a', 's.id = a.wid', 'right')->where('s.user_id', $usd['id'])->order_by('created_at', 'desc')->limit(5)->get();
		//echo $this->db->last_query();die;
		//$this->db->limit(1,0);
		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('*')->where('id', $value['user_id'])->where('status_id', '1')->get('users')->row_array();
				if (!empty($row['name_first'])) {
					$data[$each]['name_first'] = $row['name_first'];
				} else {
					$data[$each]['name_first'] = '';
				}
				if (!empty($row['name_middle'])) {
					$data[$each]['name_middle'] = $row['name_middle'];
				} else {
					$data[$each]['name_middle'] = '';
				}

				if (!empty($row['name_last'])) {
					$data[$each]['name_last'] = $row['name_last'];
				} else {
					$data[$each]['name_last'] = '';
				}

				if (!empty($row['user_type'])) {
					$data[$each]['user_type'] = $row['user_type'];
				} else {
					$data[$each]['user_type'] = '';
				}

				$row33 = $this->db->where('user_id', $value['user_id'])->where('description', 'profile')->get('assets')->row_array();
				if (!empty($row33['filename'])) {
					$data[$each]['photo'] = $row33['filename'];
				} else {
					$data[$each]['photo'] = '';
				}

				$row44 = $this->db->where('id', $value['file_id'])->get('assets')->row_array();
				if (!empty($row44['filename'])) {
					$data[$each]['file'] = $row44['filename'];
				} else {
					$data[$each]['file'] = '';
				}
				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		$rs->free_result();
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
	}

	function get_user_work_details_byId($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->where('user_id', $id)->order_by('create_date', 'desc')->get('works');

		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('*')->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row['work_type_name'])) {
					$data[$each]['work_type_name'] = $row['work_type_name'];

				} else {
					$data[$each]['work_type_name'] = '';
				}

				$row33 = $this->db->select('*')->where('work_form_id', $value['work_form_id'])->get('work_forms')->row_array();
				if (!empty($row33['work_form_name'])) {
					$data[$each]['work_form_name'] = $row33['work_form_name'];

				} else {
					$data[$each]['work_form_name'] = '';
				}

				$row22 = $this->db->select('filename')->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row22['filename'])) {
					$data[$each]['cover_image'] = $row22['filename'];

				} else {
					$data[$each]['cover_image'] = '';
				}

				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return $data;

	}

	function work_uploaded_UserById($id) {

		$data = array();
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('count(*) as count')->where('user_id', $id)->get('works')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function get_user_savepitchit_details() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a', 's.wid = a.id', 'inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '1')->order_by('s.created_date', 'desc')->get();
		//$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
		//echo $this->db->last_query();die;

		if ($rs->num_rows() > 0) {
			$data = $rs->result_array();

			foreach ($data as $each => $value) {

				$row = $this->db->select('*')->where('work_type_id', $value['work_type_id'])->get('work_types')->row_array();
				if (!empty($row['work_type_name'])) {
					$data[$each]['work_type_name'] = $row['work_type_name'];

				} else {
					$data[$each]['work_type_name'] = '';
				}

				$row33 = $this->db->select('*')->where('work_form_id', $value['work_form_id'])->get('work_forms')->row_array();
				if (!empty($row33['work_form_name'])) {
					$data[$each]['work_form_name'] = $row33['work_form_name'];

				} else {
					$data[$each]['work_form_name'] = '';
				}

				$row22 = $this->db->select('filename')->where('id', $value['asset_id'])->where('description', 'cover')->get('assets')->row_array();
				if (!empty($row22['filename'])) {
					$data[$each]['cover_image'] = $row22['filename'];

				} else {
					$data[$each]['cover_image'] = '';
				}

				//$data[$each]['type']    = 'PROPERTY';
			}
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		//echo $this->db->last_query();die;
		return $data;

	}

	function single_user($id) {

		$data = array();
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('*')->where('id', $id)->where('status_id', '1')->get('users')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function single_user_view_count($id) {

		$data = array();
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('count(*) as count')->where('pitchit_id', $id)->where('view', '1')->get('pitchit_view')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function single_pitchit_view_user($id) {

		$data = array();
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('id,name_first,name_middle,name_last,user_type')->where('id', $id)->where('status_id', '1')->get('users')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function get_pit($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->from('work_pitchits')->where('pit_id', $id)->get()->row_array();
		//$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
		//echo $this->db->last_query();die;

		return $rs;

	}

	function viewedbyUser_old($id) {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->where('user_id', $usd['id'])->where('profile_id', $id)->get('view_profile');

		if ($rs->num_rows() == 0) {

			$data['user_id'] = $usd['id'];
			$data['profile_id'] = $id;
			$data['view_date'] = date("Y-m-d h:i:s");
			$this->db->insert('view_profile', $data);

			return 1;

		}

	}

	function viewedbyUser($id) {
		$data = array();
		$data1 = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->where('user_id', $usd['id'])->where('wuid', $id)->where('wid IS NULL', null, false)->get('view_title');

		if ($rs->num_rows() == 0) {

			$data['user_id'] = $usd['id'];
			$data['wuid'] = $id;
			$data['created_date'] = date("Y-m-d h:i:s");
			$data['is_profile_seen'] = '0';
			$this->db->insert('view_title', $data);

			$data1['is_profile_seen'] = '1';
			$this->db->where('user_id', $usd['id'])->where('wuid', $id)->where('wid !=', '')->update('view_title', $data1);
			return 1;

		}

	}

	function get_user_view_count() {

		$data = array();
		$usd = $this->session->userdata('logged_user');

		//$data  = $this->db->select('count(*) as count')->where('profile_id',$usd['id'])->get('view_profile')->row_array();
		$data = $this->db->select('count(*) as count')->from('view_title')->where('wuid', $usd['id'])->order_by('created_date', 'desc')->get()->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function viewDownloadedFile($id, $fileid, $uid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('*')->where('user_id', $usd['id'])->where('wid', $id)->where('file_id', $fileid)->get('view_downloaded_file');

		if ($rs->num_rows() == 0) {

			if ($usd['id'] != $uid) {

				$data['user_id'] = $usd['id'];
				$data['download_user_id'] = $uid;
				$data['wid'] = $id;
				$data['file_id'] = $fileid;
				$data['created_at'] = date("Y-m-d h:i:s");
				$this->db->insert('view_downloaded_file', $data);

				return 1;
			}

		}

	}

	function userTitleSearch($id, $uid) {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rst = $this->db->select('*')->where('user_id', $usd['id'])->where('wuid', $uid)->where('wid IS NULL', null, false)->get('view_title');
		//echo $this->db->last_query();

		if ($rst->num_rows() == 0) {

			$rs = $this->db->select('*')->where('user_id', $usd['id'])->where('wid', $id)->where('wuid', $uid)->get('view_title');
			if ($rs->num_rows() == 0) {

				$data['user_id'] = $usd['id'];
				$data['wuid'] = $uid;
				$data['wid'] = $id;
				$data['is_profile_seen'] = '0';
				$data['created_date'] = date("Y-m-d h:i:s");
				$this->db->insert('view_title', $data);

				return 1;

			}
		} else {
			$rs = $this->db->select('*')->where('user_id', $usd['id'])->where('wid', $id)->where('wuid', $uid)->get('view_title');

			if ($rs->num_rows() == 0) {

				$data['user_id'] = $usd['id'];
				$data['wuid'] = $uid;
				$data['wid'] = $id;
				$data['is_profile_seen'] = '1';
				$data['created_date'] = date("Y-m-d h:i:s");
				$this->db->insert('view_title', $data);

				return 1;

			}
		}

	}

	function get_user_download_count() {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('count(*) as count')->where('download_user_id', $usd['id'])->get('view_downloaded_file')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function get_user_search_count() {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$data = $this->db->select('count(*) as count')->where('wuid', $usd['id'])->get('view_search')->row_array();
		//echo $this->db->last_query();die;
		return $data;

	}

	function getCountSearch() {
		$data = array();
		$usd = $this->session->userdata('logged_user');
		$rs = $this->db->select('count(*) as count')->where('wuid', $usd['id'])->get('view_search');
		$data = $rs->result_array();

		return $data[0]['count'];

	}

	function getCountUserView() {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$rs = $this->db->select('count(*) as count')->where('profile_id', $usd['id'])->get('view_profile');
		$data = $rs->result_array();
		//echo $this->db->last_query();die;
		return $data[0]['count'];

	}

	function getCountUserDownload() {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$rs = $this->db->select('count(*) as count')->where('download_user_id', $usd['id'])->get('view_downloaded_file');
		$data = $rs->result_array();
		//echo $this->db->last_query();die;
		return $data[0]['count'];

	}

	function getCountUserBookshelf() {

		$data = array();
		$usd = $this->session->userdata('logged_user');
		//$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'";
		//echo $query = $this->db->query($sql);die;
		$rs = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,a.Wid')->from('works as s')->join('bookshelf_works as a', 's.id = a.Wid', 'right')->where('s.user_id', $usd['id'])->get();
		$data = $rs->result_array();
		//echo $this->db->last_query();die;
		return $data[0]['count'];

	}

	function getCountAuthorRecentTitle() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		//$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
		$now = date('Y-m-d');
		$beforedate = strtotime($now . ' -1 months');
		$final = date('Y-m-d', $beforedate);

		$rs = $this->db->select('count(*) as count')->from('works')->where('create_date >=', $final)->where('create_date <=', $now)->get();
		$data = $rs->result_array();
		//echo $this->db->last_query();die;
		return $data[0]['count'];

	}

	function getCountAuthorView() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('count(*) as count')->from('view_title')->get();
		$data = $rs->result_array();
		return $data[0]['count'];

	}

	function getCountDownload() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('count(*) as count')->from('view_downloaded_file')->get();
		$data = $rs->result_array();
		return $data[0]['count'];
	}

	function get_user_details() {
		$data = array();
		$usd = $this->session->userdata('logged_user');

		$rs = $this->db->select('id,name_first,name_last,email,postal_code,address')->where('id', $usd['id'])->from('users')->get();
		if ($rs->num_rows() > 0) {
			$data = $rs->row_array();

		}
		$rs->free_result();
		return $data;
	}

	function getMessageIdByWid($wid) {
		$data = array();
		$rs = $this->db->select('id')->where('wid', $wid)->from('messages')->get();
		if ($rs->num_rows() > 0) {
			$data = $rs->row_array();

		}
		return $data;
	}

}
