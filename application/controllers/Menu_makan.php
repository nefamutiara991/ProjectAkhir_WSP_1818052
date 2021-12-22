<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');


class Menu_makan extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menumakan_model');
    }

    public function index_get()
    {
        $nama = $this->get('nama');

        if ($nama === null) {
            $nama = $this->Menumakan_model->getMenuMakan();
        } else {
            $nama = $this->Menumakan_model->getMenuMakan($nama);
        }

        if ($nama) {
            $this->response([
                'status' => true,
                'message' => $nama
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => $nama . ' tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $nama = $this->delete('nama');

        if ($nama === null) {
            $this->response([
                'status' => false,
                'message' => 'permintaan ini membutuhkan nama'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Menumakan_model->deleteMenuMakan($nama) > 0) {
                $this->response([
                    'status' => true,
                    'nama' => $nama,
                    'message' => 'berhasil dihapus'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'nama tidak ada yang cocok'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'gambar' => $this->post('gambar'),
            'harga' => $this->post('harga'),
        ];

        if ($this->Menumakan_model->createMenuMakan($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'berhasil menambahkan data'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $nama = $this->put('nama');
        $data = [
            'nama' => $this->put('nama'),
            'gambar' => $this->put('gambar'),
            'harga' => $this->put('harga'),
        ];

        if ($this->Menumakan_model->updateMenuMakan($data, $nama) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data berhasil diubah'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data gagal diubah'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
