<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to build form efficiently with following features:
 * 	- render form with Bootstrap theme (support Vertical form only at this moment)
 * 	- reduce effort to repeated create labels, setting placeholder, etc. with flexibility
 * 	- shortcut functions to append form elements (currently support: text, password, textarea, submit)
 * 	- form validation and redirect page when failed, with field values maintained in flashdata
 *
 * TODO:
 * 	- support more field types (checkbox, dropdown, upload, etc.)
 * 	- automatically set "required" fields (matching with rule set)
 * 	- add inline error handling
 */
class Form_builder {

	protected $mFormCount = 0;
	
	public function __construct()
	{
		$CI =& get_instance();
		
		$CI->load->helper('form');
		$CI->load->library('form_validation');
		$CI->load->config('form_validation');

		// CI Bootstrap libraries
		$CI->load->library('system_message');
	}

	// Initialize a form and return the object
	public function create_form($url = NULL, $multipart = FALSE, $attributes = array())
	{
		$url = ($url===NULL) ? current_url() : $url;
		$form = new Form($url, $multipart, $attributes);
		$this->mFormCount++;
		$form->set_id($this->mFormCount);
		return $form;
	}
}

/**
 * Class to store components appear on a form
 */
class Form {

	protected $CI;

	protected $mPostUrl;			// target POST URL
	protected $mFormUrl;			// URL to display form (default: same as $mPostUrl)
	protected $mRuleGroup;			// name of validation rule group (match with keys inside application/config/form_validation.php)
	protected $mMultipart;			// whether the form supports multipart
	protected $mAttributes;

	// session key to store field data before redirection
	protected $mFormData;
	protected $mSessionKey;

	// Constructor
	public function __construct($url, $multipart, $attributes)
	{
		$this->CI =& get_instance();

		$this->mPostUrl = $url;
		$this->mFormUrl = current_url();
		$this->mMultipart = $multipart;
		$this->mAttributes = $attributes;
	}
	
	// Update form ID and according data from session (to support multiple forms on one page)
	public function set_id($id)
	{
		$this->mSessionKey = 'form-'.$id;
		$this->mFormData = $this->CI->session->flashdata($this->mSessionKey);
	}

	// Update Rule Group for validation
	// Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html#calling-a-specific-rule-group
	public function set_rule_group($rule_group)
	{
		$this->mRuleGroup = $rule_group;
	}

	// Update target URL:
	// 	- $this->mPostUrl = the page where the form is submitted to (i.e. "action" attribute of the form)
	// 	- $this->mFormUrl = the page where the form is located at (for redirection when failed)
	public function set_post_url($url)
	{
		$this->mPostUrl = $url;
	}
	public function set_form_url($url)
	{
		$this->mFormUrl = $url;
	}

	// Render form open tag
	public function open()
	{
		if ($this->mMultipart)
			return form_open_multipart($this->mPostUrl, $this->mAttributes);
		else
			return form_open($this->mPostUrl, $this->mAttributes);
	}

	// Render form close tag
	public function close()
	{
		return form_close();
	}

	// Get saved value for single field
	public function get_field_value($name)
	{
		return isset($this->mFormData[$name]) ? $this->mFormData[$name] : set_value($name);
	}

	/**
	 * Basic fields
	 */
	// Input field (type = text)
	public function field_text($name, $value = NULL, $extra = array(), $readonly = '', $title = '')
	{
		$data = array('type' => 'text', 'id' => $name, 'name' => $name, 'placeholder' => $title);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_input($data, $value, $extra, $readonly, $title);
	}

	// Input field (type = email)
	public function field_email($name = 'email', $value = NULL, $extra = array())
	{
		$data = array('type' => 'email', 'id' => $name, 'name'	=> $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_input($data, $value, $extra);
	}

	// Password field
	public function field_password($name = 'password', $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? '' : $value;
		return form_password($data, $value, $extra);
	}

	// Textarea field
	public function field_textarea($name, $value = NULL, $readonly = '', $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_textarea($data, $value, $readonly, $extra);
	}
	
	// Upload field
	public function field_upload($name, $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_upload($data, $value, $extra);
	}
	
	// Hidden field
	public function field_hidden($name, $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? '' : $value;
		return form_hidden($data, $value, $extra);
	}

	// Dropdown field
	public function field_dropdown($name, $options = array(), $selected = array(), $extra = array(), $title = '', $js = 0, $disabled =0)
	{
		$data = array('id' => $name, 'name' => $name, 'title' => $title);
		return form_dropdown($data, $options, $selected, $extra, $title, $js, $disabled);
	}

	/**
	 * reCAPTCHA
	 */
	public function field_recaptcha()
	{
		$config = $this->CI->config->item('recaptcha');
		$site_key = $config['site_key'];
		return '<div class="g-recaptcha" data-sitekey="'.$site_key.'"></div>';
	}
	
	/**
	 * Buttons
	 */
	// Submit button
	public function btn_submit($label = 'Submit', $extra = array())
	{
		$data = array('type' => 'submit', 'id' => 'act-btn');
		return form_button($data, $label, $extra);
	}

	// Reset button
	public function btn_reset($label = 'Reset', $extra = array())
	{
		$data = array('type' => 'reset');
		return form_button($data, $label, $extra);
	}

	/**
	 * Bootstrap 3 functions
	 */
	public function bs3_text($label, $name, $value = NULL, $readonly = '', $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_text($name, $value, $extra, $readonly, $title).'</div>';
	}

	public function bs3_phone($label, $name, $value = NULL, $readonly = '', $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control phoneformat';
		return '<div class="form-group">'.form_label($label, $name).$this->field_text($name, $value, $extra, $readonly, $title).'</div>';
	}

	public function bs3_smartphone($label, $name, $value = NULL, $readonly = '', $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control hpformat';
		return '<div class="form-group">'.form_label($label, $name).$this->field_text($name, $value, $extra, $readonly, $title).'</div>';
	}

	public function bs3_text_hidden($label, $name, $value = NULL, $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group hidden">'.form_label($label, $name).$this->field_text($name, $value, $extra, $title).'</div>';
	}

	public function bs3_color($label, $name, $value = NULL, $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).'<div class="input-group my-colorpicker1">'.$this->field_text($name, $value, $extra, $title).'<div class="input-group-addon"><i></i></i></div></div></div>';
	}	

