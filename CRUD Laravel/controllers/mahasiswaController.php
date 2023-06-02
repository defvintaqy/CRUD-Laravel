<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use App\Models\mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;


class mahasiswaController extends Controller
{

    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        if (strlen($katakunci)) {
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%")
                ->paginate(5);
        } else {
            $data = mahasiswa::orderBy('nim', 'desc')->paginate(5);
        }
        return view('index')->with('data',  $data);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nim' => 'required|numeric|unique:mahasiswa,nim',
                'nama' => 'required',
                'jurusan' =>  'required',
            ],
            [
                'nim' => 'NIM harus diisi kawan',
                'nim.numeric' => 'NIM harus angka yakali huruf :v',
                'nim.unique' => 'eetss gaboleh sama nim nya',
                'nama' => 'NAMA juga bro',
                'jurusan' => 'JURUSAN juga diisi lah',
            ]

        );
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];

        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'data telah tertambah bro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nim' => 'required|numeric:mahasiswa,nim',
                'nama' => 'required',
                'jurusan' =>  'required',
            ],
            [
                'nim' => 'NIM harus diisi kawan',
                'nim.numeric' => 'NIM harus angka yakali huruf :v',
                'nama' => 'NAMA juga bro',
                'jurusan' => 'JURUSAN juga diisi lah',
            ]

        );
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'berhasil mengapus data lu bre');
    }
}
