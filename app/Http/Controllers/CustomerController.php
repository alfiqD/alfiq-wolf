<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MultipleUpload;
use Illuminate\Http\Request;
    use App\Models\Pelanggan;

use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Halaman list pelanggan
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    // Halaman create pelanggan
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->only('name','email','phone'));

        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('uploads', $filename);
                MultipleUpload::create([
                    'filename' => $filename,
                    'ref_table' => 'pelanggan',
                    'ref_id' => $customer->id,
                ]);
            }
        }

        return redirect()->route('customer.index')->with('success','Pelanggan berhasil dibuat');
    }

    // Halaman edit pelanggan
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $files = MultipleUpload::where('ref_table','pelanggan')->where('ref_id',$id)->get();
        return view('customer.edit', compact('customer','files'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->only('name','email','phone'));

        if ($request->hasFile('files')) {
    foreach ($request->file('files') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/uploads', $filename); // simpan di storage/app/public/uploads

        MultipleUpload::create([
            'filename'  => $filename,
            'ref_table' => 'pelanggan',
            'ref_id'    => $pelanggan->pelanggan_id,
        ]);
    }
}

        return redirect()->back()->with('success','Data pelanggan berhasil diupdate');
    }


public function detail($id)
{
    $pelanggan = Pelanggan::findOrFail($id); // pakai primary key pelanggan_id
    $files     = MultipleUpload::where('ref_table', 'pelanggan')
                               ->where('ref_id', $id)
                               ->get();

    return view('pelanggan.detail', compact('pelanggan','files'));
}
    // Hapus file
    public function deleteFile($fileId)
    {
        $file = MultipleUpload::findOrFail($fileId);
        if(Storage::exists('uploads/'.$file->filename)){
            Storage::delete('uploads/'.$file->filename);
        }
        $file->delete();
        return redirect()->back()->with('success','File berhasil dihapus');
    }
}
