<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
// use \Spipu\Html2Pdf\Html2Pdf as pdf;
use Mpdf\Mpdf;
use Mpdf\Css\DefaultCss as css;


class BarangController extends BaseController
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('Pdf');
    // }

    public function index()
    {
        $barang = new Barang();
        $datas['barang'] = $barang->findAll();
        return view('barang/barang_data', $datas);
    }
    // public function add()
    // {
    //     return view('Barang/add');
    // }
    public function show()
    {
        return view('barang/add');
    }

    public function showEdit($id)
    {
        $barang = new Barang();
        $data['barang'] = $barang->find($id);

        return view('Barang/edit', $data);
    }
    public function barang_simpan()
    {
        $barang = new Barang();
        $data = [
            'kd_barang' => $this->request->getVar('kode_barang'),
            'nm_barang' => $this->request->getVar('nama_barang'),
            'stok' => $this->request->getVar('stok')
        ];

        $barang->insert($data);
        return redirect()->route('barang')->with('info', 'Barang Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $barang = new barang();

        $data = [
            'id' => $this->request->getVar('id'),
            'kd_barang' => $this->request->getVar('kode_barang'),
            'nm_barang' => $this->request->getVar('nama_barang'),
            'stok' => $this->request->getVar('stok'),
        ];
        // dd($data);
        $barang->update($id, $data);
        return redirect('barang')->with('info', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $barang = new Barang();
        $barang->delete($id);
        return redirect('barang')->with('info', 'Barang Berhasil di hapus');
    }

    public function laporan()
    {
        return view('barang/barang_laporan');
    }

    public function cetak()
    {

        // $pdf = new pdf('P', 'A4', 'en');
        $pdf = new Mpdf();

        $barang =  new Barang();
        $data['barang'] = $barang->findAll();
        // return view('barang/cetak', $data);

        $html = view('barang/cetak', $data);

        // Html2pdf Rocket
        // $apikey = '7f9c6ca1-5d4d-4d9b-8d68-57b964d4508a';
        // $value = $html; // can also be a url, starting with http..

        // // Convert the HTML string to a PDF using those parameters.  Note if you have a very long HTML string use POST rather than get.  See example #5
        // $result = file_get_contents("https://api.html2pdfrocket.com/pdf?apikey=" . urlencode($apikey) . "&value=" . urlencode($value));


        // header('Content-Description: File Transfer');
        // header('Content-Type: application/pdf');
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate');
        // header('Pragma: public');
        // header('Content-Length: ' . strlen($result));

        // // Make the file a downloadable attachment - comment this out to show it directly inside the
        // // web browser.  Note that you can give the file any name you want, e.g. alias-name.pdf below:
        // header('Content-Disposition: attachment; filename=' . $file);

        // // Stream PDF to user
        // echo $result;


        // html2pdf
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
