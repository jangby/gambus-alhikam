<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteContentController extends Controller
{
    // === HALAMAN SETTINGS (SOSMED & WA) ===
    public function index()
    {
        // Ambil setting pertama, jika tidak ada buat baru (default)
        $settings = SiteSetting::firstOrCreate([], [
            'whatsapp_number' => '628123456789',
            'address' => 'Alamat belum diatur'
        ]);
        
        $galleries = Gallery::latest()->get();

        return view('admin.site_content.index', compact('settings', 'galleries'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|numeric',
            'address' => 'required|string',
        ]);

        $settings = SiteSetting::first();
        $settings->update($request->all());

        return back()->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    // === HALAMAN GALERI (UPLOAD & KOMPRES) ===
    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5048', // Max 5MB
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $title = $request->title;
            
            // Proses Konversi ke WebP
            $imageName = time() . '_' . Str::slug($title) . '.webp';
            $storagePath = storage_path('app/public/gallery');
            
            // Pastikan folder ada
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0777, true);
            }

            // Fungsi kompresi native PHP (tanpa library tambahan)
            $this->convertToWebP($image->getRealPath(), $storagePath . '/' . $imageName, 75); // Quality 75%

            // Simpan ke Database
            Gallery::create([
                'title' => $title,
                'image_path' => 'gallery/' . $imageName,
            ]);
        }

        return back()->with('success', 'Foto berhasil diunggah & dikompres!');
    }

    public function destroyGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Hapus file fisik
        if(Storage::disk('public')->exists($gallery->image_path)){
            Storage::disk('public')->delete($gallery->image_path);
        }
        
        $gallery->delete();
        return back()->with('success', 'Foto dihapus.');
    }

    // --- FUNGSI HELPER: KONVERSI JPG/PNG KE WEBP ---
    private function convertToWebP($source, $destination, $quality = 80)
    {
        $info = getimagesize($source);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            default:
                return false;
        }

        // Simpan sebagai WebP
        imagewebp($image, $destination, $quality);
        imagedestroy($image);

        return true;
    }
}