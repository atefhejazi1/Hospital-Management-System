<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EncryptDiagnosticRecords extends Command
{
    protected $signature = 'diagnostics:encrypt {--chunk=200 : Number of rows to process per batch}';

    protected $description = 'Encrypt any plaintext diagnosis/medicine columns left over from before the Diagnostic model\'s encrypted cast was added. Idempotent — safe to re-run.';

    public function handle(): int
    {
        $chunkSize = max(1, (int) $this->option('chunk'));
        $encryptedRows = 0;
        $skippedRows = 0;

        // Query via the DB facade rather than the Eloquent model: Diagnostic
        // now casts diagnosis/medicine as `encrypted`, so fetching through
        // Eloquent would attempt to decrypt these still-plaintext rows and
        // throw a DecryptException before we ever get a chance to fix them.
        DB::table('diagnostics')
            ->select('id', 'diagnosis', 'medicine')
            ->orderBy('id')
            ->chunkById($chunkSize, function ($rows) use (&$encryptedRows, &$skippedRows) {
                foreach ($rows as $row) {
                    $update = [];

                    foreach (['diagnosis', 'medicine'] as $column) {
                        $value = $row->{$column};

                        if ($value === null || $value === '' || $this->looksAlreadyEncrypted($value)) {
                            continue;
                        }

                        $update[$column] = Crypt::encryptString($value);
                    }

                    if ($update === []) {
                        $skippedRows++;
                        continue;
                    }

                    DB::table('diagnostics')->where('id', $row->id)->update($update);
                    $encryptedRows++;
                }
            });

        $this->info("Encrypted {$encryptedRows} row(s). Skipped {$skippedRows} row(s) (already encrypted or empty).");

        return self::SUCCESS;
    }

    /**
     * Distinguishes an already-encrypted payload from plaintext so the
     * command can be re-run safely without double-encrypting. A genuine
     * Laravel `encrypted` cast value MAC-verifies on decrypt; arbitrary
     * plaintext virtually never does.
     */
    private function looksAlreadyEncrypted(string $value): bool
    {
        try {
            Crypt::decryptString($value);

            return true;
        } catch (DecryptException) {
            return false;
        }
    }
}
