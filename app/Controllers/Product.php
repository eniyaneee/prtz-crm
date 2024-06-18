<?php

namespace App\Controllers;
use App\Models\ProductModel;



class Product extends BaseController
{
    public function index()
    {
        $this->session = \Config\Services::session();
        $db = \Config\Database::connect();

        if ($this->session->get('username') == '') {
            return redirect()->to('/');
        }

        $sql = "SELECT * FROM tbl_navbar_title WHERE flag = 1";
        $res['title'] = $db->query($sql)->getResultArray();
        // print_r($res);
        // exit;
        return view('product',$res);
    }

   


    
  

   


    public function insert(){
        $validation = \Config\Services::validation();
        $modal = new ProductModel;
        $db = \Config\Database::connect();
        $data = $this->request->getPost();

        

        


        $validation->setRules([
            'product_img' => 'uploaded[product_img]|is_image[product_img]|mime_in[product_img,image/jpg,image/jpeg,image/png]',
            'img_1' => 'uploaded[img_1]|is_image[img_1]|mime_in[img_1,image/jpg,image/jpeg,image/png]',
            'img_2' => 'uploaded[img_2]|is_image[img_2]|mime_in[img_2,image/jpg,image/jpeg,image/png]',
            'img_3' => 'uploaded[img_3]|is_image[img_3]|mime_in[img_3,image/jpg,image/jpeg,image/png]',

        ]);

        $productImg = $this->request->getFile('product_img');
        $Img1 = $this->request->getFile('img_1');
        $Img2 = $this->request->getFile('img_2');
        $Img3 = $this->request->getFile('img_3');

        if (!$validation->withRequest($this->request)->run()) {
            $res = $validation->getErrors();
            $result['code'] = 400;
            $result['status'] = 'Failure';
            $result['msg'] = 'Allowed Files : jpeg,jpg and png !!!';
            echo json_encode($result);

        } else {

            $productImg->move('./uploads/ProductImg/');
            $Img1->move('./uploads/Img1/');
            $Img2->move('./uploads/Img2/');
            $Img3->move('./uploads/Img3/');

            $file_path1 = '/uploads/ProductImg/';
            $file_path2 = '/uploads/Img1/';
            $file_path3 = '/uploads/Img2/';
            $file_path4 = '/uploads/Img3/';

            $Prodname = $productImg->getName();
            $img_1 = $Img1->getName();
            $img_2 = $Img2->getName();
            $img_3 = $Img3->getName();

            $data['product_img'] = $file_path1 . $Prodname;
            $data['img_1'] = $file_path2 . $img_1;
            $data['img_2'] = $file_path3 . $img_2;
            $data['img_3'] = $file_path4 . $img_3;

            // print_r($data);
            // exit;


            $insertData = $modal->insert($data);

        

           

            $affectedRows = $db->affectedRows();
            if ($affectedRows === 1) {
                $result['code'] = 200;
                $result['msg'] = 'Data Inserted Successfully';
                $result['status'] = 'success';
                echo json_encode($result);
            } else {
                $result['code'] = 400;
                $result['status'] = 'Failed';
                $result['msg'] = 'Something wrong';
                echo json_encode($result);
            }
        }

            
    }



    public function getproduct(){
        $db = \Config\Database::connect();
        $res = [];
        $query =
            'SELECT 
             *,B.navbar_title AS menu,C.navbar_page AS submenu FROM tbl_product AS A 
             INNER JOIN tbl_navbar_title AS B ON A.navbar_title_id = B.navbar_title_id
             INNER JOIN tbl_navbar_pages AS C ON A.navbar_page_id = C.navbar_pages_id
             WHERE A.flag = 1';
        $res = $db->query($query)->getResultArray();

        echo json_encode($res);
    }

    public function getsubmenu() {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('id');
    
        $query = 'SELECT * FROM tbl_navbar_pages WHERE navbar_title_id = ? AND flag = 1';
        $res = $db->query($query, [$id])->getResultArray();

        // Build HTML options
    $options = '';
    foreach ($res as $row) {
        $options .= '<option value="' . $row['navbar_pages_id'] . '">' . $row['navbar_page'] . '</option>';
    }
    
        echo json_encode($options);
    }


    public function deleteproduct()
    {

        $db = \Config\Database::connect();

        $id = $this->request->getPost('prod_id');

        $query = 'update`tbl_product` SET `flag` = 0 WHERE `product_id` = ?';
        $res = $db->query($query, $id);

        $affected_rows = $db->affectedRows();

        if ($affected_rows && $res) {
            $result['code'] = 200;
            $result['status'] = 'success';
            $result['message'] = 'Deleted Successfully';
            echo json_encode($result);
        } else {
            $result['code'] = 400;
            $result['status'] = 'Failure';
            $result['message'] = 'Something wrong';
            echo json_encode($result);
        }

    }

    public function updateproduct(){
        $db = \Config\Database::connect();

        $data = $this->request->getPost();


        $prodId = $this->request->getPost('prod_id');


        if ($this->request->getFile('product_img') != '') {
            $productImg = $this->request->getFile('product_img');
            $prodname = $productImg->getName();
            $prodname = str_replace(" ", "_", $prodname);
            $filePath = "uploads/ProductImg/";

            $productImg->move($filePath, $prodname);

            $data['product_img'] = $filePath . $prodname;
        }

        if ($this->request->getFile('img_1') != '') {
            $Img1 = $this->request->getFile('img_1');
            $img1 = $Img1->getName();
            $img1 = str_replace(" ", "_", $img1);
            $filePath1 = "uploads/Img1/";

            $Img1->move($filePath1, $img1);

            $data['img_1'] = $filePath1 . $img1;
        }

        if ($this->request->getFile('img_2') != '') {
            $Img2 = $this->request->getFile('img_2');
            $img2 = $Img2->getName();
            $img2 = str_replace(" ", "_", $img2);
            $filePath2 = "uploads/Img2/";

            $Img2->move($filePath2, $img2);

            $data['img_2'] = $filePath2 . $img2;
        }
        if ($this->request->getFile('img_3') != '') {
            $Img3 = $this->request->getFile('img_3');
            $img3 = $Img3->getName();
            $img3 = str_replace(" ", "_", $img3);
            $filePath3 = "uploads/Img3/";

            $Img3->move($filePath3, $img3);

            $data['img_3'] = $filePath3 . $img3;
        }


        $modal = new ProductModel;
        $updateRes = $modal->update($prodId, $data);
        $affectedRows1 = $db->affectedRows();

       

        

        if ($affectedRows1) {
            $result['code'] = 200;
            $result['msg'] = 'Data updates Successfully';
            $result['status'] = 'success';
            echo json_encode($result);
        } else {
            $result['code'] = 400;
            $result['msg'] = 'Something Wrong';
            $result['status'] = 'failure';
            echo json_encode($result);
        }
    }
    

   

      
    







    

    
}
