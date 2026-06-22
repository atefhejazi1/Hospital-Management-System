<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

trait UploadTrait
{
    /**
     * Extensions allowed for uploaded images, matched against the file's
     * actual (server-detected) MIME type rather than the client-supplied
     * name or extension.
     */
    private array $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'webp'];

    public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {
        if (!$request->hasFile($inputname)) {
            return null;
        }

        $photo = $request->file($inputname);

        if (!$this->isUploadedImageSafe($photo)) {
            flash('Invalid Image!')->error()->important();
            return redirect()->back()->withInput();
        }

        $filename = $this->generateSafeFilename($photo);

        $Image = new Image();
        $Image->filename = $filename;
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();

        return $photo->storeAs($foldername, $filename, $disk);
    }

    public function verifyAndStoreImageForeach($varforeach, $foldername, $disk, $imageable_id, $imageable_type)
    {
        if (!$this->isUploadedImageSafe($varforeach)) {
            throw new RuntimeException('Invalid or unsafe file upload.');
        }

        $filename = $this->generateSafeFilename($varforeach);

        $Image = new Image();
        $Image->filename = $filename;
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();

        return $varforeach->storeAs($foldername, $filename, $disk);
    }

    /**
     * Validate that the upload is a genuine, non-corrupted file whose
     * server-detected MIME type maps to an allowed image extension. This is
     * defense-in-depth alongside FormRequest-level `image|mimes:...` rules —
     * it never trusts the client-supplied extension or filename.
     */
    private function isUploadedImageSafe(UploadedFile $file): bool
    {
        if (!$file->isValid()) {
            return false;
        }

        $extension = $file->extension(); // derived from the actual MIME type, not the client filename

        return in_array(strtolower($extension), $this->allowedImageExtensions, true);
    }

    /**
     * Generate a random, collision-free filename using the server-detected
     * extension, eliminating extension spoofing and path traversal via
     * client-controlled filenames (e.g. getClientOriginalName()/
     * getClientOriginalExtension()).
     */
    private function generateSafeFilename(UploadedFile $file): string
    {
        return Str::uuid()->toString() . '.' . strtolower($file->extension());
    }

    public function Delete_attachment($disk, $path, $id)
    {
        Storage::disk($disk)->delete($path);
        Image::where('imageable_id', $id)->delete();
    }
}
