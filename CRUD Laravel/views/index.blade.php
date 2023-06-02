@extends('template.template')
@section('konten')
<br>
<h2 style="text-align: center">Data Mahasiswa</h2>
<br>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form class="d-flex" action="" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                    placeholder="Cari data mahasiswa" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>

        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='{{ url('/mahasiswa/create') }}' class="btn btn-primary">+ Tambah Data</a>
        </div>

        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">NIM</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-2">Jurusan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $data->firstItem(); ?>
                @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td>
                            <a href='{{ url('mahasiswa/' . $item->nim . '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Yakin dihapus nih?!?! {{ $item->nama}}')" class="d-inline" action="{{ url('mahasiswa/' . $item->nim) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}

    </div>
@endsection
<!-- AKHIR DATA -->
