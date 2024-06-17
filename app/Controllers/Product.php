<?php

namespace App\Controllers;
use App\Models\ProductModel;



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

   

    
    







    

    
}
