<?php

namespace App\Http\Controllers;

use App\Models\JadwalIrs;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Prodi;
use Illuminate\Validation\Rule;

class BAKController extends Controller
{
    //ruangan
    public function ruangan()
    {
        $perPage = 10;
        $ruangans = Ruangan::all();
        $currentPage = request()->get('page', 1);
        $currentItems = $ruangans->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedRuangans = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, $ruangans->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('akademik.ruangan', compact('paginatedRuangans'));
    }

    //plotting ruangan
    public function plotruang()
    {
        // Ambil semua data ruangan yang sudah di-plot dan memiliki namaprodi
        $ruangansForTable = Ruangan::with('prodi')
                                   ->whereNotNull('namaprodi')
                                   ->get();
        
        // Ambil semua data ruangan yang belum disetujui dan belum di-plot untuk form
        $ruangansForForm = Ruangan::where('is_plotted', false)
                                  ->where('status', '!=', 'sudah disetujui')
                                  ->get();
        
        // Ambil semua data program studi
        $programStudis = Prodi::all();

        return view('akademik.plottingruang', compact('ruangansForTable', 'ruangansForForm', 'programStudis'));
    }

    //ruangan
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gedung' => 'required|string',
            'namaruang' => 'required|string',
            'kapasitas' => 'required|integer',
        ]);

        $ruangan = new Ruangan();
        $ruangan->gedung = $validatedData['gedung'];
        $ruangan->namaruang = $validatedData['namaruang'];
        $ruangan->kapasitas = $validatedData['kapasitas'];
        $ruangan->save();

        return response()->json([
            'success' => true,
            'message' => 'Ruangan berhasil ditambahkan.',
            'data' => $ruangan
        ]);
    }

    public function updateRuangan(Request $request, $id)
    {
    // Validasi data yang diterima
        $validatedData = $request->validate([
            'gedung' => 'required|string|max:255',
            'namaruang' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($validatedData);

        return response()->json(['success' => true, 'data' => $ruangan]);
    }

    public function storeRuangan(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'namaruang' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'gedung' => 'required|string|max:255',
        ]);

        // Simpan data ruangan baru
        Ruangan::create($validatedData);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function destroyRuangan($id)
    {
        $ruangan = Ruangan::find($id);

        if ($ruangan) {
            $ruangan->delete();
            return response()->json(['success' => true, 'message' => 'Ruangan berhasil dihapus.']);
        }

        return response()->json(['success' => false, 'message' => 'Ruangan tidak ditemukan.'], 404);
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('akademik.edit_ruangan', compact('ruangan'));
    }

    public function storePlottingRuang(Request $request)
    {
        $validatedData = $request->validate([
            'namaprodi' => 'required|string',
            'ruangan_id' => 'required|array',
            'ruangan_id.*' => 'exists:ruangan,id',
        ]);

        foreach ($validatedData['ruangan_id'] as $ruanganId) {
            $ruangan = Ruangan::find($ruanganId);
            $ruangan->namaprodi = $validatedData['namaprodi'];
            $ruangan->is_plotted = true;
            $ruangan->status = 'belum disetujui'; 
            $ruangan->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Plotting ruang berhasil ditambahkan.',
            'data' => Ruangan::whereIn('id', $validatedData['ruangan_id'])->get()
        ]);
    }

    public function getData()
    {
        $ruangans = Ruangan::with('prodi')
                           ->whereNotNull('namaprodi')
                           ->get();

        return response()->json($ruangans);
    }
    public function ajukanPlotting(Request $request)
    {
        // Ambil semua ruangan yang perlu diajukan dengan status 'belum disetujui' dan 'namaprodi' tidak null
        $ruangans = Ruangan::where('status', 'belum disetujui')
                            ->whereNotNull('namaprodi')
                            ->get();

        foreach ($ruangans as $ruangan) {
            $ruangan->status = 'menunggu persetujuan';
            $ruangan->save();
        }

        return response()->json(['success' => true, 'message' => 'Semua plotting ruang berhasil diajukan.']);
    }
    // Menampilkan data jadwal untuk halaman bak_jadwal
    public function index()
    {
        $jadwals = JadwalIrs::all();  // Ambil semua data jadwal
        return view('bak_jadwal', compact('jadwals')); // Kirim data ke view
    }

    // PERIODE
    public function showJadwal()
    {
        // Ambil semua data jadwal
        $periode = JadwalIrs::all();
        return view('akademik.periode', compact('periode')); // Kirim data ke view
    }
    public function simpanPeriode(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'jadwal_mulai' => 'required|date',
            'jadwal_berakhir' => 'required|date|after_or_equal:jadwal_mulai',
        ]);

        // Simpan data ke database
        $jadwal = JadwalIrs::create([
            'keterangan' => $request->keterangan,
            'jadwal_mulai' => $request->jadwal_mulai,
            'jadwal_berakhir' => $request->jadwal_berakhir,
        ]);

        // Mengembalikan response JSON untuk AJAX
        return response()->json([
            'success' => true,
            'is_edit' => false, // Menandakan bahwa ini adalah create, bukan edit
            'data' => $jadwal
        ]);
    }

  
    public function editPeriode($id)
    {
        try {
            $periode = JadwalIrs::findOrFail($id);

            return response()->json([
                'success' => true,
                'jadwal' => $periode]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Periode tidak ditemukan',
            ]);
        }
    }

    public function updatePeriode(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'jadwal_mulai' => 'required|date',
            'jadwal_berakhir' => 'required|date|after_or_equal:jadwal_mulai',
        ]);

        // Temukan jadwal berdasarkan ID
        $jadwal = JadwalIrs::findOrFail($id);

        // Perbarui data jadwal
        $jadwal->update([
            'keterangan' => $request->keterangan,
            'jadwal_mulai' => $request->jadwal_mulai,
            'jadwal_berakhir' => $request->jadwal_berakhir,
        ]);

        return response()->json([
            'success' => true,
            'is_edit' => true, // Menandakan bahwa ini adalah update, bukan create
            'data' => $jadwal
        ]);
    }

    public function hapusPeriode($id)
    {
        try {
            // Cari dan hapus data berdasarkan ID
            $periode = JadwalIrs::findOrFail($id);
            $periode->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
  }


