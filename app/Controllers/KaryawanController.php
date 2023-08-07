<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Karyawan;

class KaryawanController extends BaseController
{
    public function index()
    {
        $karyawan = new Karyawan();
        $datas['karyawan'] = $karyawan->findAll();
        // dd($datas);
        return view('tabel_karyawan/tbl_karyawan', $datas);
    }

    public function add()
    {
        return view('tabel_karyawan/add');
    }

    public function showEdit($id)
    {
        $karyawan = new Karyawan();
        $data['karyawan'] = $karyawan->find($id);

        return view('tabel_karyawan/edit', $data);
    }

    public function save()
    {
        $karyawan = new Karyawan();

        $data = [
            'nm_karyawan' => $this->request->getVar('nm_karyawan'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        ];
        $karyawan->insert($data);
        return redirect()->route('karyawan')->with('info', 'Data Updated Successfully');
    }

    public function edit($id)
    {
        $karyawan = new Karyawan();

        $data = [
            'id' => $this->request->getVar('id'),
            'nm_karyawan' => $this->request->getVar('nm_karyawan'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        ];
        // dd($data);
        $karyawan->update($id, $data);
        return redirect('karyawan')->with('info', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $karyawan = new Karyawan();
        $karyawan->delete($id);
        return redirect('karyawan')->with('info', 'Data Updated Successfully');
    }

    public function laporan()
    {
        return view('tabel_karyawan/karyawan_laporan');
    }

    public function cetak()
    {
        $karyawan =  new Karyawan();
        $data['karyawan'] = $karyawan->findAll();
        $html = view('tabel_karyawan/cetak', $data);

        $file = md5(time()) . '.pdf';
        $data = [
            'html' => $html,
            'apiKey' => 'r0eXKpEJaJs1kGtSClofn96AV4MYVFBHtw40JXOC9b5UyF6PztCmU2etfTZaQwKY',
        ];

        $dataString = json_encode($data);

        $ch = curl_init('https://api.html2pdf.app/v1/generate');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {
            echo 'Error #:' . $err;
        } else {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $file . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            echo $response;
        }
    }
}
