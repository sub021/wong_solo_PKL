<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrMasuk;
use App\Models\Supplier;
use App\Models\Barang;

class BrMasukController extends BaseController
{
    // public function index()
    // {
    //     return view('barang_masuk/br_masuk');
    // }
    public function show()
    {
        $suplier  = new Supplier();
        $data['supliers'] = $suplier->findAll();
        $barang = new Barang();
        $data['barangs'] = $barang->findAll();
        return view('brmasuk/add', $data);
    }
    public function index()
    {
        $brmasuk = new BrMasuk();

        $data = $brmasuk->join(
            'supplier',
            'brmasuk.suplier_id = supplier.id'
        )
            ->join('barang', 'brmasuk.barang_Id = barang.id')
            ->select('brmasuk.*')
            ->select('supplier.nm_supplier')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('brmasuk.id')
            ->findAll();

        $datas['brmasuk'] = $data;


        return view('brmasuk/br_masuk', $datas);
    }


    public function showEdit($id)
    {
        $suplier  = new Supplier();
        $data['supliers'] = $suplier->findAll();

        $barang = new Barang();

        $brmasuk = new BrMasuk();
        $barang_id = $brmasuk->select('barang_Id')->find($id);
        $data['barangs'] = $barang->find($barang_id);
        // dd($data['barangs']);
        $data['brmasuk'] = $brmasuk->join(
            'supplier',
            'brmasuk.suplier_id = supplier.id'
        )
            ->join('barang', 'brmasuk.barang_Id = barang.id')
            ->select('brmasuk.*')
            ->select('supplier.nm_supplier')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('brmasuk.id')
            ->find($id);

        return view('brmasuk/edit', $data);
    }
    public function save()
    {
        $brmasuk = new BrMasuk();
        $data = [
            'barang_Id' => $this->request->getVar('barang_Id'),
            'stok' => $this->request->getVar('stok'),
            'suplier_id' => $this->request->getVar('suplier_id'),
        ];
        $brmasuk->simpan_masuk_stok($data['barang_Id'], $data['stok'], $data['suplier_id']);
        // $brmasuk->insert($data);
        return redirect()->route('brmasuk')->with('info', 'Data Updated Successfully');
    }
    public function edit($id)
    {
        $brmasuk = new BrMasuk();

        $data = [
            'id' => $this->request->getVar('id'),
            'barang_Id' => $this->request->getVar('barang_Id'),
            'stok' => $this->request->getVar('stok'),
            'suplier_id' => $this->request->getVar('suplier_id'),
        ];
        // dd($data);
        $brmasuk->ubah_stok_masuk($data['barang_Id'], $data['stok'], $data['suplier_id'], $data['id']);
        // $brmasuk->update($id, $data);
        return redirect('brmasuk')->with('info', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $brmasuk = new BrMasuk();
        $brmasuk->delete($id);
        return redirect('brmasuk')->with('info', 'Data Updated Successfully');
    }

    public function laporan()
    {
        return view('brmasuk/brmasuk_laporan');
    }

    public function cetak()
    {

        $brmasuk = new BrMasuk();
        $data['brmasuk'] = $brmasuk->join(
            'supplier',
            'brmasuk.suplier_id = supplier.id'
        )
            ->join('barang', 'brmasuk.barang_Id = barang.id')
            ->select('brmasuk.*')
            ->select('supplier.nm_supplier')
            ->select('barang.nm_barang ,barang.kd_barang')
            ->orderBy('brmasuk.id')
            ->findAll();
        // return view('brmasuk/cetak', $data);
        $html = view('brmasuk/cetak', $data);

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
