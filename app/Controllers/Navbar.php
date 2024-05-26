<?php

namespace App\Controllers;


class Navbar extends BaseController
{
    public function title(): string
    {
        return view('title');
    }


    public function getTitle()
    {

        $db = \Config\Database::connect();

        $query = 'SELECT * FROM `tbl_navbar_title` WHERE `flag` =1';
        $res = $db->query($query)->getResultArray();
        echo json_encode($res);

    }

    public function navbartitleedit(){
        $db = \Config\Database::connect();
        $modal = new AccessModel;

        $accId = $this->request->getPost('access_id');
        $accName = $this->request->getPost('access_title');

        $data = [
            'access_title' => $accName,
        ];
        $modal->update($accId, $data);

        $affectedRows = $db->affectedRows();
        if ($affectedRows === 1) {
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
