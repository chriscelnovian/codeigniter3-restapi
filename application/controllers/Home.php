<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Home extends RestController
{

    /*
    |-------------------------------------------------------------------
    | Construct
    |-------------------------------------------------------------------
    | 
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    /*
    |-------------------------------------------------------------------
    | Response for Successful Operation
    |-------------------------------------------------------------------
    | 
    */
    function response_get_success($data)
    {
        $response = array(
            'status'    => 200,
            'data'      => $data
        );
        return $response;
    }

    /*
    |-------------------------------------------------------------------
    | Response for Successful Operation
    |-------------------------------------------------------------------
    | 
    */
    function response_success()
    {
        $response = array(
            'status'    => 200,
            'message'   => 'Operation Success'
        );
        return $response;
    }

    /*
    |-------------------------------------------------------------------
    | Response for Failed Operation
    |-------------------------------------------------------------------
    | 
    */
    function response_failed()
    {
        $response = array(
            'status'    => 404,
            'message'   => 'Operation Failed'
        );
        return $response;
    }

    /*
    |-------------------------------------------------------------------
    | Response for Empty Result
    |-------------------------------------------------------------------
    | 
    */
    function response_empty_result()
    {
        $response = array(
            'status'    => 204,
            'message'   => 'Empty Result'
        );
        return $response;
    }

    /*
    |-------------------------------------------------------------------
    | Index
    |-------------------------------------------------------------------
    | 
    */
	function index_get()
	{
        // DO NOT REMOVE!!!
        // Default Index Get Method 
    }

    /*
    |-------------------------------------------------------------------
    | Get All User
    |-------------------------------------------------------------------
    | 
    */
	function user_all_get()
	{
        /* Data */
        $data = $this->home_model->fetch_users();

        /* Response */
        $response = $this->response_get_success($data);
        if(empty($data)) {
            $response = $this->response_empty_result();
        }
        $this->response($response);
    }

    /*
    |-------------------------------------------------------------------
    | Get One User
    |-------------------------------------------------------------------
    | 
    */
	function user_detail_get()
	{
        /* ID Value Check */
        $id = $this->get('id');
        if(empty($id)) {
            $response = $this->response_failed();
        } else {
            /* Data */
            $data = $this->home_model->fetch_user($id);

            /* Response */
            $response = $this->response_get_success($data);
            if(empty($data)) {
                $response = $this->response_empty_result();
            }
        }
        $this->response($response);
    }
    
    /*
    |-------------------------------------------------------------------
    | Add User
    |-------------------------------------------------------------------
    | 
    */
    function user_add_post()
    {
        /* Data */
        $data = array(
            'full_name' => $this->post('name'),
            'email'     => $this->post('email'),
            'password'  => md5($this->post('password'))
        );

        /* Array Empty Value(s) Checking */
        if(in_array(null, $data, true)) {
            $response = $this->response_failed();
        } else {
            /* Insert User Data */
            $process = $this->home_model->insert_user($data);

            /* Response */
            $response = $this->response_success();
            if(!$process) {
                $response = $this->response_failed();
            }
        }
        $this->response($response);
    }

    /*
    |-------------------------------------------------------------------
    | Edit User
    |-------------------------------------------------------------------
    | 
    */
    function user_edit_put()
    {
        /* Data */
        $data = array(
            'id'        => $this->put('id'),
            'full_name' => $this->put('name'),
            'email'     => $this->put('email'),
            'password'  => $this->put('password')
        );

        /* ID Value Check */
        if(empty($data['id'])) {
            $response = $this->response_failed();
        } else {
            /* Remove Empty Value from Array Data */
            $data = array_filter($data, 'strlen');
            
            /* Update User Data */
            $process = $this->home_model->update_user($data);

            /* Response */
            $response = $this->response_success();
            $response['message'] = 'Update Success';
            if(!$process) {
                $response = $this->response_failed();
            }
        }
        $this->response($response);
    }

    /*
    |-------------------------------------------------------------------
    | Remove User
    |-------------------------------------------------------------------
    | 
    */
    function user_remove_delete()
    {
        /* ID Value Check */
        $id = $this->delete('id');
        if(empty($id)) {
            $response = $this->response_failed();
        } else {
            /* Delete User Data */
            $process = $this->home_model->delete_user($id);

            /* Response */
            $response = $this->response_success();
            $response['message'] = 'Delete Success';
            if(!$process) {
                $response = $this->response_failed();
            }
        }
        $this->response($response);
    }

}