	public function bs3_dropdown($label, $name, $options = array(), $selected = NULL, $extra = array(), $title = '', $js = 0, $disabled = 0)
	{
		$extra['class'] = 'form-control select2';
		return '<div class="form-group">'.form_label($label, $name).'<div>'.$this->field_dropdown($name,$options,$selected,$extra,$title,$js,$disabled).'</div></div>';
	}

	public function bs3_date($label, $name, $value = NULL, $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control datepicker pull-right';
		return '<div class="form-group">'.form_label($label,$name).'<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>'.$this->field_text($name, $value, $extra, $title).'</div></div>';
	}

	public function bs3_time($label, $name, $value = NULL, $extra = array(), $title = '')
	{
		$extra['class'] = 'form-control timepicker';
		return '<div class="bootstrap-timepicker"><div class="form-group">'.form_label($label,$name).'<div class="input-group"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div>'.$this->field_text($name, $value, $extra, $title).'</div></div></div>';
	}

	public function bs3_email($label, $name = 'email', $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_email($name, $value, $extra).'</div>';
	}

	public function bs3_password($label, $name = 'password', $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_password($name, $value, $extra).'</div>';
	}

	public function bs3_textarea($label, $name, $value = NULL, $readonly = '', $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_textarea($name, $value, $readonly, $extra).'</div>';
	}

	/* Displaying rich text from database using ckeditor */
	public function bs3_ckeditor($label, $name, $value = NULL)
	{
		return '<div class="form-group">'.form_label($label, $name).'
            <div class="ckeditor_val">'.$value.'</div></div>';
	}

	public function bs3_html($label, $name, $value = '')
	{
		return '<div class="form-group">'.form_label($label,$name).'<div class="ckeditor_val">'.$value.'</div></div>';
	}

    public function bs3_youtube($label, $url, $state = 'thumbnail', $id = NULL)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
        {
                $video_id = $match[1];
        }

        $html = '<div class="form-group">';
        $html .= '<label>'.$label.'</label>';
        if ($state == 'player') 
        {
        	$html .= '<div class="resp-container" style="text-align:center;">';
        	$html .= '<iframe class="resp-iframe" src="https://www.youtube.com/embed/'.$video_id.'?autoplay=1&showinfo=0" frameborder="0"></iframe><br>';
        	$html .= '</div>';
        } elseif ($state == 'thumbnail') {
        	$html .= '<a href="video_list/play_movie/'.$id.'"><img style="max-width:560px; width:100%; height:auto;" src="https://img.youtube.com/vi/'.$video_id.'/0.jpg" /></a>';
        }
        $html .= '</div>';

        return $html;
    }

	public function bs3_submit($label = 'Submit', $class = 'btn btn-primary', $extra = array())
	{
		$extra['class'] = $class;
		return $this->btn_submit($label, $extra);
	}

	public function bs3_reset($label = 'Cancel', $class = 'btn btn-default', $extra = array())
	{
		$extra['class'] = $class;
		return $this->btn_reset($label, $extra);
	}
	
	/**
	 * Success / Error messages
	 */
	public function messages()
	{
		return $this->CI->system_message->render();
	}

	/**
	 * Form Validation
	 */
	public function validate()
	{
		// only run validation upon form submission
		$post_data = $this->CI->input->post();
		if ( !empty($post_data) )
		{
			// Step 1. reCAPTCHA verification (skipped in development mode)
			$recaptcha_response = $this->CI->input->post('g-recaptcha-response');
			if ( isset($recaptcha_response) && ENVIRONMENT!='development' )
			{
				$config = $this->CI->config->item('recaptcha');
				$secret_key = $config['secret_key'];
				$recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
				$resp = $recaptcha->verify($recaptcha_response, $_SERVER['REMOTE_ADDR']);
				
				if (!$resp->isSuccess())
				{
					// save POST data to flashdata
					$this->CI->session->set_flashdata($this->mSessionKey, $post_data);

					// failed
					//$errors = $resp->getErrorCodes();
					$this->CI->system_message->set_error('ReCAPTCHA failed.');

					// redirect to form page (interrupt other operations)
					redirect($this->mFormUrl);
				}
			}

			// Step 2. CodeIgniter form validation
			$result = $this->CI->form_validation->run($this->mRuleGroup);
			if ($result===FALSE)
			{
				// save POST data to flashdata
				$this->CI->session->set_flashdata($this->mSessionKey, $post_data);

				// store validation error message from CodeIgniter
				$this->CI->system_message->set_error(validation_errors());

				// redirect to form page (interrupt other operations)
				redirect($this->mFormUrl);
			}
			else
			{
				// return TRUE to indicate the result is positive
				return TRUE;
			}
		}
	}
}
