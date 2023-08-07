<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Supplier;

class SupplierController extends BaseController
{
    public function index()
    {
        $suplier = new Supplier();
        $datas['suplier'] = $suplier->findAll();
        // dd($datas);
        return view('suplier\suplier_data', $datas);
    }

    public function add()
    {
        return view('suplier/add');
    }

    public function showEdit($id)
    {
        $suplier = new Supplier();
        $data['suplier'] = $suplier->find($id);

        return view('suplier/edit', $data);
    }

    public function save()
    {
        $suplier = new Supplier();

        $data = [
            'nm_supplier' => $this->request->getVar('nm_suplier'),
            'kd_supplier' => $this->request->getVar('kd_suplier'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),

        ];
        // dd($data);
        $suplier->insert($data);
        return redirect()->route('supplier')->with('info', 'Data Updated Successfully');
    }

    public function edit($id)
    {
        $suplier = new Supplier();

        $data = [
            'nm_supplier' => $this->request->getVar('nm_suplier'),
            'kd_supplier' => $this->request->getVar('kd_suplier'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),

        ];
        // dd($data);
        $suplier->update($id, $data);
        return redirect('supplier')->with('info', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $suplier = new Supplier();
        $suplier->delete($id);
        return redirect('supplier')->with('info', 'Data Updated Successfully');
    }

    public function laporan()
    {
        return view('suplier/suplier_laporan');
    }

    public function cetak()
    {
        $suplier = new Supplier();
        $datas['suplier'] = $suplier->findAll();
        // return view('suplier\cetak', $datas);
        $html = view('suplier\cetak', $datas);
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
