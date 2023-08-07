<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pemakaian as brpakai;
use App\Models\Barang;

class PakaiController extends BaseController

{



    public function index()
    {
        $brpakai = new brpakai();
        $data = $brpakai->join(
            'barang',
            'pemakaian.barang_Id = barang.id'
        )
            ->select('pemakaian.*')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('pemakaian.id')
            ->findAll();

        $datas['brpakai'] = $data;


        return view('brpakai/pakai', $datas);
    }

    public function show()
    {
        $barang = new Barang();
        $data['barangs'] = $barang->findAll();
        return view('brpakai/add', $data);
    }

    public function showEdit($id)
    {

        $brpakai = new brpakai();
        $barang = new Barang();
        $data['barangs'] = $barang->findAll();
        $data['brpakai'] = $brpakai->join(
            'barang',
            'pemakaian.barang_Id =barang.id'
        )
            ->select('pemakaian.*')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('pemakaian.id')
            ->find($id);

        return view('brpakai/edit', $data);
    }
    public function save()
    {


        $barang = new Barang();
        $brpakai = new brpakai();
        $data = [
            'barang_Id' => $this->request->getVar('barang_Id'),
            'stok' => $this->request->getVar('stok'),
        ];
        // $dtbarang = $barang->find($data['barang_Id']);
        // $minStok['stok'] = (Int)$dtbarang['stok'] - (Int)$data['stok']; 
        // // dd($minStok);
        //     $barang ->update($data['barang_Id'],$minStok);
        //     $brpakai->insert($data);
        $brpakai->Simpan_pemakaian_stok($data['barang_Id'], $data['stok']);
        // dd($barang->InsertID());

        return redirect()->route('brpakai')->with('info', 'Data Updated Successfully');
    }
    public function edit($id)
    {
        $brpakai = new brpakai();
        $oldId = $this->request->getVar('oldId');
        $data = [
            'barang_Id' => $this->request->getVar('barang_Id'),
            'stok' => $this->request->getVar('stok'),
        ];

        $brpakai->ubah_stok_pemakaian($data['barang_Id'], $data['stok'], $oldId);
        // $brpakai->update($id, $data);
        return redirect('brpakai')->with('info', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $brmasuk = new brpakai();
        $brmasuk->delete($id);
        return redirect('brpakai')->with('info', 'Data Updated Successfully');
    }

    public function laporan()
    {
        return view('brpakai/brpakai_laporan');
    }


    public function cetak()
    {
        $brpakai = new brpakai();
        $data = $brpakai->join(
            'barang',
            'pemakaian.barang_Id = barang.id'
        )
            ->select('pemakaian.*')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('pemakaian.id')
            ->findAll();

        $datas['brpakai'] = $data;


        // return view('brpakai/cetak', $datas);
        $html = view('brpakai/cetak', $datas);

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
