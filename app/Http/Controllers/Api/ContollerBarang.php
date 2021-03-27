<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ContollerBarang extends Controller
{
    public function all(Request $request)
    {

        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $nama = $request->input('nama');
        $kategori = $request->input('kategori');

        if ($id) {
            $barang = Barang::leftJoin(
                'kategori',
                function ($join) {
                    $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
                    return $join;
                }
            )->find($id);

            if ($barang) {
                return ResponseFormatter::success($barang);
            } else {
                return ResponseFormatter::error(null, 404);
            }
        }

        $barang = Barang::leftJoin(
            'kategori',
            function ($join) {
                $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
                return $join;
            }
        );

        if ($nama) {
            $barang->where('nama_barang', 'like', '%' . $nama . '%');
        }

        if ($kategori) {
            $barang->where('barang.id_kategori', '=', $kategori);
        }

        if ($barang) {
            return ResponseFormatter::success($barang->paginate($limit));
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }

    public function kategori()
    {
        $barang = Kategori::all();

        if ($barang) {

            return ResponseFormatter::success($barang);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }
}
