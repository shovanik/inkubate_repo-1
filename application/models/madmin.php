<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class madmin extends CI_Model
{
    function verify_login()
    {
        //print_r($_POST);die;
        $rs = $this->db->select('*', false)->where('username', $this->input->post('username', true))->where('password', md5($this->input->post('password', true)))->get('users');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) { # authenticated make session
            $data = array();
            $data = $rs->row_array();
            //echo '<pre/>';print_r($data);die;
            $this->session->set_userdata('logged_admin', $data);
            
            if($data['user_type'] == '4')
            {
            return true;
            }
            else
            {
              return false;  
            }
            
            return true;
        } else {
            return false;
        }
    }

    ############  Counting Section ###################
    
    function get_all_members()
    {
        $data   = array();
        $rs=$this->db->select('id,name,email,password,status,created_date')->order_by('created_date','desc')->get('users');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }
    
    function chagestatus()
    {
        $type   = $this->uri->segment(3);
        $id     = $this->uri->segment(4);
        $data   = array();
        if($type=="ap")
        {
            $data['status'] = '1';
        }
        if($type=="b")
        {
            $data['status'] = '0';
        }
        
        $this->db->where('id',$id)->update('users',$data);
    }
    
    function deleteUser($id)
    {
        $this->db->where('id',$id)->delete('users');
    } 

    function get_game_count()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('status', '1')->get('game_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }
    function get_team_count()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('status', '1')->get('team_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }
    function get_league_count()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('status', '1')->get('league_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }

    function allFiction()
        {
            $total = 0;
            $data = array();
            $rs = $this->db->where('work_type_id', '1')->get('works');
            //echo $this->db->last_query();die;
            if ($rs->num_rows() > 0) {
                //$data   = $rs->row_array();
                $total = $rs->num_rows();
            }
            $rs->free_result();
            return $total;
        }
    function allNonFiction()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('work_type_id', '2')->get('works');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }
    function allFormByFiction( $f_id )
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('work_type_id', $f_id)->get('work_forms');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data   = $rs->result_array();
             foreach ($data as $each => $value) {
                $row = $this->db->where('work_form_id', $value['work_form_id'])->where('work_type_id', $f_id)->get('works')->result_array();
                $data[$each]['work_form_count'] = count($row);
               // echo $this->db->last_query();die;
        }
            //$total = $rs->num_rows();
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }
    
     function allPitchitHour()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('status', '1')->get('pitchit_hour');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data   = $rs->result_array();
             
        }
            //$total = $rs->num_rows();
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    } 
     
     function work_pitchits()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('is_pitchit', '1')->get('work_pitchits');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data   = $rs->result_array();
             
        }
            //$total = $rs->num_rows();
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }  
function selectTeam($teamid)
    {
        //echo 'hello';
        $data = '';
        $rs = $this->db->select('*')->where('league_id', $teamid)->where('status', '1')->order_by('id', 'desc')->get('team_info')->result_array();
        //echo $this->db->last_query();die;
          //foreach($rs as $value) {
            //$data .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            //$data .= 'hello';
          
            ?>
            
            <div class="control-group">
								<label class="control-label" for="selectError">Home Team</label>
								<div class="controls">
								  <select id="homeTeamId" name="homeTeamId" data-rel="chosen">
									
                                    <?php 
                                     if (count($rs) > 0) { 
                                    foreach($rs as $everyHometeam) {?>
                                    <option value="<?php echo $everyHometeam['id'];?>"><?php echo $everyHometeam['name'];?></option>
									<?php } } else {?>
                                    <option value=""><?php echo 'There is not a single team';?></option>
                                    <?php } ?>
                                    
								  </select>
								</div>
							  </div>
                              
                            <div class="control-group">
								<label class="control-label" for="selectError">Away Team</label>
								<div class="controls">
								  <select id="awayTeamId" name="awayTeamId" data-rel="chosen">
									
                                    <?php 
                                    if (count($rs) > 0) { 
                                    foreach($rs as $everyAwayteam) {?>
                                    <option value="<?php echo $everyAwayteam['id'];?>"><?php echo $everyAwayteam['name'];?></option>
									<?php } } else {?>
                                    <option value=""><?php echo 'There is not a single team';?></option>
                                    <?php } ?>
                                    
								  </select>
								</div>
							  </div>
       
       <?php
        
        //$rs->free_result();
        //echo $data;
    }

