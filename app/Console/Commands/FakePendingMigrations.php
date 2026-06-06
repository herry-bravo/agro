<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FakePendingMigrations extends Command
{
    protected $signature   = 'migrate:fake-pending';
    protected $description = 'Mark all pending migrations as run without executing them';

    public function handle()
    {
        $batch = (DB::table('migrations')->max('batch') ?? 0) + 1;
        $path  = database_path('migrations');
        $files = File::files($path);
        $count = 0;

        foreach ($files as $file) {
            $name = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            if (!DB::table('migrations')->where('migration', $name)->exists()) {
                DB::table('migrations')->insert([
                    'migration' => $name,
                    'batch'     => $batch,
                ]);
                $this->line("  Faked: <info>{$name}</info>");
                $count++;
            }
        }

        $this->info("\nDone! {$count} migration(s) marked as run.");
    }
}
