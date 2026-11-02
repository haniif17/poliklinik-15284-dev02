<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::latest()->get();

        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli'  => 'required|string|max:25',
            'keterangan' => 'nullable|string',
            'tarif'      => 'required|integer|min:0',
        ], [
            'nama_poli.required' => 'Nama poli wajib diisi.',
            'tarif.required'     => 'Tarif wajib diisi.',
            'tarif.integer'      => 'Tarif harus berupa angka.',
        ]);

        $kodePoli = $this->nextKodePoli();

        $validated['kode_poli'] = $kodePoli;

        Poli::create($validated);

        return redirect()
            ->route('admin.polis.index')
            ->with('success', 'Poli berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $poli = Poli::findOrFail($id);

        return view('admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_poli'  => 'required|string|max:25',
            'keterangan' => 'nullable|string',
            'tarif'      => 'required|integer|min:0',
        ], [
            'nama_poli.required' => 'Nama poli wajib diisi.',
            'tarif.required'     => 'Tarif wajib diisi.',
            'tarif.integer'      => 'Tarif harus berupa angka.',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($validated);

        return redirect()
            ->route('admin.polis.index')
            ->with('success', 'Poli berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $poli = Poli::findOrFail($id);

        if ($poli->dokters()->exists()) {
            return back()->with('error', 'Poli tidak dapat dihapus karena masih memiliki dokter.');
        }

        $poli->delete();

        return redirect()
            ->route('admin.polis.index')
            ->with('success', 'Poli berhasil dihapus.');
    }

    private function nextKodePoli(): string
    {
        $usedCodes = Poli::query()
            ->whereNotNull('kode_poli')
            ->pluck('kode_poli')
            ->map(fn ($code) => strtoupper(trim($code)))
            ->filter(fn ($code) => preg_match('/^[A-Z]+$/', $code))
            ->flip();

        for ($number = 1; ; $number++) {
            $code = '';
            $value = $number;

            while ($value > 0) {
                $value--;
                $code = chr(65 + ($value % 26)) . $code;
                $value = intdiv($value, 26);
            }

            if (!isset($usedCodes[$code])) {
                return $code;
            }
        }
    }
}