function get_recent_league()
    {
        $data = array();
        $rs = $this->db->select('*')->where('status', '1')->order_by('id', 'desc')->limit(1)->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }
 function get_league_name($id)
    {
        $data = array();
        $rs = $this->db->select('*')->where('id', $id)->order_by('id', 'desc')->limit(1)->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }   
 function get_recent_team()
    {
        $data = array();
        $rs = $this->db->select('*')->where('status', '1')->order_by('id', 'desc')->limit(1)->get('team_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    } 
 function get_recent_per_team($leag_id)
    {
        $data = array();
        $rs = $this->db->select('*')->where('league_id', $leag_id)->where('status', '1')->order_by('id', 'desc')->limit(1)->get('team_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }     
    ############  End Section ########################

    function get_all_season()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('season_type');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
        }
        $rs->free_result();
        return $data;
    }

    function insertSeason()
    {
        $data = array();

        $data['name'] = $this->input->post('name');
        $data['status'] = '1';
        $this->db->insert('season_type', $data);
        //echo $this->db->last_query();die;
        //print_r( $data );die;

        return 1;

    }
    
    function insertUser()
    {
        $data = array();

        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['payment'] = $this->input->post('payment');
        $data['verified'] = $this->input->post('verified');
        $data['status'] = $this->input->post('status');
        $this->db->insert('users', $data);
        //echo $this->db->last_query();die;
        //print_r( $data );die;

        return 1;

    }
    
    function updateUser()
    {
        $data = array();
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['payment'] = $this->input->post('payment');
        $data['verified'] = $this->input->post('verified');
        $data['status'] = $this->input->post('status');
        $this->db->where('id', $this->input->post('id'))->update('users', $data);
        //echo $this->db->last_query();die;
    }
    
    function getUserName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->get('users');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }

    function getSeasonName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->get('season_type');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }

    function updateSeason()
    {
        $data = array();
        $data['name'] = $this->input->post('name');
        $data['status'] = '1';
        $this->db->where('id', $this->input->post('id'))->update('season_type', $data);
        //echo $this->db->last_query();die;
    }

    function deleteSeason()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('season_type');
    }

    function insertLeague()
    {
        $data = array();
        //$data = $this->input->post();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/league_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/league_image', 0777, true);
        }
        if (!is_dir('./uploadImage/league_image/thumbs')) {
            chmod('./uploadImage/league_image', 0777);
            mkdir('./uploadImage/league_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/league_image/medium')) {
            chmod('./uploadImage/league_image', 0777);
            mkdir('./uploadImage/league_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/league_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/league_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/league_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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

            //die();
            /* Upload Image */
            $data['name'] = $this->input->post('name');
            $data['season_id'] = $this->input->post('seasonId');
            $data['league_date'] = $this->input->post('league_date');
            $data['league_image'] = $imgname;
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('league_info', $data);

        } else {
            $data['name'] = $this->input->post('name');
            $data['season_id'] = $this->input->post('seasonId');
            $data['league_date'] = $this->input->post('league_date');
            $data['league_image'] = '';
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('league_info', $data);
            //echo $this->db->last_query();die;
            //print_r( $data );die;
        }
        return 1;

    }

    function get_all_league()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('league_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {
                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->
                    row_array();
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];
                } else {
                    $data[$each]['season_name'] = 'No Season';
                }
            }
        }
        //echo $this->db->last_query();die;
        //echo '<pre>';print_r($data);die;
        $rs->free_result();
        return $data;
    }
    
    function get_all_league_name()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->group_by("name")->get('league_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {
                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->
                    row_array();
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];
                } else {
                    $data[$each]['season_name'] = 'No Season';
                }
            }
        }
        //echo $this->db->last_query();die;
        //echo '<pre>';print_r($data);die;
        $rs->free_result();
        return $data;
    }
    
    function get_all_league_by_name()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('league_info');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {
                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->
                    row_array();
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];
                } else {
                    $data[$each]['season_name'] = 'No Season';
                }
            }
        }
        //echo $this->db->last_query();die;
        //echo '<pre>';print_r($data);die;
        $rs->free_result();
        return $data;
    }

    function updateLeague()
    {
        $data = array();
        $data = $this->input->post();
        $id = $data['id'];
        //unset($data['id']);

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/league_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/league_image', 0777, true);
        }
        if (!is_dir('./uploadImage/league_image/thumbs')) {
            chmod('./uploadImage/league_image', 0777);
            mkdir('./uploadImage/league_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/league_image/medium')) {
            chmod('./uploadImage/league_image', 0777);
            mkdir('./uploadImage/league_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/league_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/league_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/league_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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

            $data['league_date'] = $this->input->post('league_date');
            $data['league_image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $id)->update('league_info', $data);

        } else {
            $data['league_date'] = $this->input->post('league_date');
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $id)->update('league_info', $data);
        }


    }

    function getLeagueName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }

        $rs->free_result();
        return $data;
    }

    function deleteLeague()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('league_info');
    }

    function insertTeam()
    {
        $data = array();
        //$data = $this->input->post();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/team_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/team_image', 0777, true);
        }
        if (!is_dir('./uploadImage/team_image/thumbs')) {
            chmod('./uploadImage/team_image', 0777);
            mkdir('./uploadImage/team_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/team_image/medium')) {
            chmod('./uploadImage/team_image', 0777);
            mkdir('./uploadImage/team_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/team_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/team_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/team_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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

            //die();
            /* Upload Image */
            $data['league_id'] = $this->input->post('leagueId');
            $data['name'] = $this->input->post('name');
            $data['team_image'] = $imgname;
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('team_info', $data);

        } else {
            $data['league_id'] = $this->input->post('leagueId');
            $data['name'] = $this->input->post('name');
            $data['team_image'] = '';
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('team_info', $data);
            //echo $this->db->last_query();die;
            //print_r( $data );die;
        }
        return 1;

    }

    function get_all_team()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('team_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {


                $row = $this->db->where('id', $value['league_id'])->where('status', '1')->get('league_info')->row_array();
                    
                if (!empty($row['name'])) {
                    $data[$each]['league_name'] = $row['name'];
                    }
                 else
                 {
                   $data[$each]['league_name'] = 'No League'; 
                 }   
                //$data[$each]['type']    = 'PROPERTY';
            }

        }
        $rs->free_result();
        return $data;
    }
    
    function get_all_selected_team($gameid)
    {
        $data = array();
        //$rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('team_info');
        $rs = $this->db->where('game_id', $gameid)->where('status', '1')->order_by('game_id', 'desc')->get('game_info')->row_array();
        $row = $this->db->where('league_id', $rs['league_id'])->where('status', '1')->get('team_info');
        //$row = $this->db->where('id', $value['league_id'])->where('status', '1')->get('league_info')->row_array();
        if ($row->num_rows() > 0) {
            $data = $row->result_array();


        }
        $row->free_result();
        return $data;
    }
    
    function get_all_team_per_league($id)
    {
        $data = array();
        $rs = $this->db->where('league_id',$id)->where('status', '1')->order_by('id', 'desc')->get('team_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {


                $row = $this->db->where('id', $value['league_id'])->where('status', '1')->get('league_info')->row_array();
                    
                if (!empty($row['name'])) {
                    $data[$each]['league_name'] = $row['name'];
                    }
                 else
                 {
                   $data[$each]['league_name'] = 'No League'; 
                 }   
                //$data[$each]['type']    = 'PROPERTY';
            }

        }
        $rs->free_result();
        return $data;
    }

    function updateTeam()
    {
        $data = array();
        //$data   = $this->input->post();
        //$id=     $data['id'];
        //unset($data['id']);

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/team_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/team_image', 0777, true);
        }
        if (!is_dir('./uploadImage/team_image/thumbs')) {
            chmod('./uploadImage/team_image', 0777);
            mkdir('./uploadImage/team_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/team_image/medium')) {
            chmod('./uploadImage/team_image', 0777);
            mkdir('./uploadImage/team_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/team_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/team_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/team_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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

            $data['league_id'] = $this->input->post('leagueId');
            $data['name'] = $this->input->post('name');
            $data['team_image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $this->input->post('id'))->update('team_info', $data);

        } else {
            $data['league_id'] = $this->input->post('leagueId');
            $data['name'] = $this->input->post('name');
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $this->input->post('id'))->update('team_info', $data);
        }


    }

    function getTeamName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->get('team_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();


            $row = $this->db->where('id', $data['league_id'])->where('status', '1')->get('league_info')->
                row_array();
            if (!empty($row['name'])) {
                $data['league_name'] = $row['name'];

            }
            //$data[$each]['type']    = 'PROPERTY';

        }

        $rs->free_result();
        return $data;
    }
    function get_all_filterleague()
    {
        $data = array();
        $team = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->
            get('team_info')->row_array();

        $rs = $this->db->where('id !=', $team['league_id'])->order_by('id', 'desc')->
            get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
        }
        $rs->free_result();
        return $data;
    }

    function deleteTeam()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('team_info');
    }


    function insertGame()
    {
        $data = array();

        $data['league_id'] = $this->input->post('leagueId');
        $data['home_team_id'] = $this->input->post('homeTeamId');
        $data['away_team_id'] = $this->input->post('awayTeamId');
        $data['season_id'] = $this->input->post('seasonId');
        //$data['category_id'] = $this->input->post('categoryId');
        $data['video'] = $this->input->post('video');
        $data['video_thumb_image'] = $this->input->post('video_thumb_image');
        $data['game_date'] = $this->input->post('game_date');
        $data['status'] = '1';
        //$data['modified_date']   = date("Y-m-d h:i:s");
        $this->db->insert('game_info', $data);
        //echo $this->db->last_query();die;
        //print_r( $data );die;

        return 1;

    }

    function get_all_game()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('game_id', 'desc')->get('game_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

            foreach ($data as $each => $value) {


                $row = $this->db->where('id', $value['league_id'])->where('status', '1')->get('league_info')->row_array();
                if (!empty($row['name'])) {
                    $data[$each]['league_name'] = $row['name'];
                } else {
                    $data[$each]['league_name'] = 'No League';
                }

                $row = $this->db->where('id', $value['home_team_id'])->where('status', '1')->get('team_info')->row_array();
                if (!empty($row['name'])) {
                    $data[$each]['home_team_name'] = $row['name'];
                } else {
                    $data[$each]['home_team_name'] = 'No Home Team';
                }

                $row = $this->db->where('id', $value['away_team_id'])->where('status', '1')->get('team_info')->row_array();
                if (!empty($row['name'])) {
                    $data[$each]['away_team_name'] = $row['name'];
                } else {
                    $data[$each]['away_team_name'] = 'No Away Team';
                }

                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->row_array();
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];

                } else {
                    $data[$each]['season_name'] = 'No Season';
                }

                //$data[$each]['type']    = 'PROPERTY';
            }

        }
        $rs->free_result();
        return $data;
    }

    function getGameName()
    {
        $data = array();
        $rs = $this->db->where('game_id', $this->uri->segment(3))->where('status', '1')->
            get('game_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();

        }

        $rs->free_result();
        return $data;
    }

    function updateGame()
    {
        $data = array();

        $data['league_id'] = $this->input->post('leagueId');
        $data['home_team_id'] = $this->input->post('homeTeamId');
        $data['away_team_id'] = $this->input->post('awayTeamId');
        $data['season_id'] = $this->input->post('seasonId');
        //$data['category_id'] = $this->input->post('categoryId');
        $data['video'] = $this->input->post('video');
        if($this->input->post('video_thumb_image') != '')
        {
        $data['video_thumb_image'] = $this->input->post('video_thumb_image');
        }
        $data['game_date'] = $this->input->post('game_date');
        $data['status'] = '1';
        $this->db->where('game_id', $this->input->post('id'))->update('game_info', $data);
        //echo $this->db->last_query();die;
    }

    function deleteGame()
    {
        $this->db->where('game_id', $this->uri->segment(3))->delete('game_info');
    }

    function insertGameCategory()
    {
        $data = array();
        $data['name'] = $this->input->post('name');
        $data['status'] = '1';
        //$data['modified_date']   = date("Y-m-d h:i:s");
        $this->db->insert('game_category_info', $data);
        //echo $this->db->last_query();die;
        //print_r( $data );die;

        return 1;

    }
    
  function get_all_game_season()
    {
        $data = array();
        
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
            
           }   
       
        $rs->free_result();
        return $data;
    }  
    
