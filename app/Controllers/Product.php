<?php

namespace App\Controllers;


class Product extends BaseController
{
    public function index()
    {
        $this->session = \Config\Services::session();
        if ($this->session->get('username') == '') {
            return redirect()->to('/');
        }
        return view('product');
    }

   


    
  

   


    public function insertpages(){
        $db = \Config\Database::connect();


        $title_id = $this->request->getPost('brand_id');

        $page_name = $this->request->getPost('modal_name');

        $query = 'INSERT INTO tbl_navbar_pages (navbar_title_id,navbar_page) VALUES (?,?)';
        $updateData = $db->query($query, [$title_id,$page_name]);
    
        // Get the number of affected rows
        $affected_rows = $db->affectedRows();
    
        // Prepare the result based on the success of the query
        if ($affected_rows > 0) {
            $result['code'] = 200;
            $result['status'] = 'success';
            $result['message'] = 'Inserted Successfully';
        } else {
            $result['code'] = 400;
            $result['status'] = 'failure';
            $result['message'] = 'Something went wrong';
        }
    
        // Return the result as a JSON response
        echo json_encode($result);


       

        



            
    }

   

    public function deletepage(){
        $db = \Config\Database::connect();

        // Get the ID from the POST request
        $id = $this->request->getPost('id');
        
        
        // Prepare the SQL query to update the flag using query binding to prevent SQL injection
        $sql = 'UPDATE `tbl_navbar_pages` SET `flag` = 0 WHERE `navbar_pages_id` = ?';
        
        // Execute the query with the bound parameter
        $result = $db->query($sql, [$id]);
        
        // Get the number of affected rows
        $affected_rows = $db->affectedRows();
        
        // Prepare the result array
        $response = [];
        
        // Prepare the result based on the success of the query
        if ($affected_rows > 0) {
            $response['code'] = 200;
            $response['status'] = 'success';
            $response['message'] = 'Updated Successfully';
        } else {
            $response['code'] = 400;
            $response['status'] = 'failure';
            $response['message'] = 'Something went wrong';
        }
        
        // Return the result as a JSON response
        echo json_encode($response);
    }


    public function updatepages(){

        $db = \Config\Database::connect();

        $title_id = $this->request->getPost('brand_id'); 
        $page_name = $this->request->getPost('modal_name');
        $id = $this->request->getPost('modal_id');

        $sql = "UPDATE `tbl_navbar_pages` SET navbar_title_id = :title: , navbar_page = :pages: WHERE navbar_pages_id = :navbar_pages_id:";
        $query = $db->query($sql, [
            'title' => $title_id,
            'pages' => $page_name,
            'navbar_pages_id' => $id
        ]);

        $affectedRows = $db->affectedRows();
        if ($affectedRows === 1) {
            $result['code'] = 200;
            $result['msg'] = 'Data updates Successfully';
            $result['status'] = 'success';
            
        } else {
            $result['code'] = 400;
            $result['msg'] = 'Something Wrong';
            $result['status'] = 'failure';
            
        }


        echo json_encode($result);
    





    }
    







    

    
}
