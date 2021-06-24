<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class Surat extends Controller
{
    // public function search(Request $request)
    // {
    //     $keyword = $request->search;
    //     $surat = Surat::where('name', 'like', "%" . $keyword . "%")->paginate(5);
    //     return view('main', compact('surat'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }
    // public function search(Request $request)
    // {
    //     $surat = Surat::where([
    //         ['name', '!=', Null],
    //         [function ($query) use ($request){
    //             if(($term = $request->term)) {
    //                 $query->orWhere('name', 'Like', '%' . $term . '%')->get();
    //             }
    //         }]
    //     ])
    //     ->orderBy("id", "desc")
    //     ->paginate(10);

    //     return view('surat.index' , compact('projects'))
    //     ->with('i', (request()->input('page', 1) -1) *5);
    // }

    public function index($param = null)
    {
        $str = str_replace('_', ' ', $param);
        if($param == null || $param == 'Semua'){
            $data = DB::table('surat_visum')
                ->join('surat_instansi','surat_instansi.kd','=','surat_visum.kd_instansi')
                ->join('reg_periksa','reg_periksa.no_rawat','=','surat_visum.no_rawat')
                ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis') 
                ->join('dokter','dokter.kd_dokter','=','reg_periksa.kd_dokter')
                ->whereBetween('surat_visum.tanggalsurat', ['2020-01-01','2021-12-31'])
                
                ->select('surat_visum.no_surat','surat_visum.no_rawat','surat_instansi.instansi','surat_visum.status','pasien.nm_pasien',
                'surat_visum.kategori','dokter.nm_dokter','surat_visum.tanggalsurat')
                ->get();
            
        }else{
            $data = DB::table('surat_visum')
                ->join('surat_instansi','surat_instansi.kd','=','surat_visum.kd_instansi')
                ->join('reg_periksa','reg_periksa.no_rawat','=','surat_visum.no_rawat')
                ->join('dokter','dokter.kd_dokter','=','reg_periksa.kd_dokter')
                ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis') 
                ->whereBetween('surat_visum.tanggalsurat', ['2020-01-01','2021-12-31'])
                ->where('surat_visum.status','=',$str)
                ->select('surat_visum.no_surat','surat_visum.no_rawat','surat_instansi.instansi','surat_visum.status','pasien.nm_pasien',
                'surat_visum.kategori','dokter.nm_dokter','surat_visum.tanggalsurat')
                ->get(); 
        }
        
        return view('main',[
            'surat' => $data
        ]);
        
    }
}