function get_all_game_season_name($leag_id)
    {
        $data = array();
        
        $data22 = array();
        $rs22 = $this->db->where('id', $leag_id)->order_by('id', 'desc')->get('league_info')->row_array();
        
        $rs = $this->db->where('name', $rs22['name'])->order_by('id', 'desc')->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
            
            foreach ($data as $each => $value) {


                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->row_array();
                //echo $this->db->last_query();die;
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];
                } else {
                    $data[$each]['season_name'] = 'No Season';
                }
            
              }
           }   
       
        $rs->free_result();
        return $data;
    }
    
 function get_all_game_season_type($name)
    {
        $data = array();
        
        $rs = $this->db->where('name', $name)->order_by('id', 'desc')->get('league_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
            
            foreach ($data as $each => $value) {


                $row = $this->db->where('id', $value['season_id'])->where('status', '1')->get('season_type')->row_array();
                //echo $this->db->last_query();die;
                if (!empty($row['name'])) {
                    $data[$each]['season_name'] = $row['name'];
                    $data[$each]['id'] = $row['id'];
                } else {
                    $data[$each]['season_name'] = 'No Season';
                }
            
              }
           }   
       
        $rs->free_result();
        return $data;
    }   
    function get_all_game_category()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('game_category_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
        }
        $rs->free_result();
        return $data;
    }
    function getGameCategoryName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->get('game_category_info');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();

        }

        $rs->free_result();
        return $data;
    }

    function updateGameCategory()
    {
        $data = array();
        $data['name'] = $this->input->post('name');
        $data['status'] = '1';
        $this->db->where('id', $this->input->post('id'))->update('game_category_info', $data);
        //echo $this->db->last_query();die;
    }

    function deleteGameCategory()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('game_category_info');
    }

    function get_page_content()
    {
        $data = array();
        $rs = $this->db->get('cms_page');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
        }
        $rs->free_result();
        return $data;
    }

    function get_page_content_by_id()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->get('cms_page');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }
        $rs->free_result();
        return $data;
    }

    function insertCMS()
    {
        $data = array();
        $data['meta_tag'] = $this->input->post('meta_tag');
        $data['meta_content'] = $this->input->post('meta_content');
        $data['page_url'] = $this->input->post('page_url');
        $data['page_title'] = $this->input->post('page_title');
        $data['page_content'] = $this->input->post('page_content');
        $data['status'] = '1';
        $this->db->insert('cms_page', $data);
        return 1;

    }
    function updateCMS()
    {
        $data = array();
        $data['meta_tag'] = $this->input->post('meta_tag');
        $data['meta_content'] = $this->input->post('meta_content');
        $data['page_url'] = $this->input->post('page_url');
        $data['page_title'] = $this->input->post('page_title');
        $data['page_content'] = $this->input->post('page_content');
        $data['status'] = '1';
        $this->db->where('id', $this->input->post('id'))->update('cms_page', $data);
        //echo $this->db->last_query();die;
    }

    function deleteCMS()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('cms_page');
    }

    function insertSiteSettings()
    {
        $data = array();
        $data = $this->input->post();
        //print_r($data);die;
        $data['created'] = date('y-m-d');
        $this->db->insert('site_settings', $data);
    }

    function get_all_settings()
    {
        $data = array();
        $rs = $this->db->order_by('page_name', 'asc')->get('site_settings');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();
        }
        $rs->free_result();
        return $data;

    }

    function get_settings_by_id()
    {
        $data = array();
        $id = $this->uri->segment(3);
        $rs = $this->db->where('id', $id)->order_by('page_name', 'asc')->get('site_settings');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();
        }
        $rs->free_result();
        return $data;
    }

    function updateSiteSettings()
    {
        $data = array();
        $data = $this->input->post();
        $id = $data['id'];
        unset($data['id']);
        $this->db->where('id', $id)->update('site_settings', $data);
    }

    function deleteSiteSettings()
    {
        $id = $this->uri->segment(3);
        $this->db->where('id', $id)->delete('site_settings');
    }

    function get_all_advertisement()
    {
        $data = array();
        $rs = $this->db->where('status', '1')->order_by('id', 'desc')->get('advertisement');
        if ($rs->num_rows() > 0) {
            $data = $rs->result_array();

        }
        $rs->free_result();
        return $data;
    }

    function insertAdvertisement()
    {
        $data = array();
        //$data = $this->input->post();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/ads_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/ads_image', 0777, true);
        }
        if (!is_dir('./uploadImage/ads_image/thumbs')) {
            chmod('./uploadImage/ads_image', 0777);
            mkdir('./uploadImage/ads_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/ads_image/medium')) {
            chmod('./uploadImage/ads_image', 0777);
            mkdir('./uploadImage/ads_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/ads_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/ads_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/ads_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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

            $data['name'] = $this->input->post('name');
            $data['ads_image'] = $imgname;
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('advertisement', $data);

        } else {
            $data['name'] = $this->input->post('name');
            $data['ads_image'] = '';
            $data['status'] = '1';
            //$data['modified_date']    = date("Y-m-d h:i:s");
            $this->db->insert('advertisement', $data);
            //echo $this->db->last_query();die;
            //print_r( $data );die;
        }
        return 1;

    }

    function getAdvertisementName()
    {
        $data = array();
        $rs = $this->db->where('id', $this->uri->segment(3))->where('status', '1')->get('advertisement');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();

        }

        $rs->free_result();
        return $data;
    }
    
    function getBackgroundImage()
    {
        $data = array();
        $rs = $this->db->where('id', '1')->where('status', '1')->get('background_image');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();

        }

        $rs->free_result();
        return $data;
    }
    
   function getSmallBannerImage()
    {
        $data = array();
        $rs = $this->db->where('id', '1')->where('status', '1')->get('small_banner_image');
        if ($rs->num_rows() > 0) {
            $data = $rs->row_array();

        }

        $rs->free_result();
        return $data;
    }
    
    function updateSmallBanner()
    {
        $data = array();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/small_banner_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/small_banner_image', 0777, true);
        }
        if (!is_dir('./uploadImage/small_banner_image/thumbs')) {
            chmod('./uploadImage/small_banner_image', 0777);
            mkdir('./uploadImage/small_banner_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/small_banner_image/medium')) {
            chmod('./uploadImage/small_banner_image', 0777);
            mkdir('./uploadImage/small_banner_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/small_banner_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/small_banner_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/small_banner_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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
            
        $rs=$this->db->select('id')->order_by('modified_date','desc')->get('small_banner_image');
        if($rs->num_rows()>0)
        {
            //$data   = $rs->result_array();
            $data['image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', '1')->update('small_banner_image', $data);
        }
        else
        {
            
            $data['image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->insert('small_banner_image', $data);
        }

        } else {
            
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', '1')->update('small_banner_image', $data);
        }

    }
     
    
    function updateAdvertisement()
    {
        $data = array();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/ads_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/ads_image', 0777, true);
        }
        if (!is_dir('./uploadImage/ads_image/thumbs')) {
            chmod('./uploadImage/ads_image', 0777);
            mkdir('./uploadImage/ads_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/ads_image/medium')) {
            chmod('./uploadImage/ads_image', 0777);
            mkdir('./uploadImage/ads_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/ads_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/ads_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/ads_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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
            $data['name'] = $this->input->post('name');
            $data['ads_image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $this->input->post('id'))->update('advertisement', $data);

        } else {
            $data['name'] = $this->input->post('name');
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', $this->input->post('id'))->update('advertisement', $data);
        }

    }

    function deleteAdvertisement()
    {
        $this->db->where('id', $this->uri->segment(3))->delete('advertisement');
    }
    
    function updateBackground()
    {
        $data = array();

        if (!is_dir('uploadImage/')) {
            mkdir('./uploadImage/', 0777, true);
            chmod('./uploadImage/', 0777);

        }
        if (!is_dir('./uploadImage/background_image')) {
            chmod('./uploadImage/', 0777);
            mkdir('./uploadImage/background_image', 0777, true);
        }
        if (!is_dir('./uploadImage/background_image/thumbs')) {
            chmod('./uploadImage/background_image', 0777);
            mkdir('./uploadImage/background_image/thumbs', 0777, true);
        }
        if (!is_dir('./uploadImage/background_image/medium')) {
            chmod('./uploadImage/background_image', 0777);
            mkdir('./uploadImage/background_image/medium', 0777, true);
        }

        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
        if ($_FILES['image']['name'] != "") {

            //print_r($_FILES['image']);die;
            //echo $_REQUEST['propertyId'];
            // exit();
            $this->load->library('image_lib');

            $configUpload['upload_path'] = './uploadImage/background_image/';
            $configUpload['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['max_size']       = '0';
            //$configUpload['max_width']      = '0';
            //$configUpload['max_height']     = '0';
            $configUpload['encrypt_name'] = true;
            $this->load->library('upload', $configUpload);
            //$this->image_lib->initialize($configUpload);
            /* size 64*72 for comments */
            $configThumb = array();
            $configThumb['image_library'] = 'gd2';
            $configThumb['create_thumb'] = true;
            $configThumb['new_image'] = './uploadImage/background_image/thumbs/';
            $configThumb['maintain_ratio'] = true;
            $configThumb['width'] = 64;
            $configThumb['height'] = 72;
            $configThumb['thumb_marker'] = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */

            /* size 167*167 for profile page */
            $configThumbMedium = array();
            $configThumbMedium['image_library'] = 'gd2';
            $configThumbMedium['create_thumb'] = true;
            $configThumbMedium['new_image'] = './uploadImage/background_image/medium/';
            $configThumbMedium['maintain_ratio'] = true;
            $configThumbMedium['width'] = 167;
            $configThumbMedium['height'] = 167;
            $configThumbMedium['thumb_marker'] = "";
            /* size 167*167 for profile page */

            if (!$this->upload->do_upload('image')) {
                //return 0;
                echo $this->upload->display_errors('<p>', '</p>');
                die;
            }

            $uploadedDetails = $this->upload->data();
            //echo "<pre>";print_r($uploadedDetails);echo "</pre>"; exit();

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
            
        $rs=$this->db->select('id')->order_by('modified_date','desc')->get('background_image');
        if($rs->num_rows()>0)
        {
            //$data   = $rs->result_array();
            $data['image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', '1')->update('background_image', $data);
        }
        else
        {
            
            $data['image'] = $imgname;
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->insert('background_image', $data);
        }

        } else {
            
            $data['status'] = '1';
            $data['modified_date'] = date("Y-m-d h:i:s");
            $this->db->where('id', '1')->update('background_image', $data);
        }

    }
    
    
    /*function allFictionWork()
    {
        $this->db->select("w.id, w.title, w.create_date, extract, wf.work_form_name, CONCAT(u.name_first,' ', u.name_middle,' ', u.name_last) as name, c.category_name", false)
            ->join("work_forms wf", "wf.work_form_id = w.work_form_id")
            ->join("users u", "u.id = w.user_id")
            ->join("work_categories wc", "wc.Wid = w.id")
            ->join("categories c", "c.id = wc.cid")
            ->where( 'w.work_type_id', '1' );
        $row=$this->db->get('works w')->result_array();
        echo $this->db->last_query();die;
        return $row;
    }*/
    
    
    function allWorkByFiction( $f_id, $offset=null,$limit=null )
    {
        $data   = array();
        $this->db->select("w.id, w.title, w.create_date, w.extract, wf.work_form_name, w.user_id, CONCAT(u.name_first,' ', u.name_middle,' ', u.name_last) as name", false)
            ->join("work_forms wf", "wf.work_form_id = w.work_form_id")
            ->join("users u", "u.id = w.user_id")
            ->where( 'w.work_type_id', $f_id )
            ->limit($limit,$offset);
        $rs=$this->db->get('works w');
        //echo $this->db->last_query();die;
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
            foreach($data as $each=>$value){
                $row_categories=$this->db->select("c.category_name")
                    ->join("work_categories wc", "wc.cid = c.id")
                    ->where('wc.Wid',$value['id'])->get('categories c')->row_array();
                $data[$each]['category_name'] = isset($row_categories['category_name'])?$row_categories['category_name']:'';
                
                $row_tags=$this->db->select("t.tag_name")
                    ->join("work_tags wt", "wt.tid = t.id")
                    ->where('wt.Wid',$value['id'])->get('tags t')->row_array();
                $data[$each]['tag_name'] = isset($row_tags['tag_name'])?$row_tags['tag_name']:'';
                //echo $this->db->last_query();die;
            }
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
        
    }
    
    function allWorkById( $wid )
    {
        $this->db->select("w.id, w.title, w.create_date, w.extract, w.synopsis, w.user_id, CONCAT(u.name_first,' ', u.name_middle,' ', u.name_last) as name, v.visibility_name, wt.work_type_name, wf.work_form_name", false)
            ->join("visibilities v", "v.visibility_id = w.visibility_id", 'left')
            ->join("work_types wt", "wt.work_type_id = w.work_type_id", 'left')
            ->join("work_forms wf", "wf.work_form_id = w.work_form_id", 'left')
            ->join("users u", "u.id = w.user_id", "left")
            ->where('w.id', $wid );
        $rs=$this->db->get('works w');
        //echo $this->db->last_query();die;
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
            foreach($data as $each=>$value){
                $row_categories=$this->db->select("c.category_name")
                    ->join("work_categories wc", "wc.cid = c.id")
                    ->where('wc.Wid',$value['id'])->get('categories c')->row_array();
                $data[$each]['category_name'] = isset($row_categories['category_name'])?$row_categories['category_name']:'';
                
                $row_tags=$this->db->select("t.tag_name")
                    ->join("work_tags wt", "wt.tid = t.id")
                    ->where('wt.Wid',$value['id'])->get('tags t')->row_array();
                $data[$each]['tag_name'] = isset($row_tags['tag_name'])?$row_tags['tag_name']:'';
                //echo $this->db->last_query();die;
            }
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }
    
    
    function searchAllWorkByFiction( $wt_id, $offset=null,$limit=null, $value )
    {
        $data   = array();
        $this->db->select("w.id, w.title, w.create_date, w.extract, wf.work_form_name, w.user_id, CONCAT(u.name_first,' ', u.name_middle,' ', u.name_last) as name", false)
            ->join("work_forms wf", "wf.work_form_id = w.work_form_id")
            ->join("users u", "u.id = w.user_id", "left")
            ->where( 'w.work_type_id', $wt_id )
            ->where( 'w.work_form_id', $value )
            ->limit($limit,$offset);
        $rs=$this->db->get('works w');
        //echo $this->db->last_query();//die;
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
            foreach($data as $each=>$value){
                $row_categories=$this->db->select("c.category_name")
                    ->join("work_categories wc", "wc.cid = c.id")
                    ->where('wc.Wid',$value['id'])->get('categories c')->row_array();
                $data[$each]['category_name'] = isset($row_categories['category_name'])?$row_categories['category_name']:'';
                
                $row_tags=$this->db->select("t.tag_name")
                    ->join("work_tags wt", "wt.tid = t.id")
                    ->where('wt.Wid',$value['id'])->get('tags t')->row_array();
                $data[$each]['tag_name'] = isset($row_tags['tag_name'])?$row_tags['tag_name']:'';
                //echo $this->db->last_query();die;
            }
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
        
    }
    
    function SearchAllFiction( $wt_id, $wf_id )
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('work_type_id', $wt_id)->where('work_form_id', $wf_id)->get('works');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }
    
    
    
    

}
