<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ControllerBarang extends Controller
{
    public function all(Request $request)
    {

        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $nama = $request->input('nama');
        $kategori = $request->input('kategori');
        $filterKategori = $request->input('filterKategori');

        if ($id) {
            $barang = Barang::leftJoin(
                'kategori',
                function ($join) {
                    $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
                    // $join->on(`keranjang` . `id_barang`, '=', '`barang`.`id_barang`');
                    return $join;
                }
            )
                ->leftJoin(
                    'keranjang',
                    function ($join1) {
                        $join1->on('keranjang.id_barang', '=', 'barang.id_barang');
                        return $join1;
                    }
                )->find($id);

            if ($barang) {
                return ResponseFormatter::success($barang);
            } else {
                return ResponseFormatter::error(null, 404);
            }
        }


        // $barang = Barang::leftJoin(
        //     'kategori',
        //     function ($join) {
        //         $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
        //         return $join;
        //     }
        // )
        //     ->leftJoin(
        //         'keranjang',
        //         function ($join1) {
        //             $join1->on('barang.id_barang', '=', 'keranjang.id_barang');
        //             return $join1;
        //         }
        //     );
        $barang = Barang::select('barang.id_barang', 'barang.nama_barang', 'barang.harga_barang', 'kategori.id_kategori', 'keranjang.jml_barang', 'keranjang.id_costumer', 'barang.foto_barang', 'keranjang.harga AS hargaSementara');
        $barang->leftJoin(
            'kategori',
            function ($join) {
                $join->on('barang.id_kategori', '=', 'kategori.id_kategori');
                return $join;
            }

        );
//         $barang->leftJoin(
//             'keranjang',
//             function ($join1) {
//                 $join1->on('barang.id_barang', '=', 'keranjang.id_barang');
//                 return $join1;
//             }
//         );




//         )
//             ->leftJoin(
//                 'keranjang',
//                 function ($join1) {
//                     $join1->on('keranjang.id_barang', '=', 'barang.id_barang');
//                     return $join1;
//                 }
//             );


        if ($nama) {
            $barang->where('nama_barang', 'like', '%' . $nama . '%');
            $limit = 20000;
        }

        if ($kategori) {
            $barang->where('barang.id_kategori', '=', $kategori);
            $limit = 20000;
        }

        if ($filterKategori) {
            $barang->where('kategori.nama_kategori', '=', $filterKategori);
            $limit = 20000;
        }

       if ($barang) {
            return ResponseFormatter::success($barang->paginate($limit), "mas");
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }

    public function kategori()
    {

        $barang = Kategori::select();

        if ($barang) {

            return ResponseFormatter::success($barang->paginate(2));
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }


    public function kategoriAll()
    {

        $barang = Kategori::get();

        if ($barang) {

            return ResponseFormatter::success($barang);
        } else {
            return ResponseFormatter::error(null, 404);
        }
    }
}
