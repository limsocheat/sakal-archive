<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Codedge\Updater\UpdaterManager;

class UpdateController extends Controller
{
    public function index(UpdaterManager $updater)
    {
        DB::beginTransaction();
        try {
            $message            = null;
            $versionAvailable   = null;
            $versionInstalled   = null;
            $type               = 'info';

            // Check if new version is available
            if ($updater->source()->isNewVersionAvailable()) :

                // Get the current installed version
                $versionInstalled = $updater->source()->getVersionInstalled();

                // Get the latest version
                $versionAvailable = $updater->source()->getVersionAvailable();

                // Create a release
                $release = $updater->source()->fetch($versionAvailable);

                // Run the update process
                $updater->source()->update($release);
            else :
                $message    = "No new version available.";
                $type       = 'warning';
            endif;

            DB::commit();
            return view('dashboard.updates.index', [
                'message'           => $message,
                'versionAvailable'  => $versionAvailable,
                'versionInstalled'  => $versionInstalled,
                'type'              => $type,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return view('dashboard.updates.index', [
                'message' => $e->getMessage(),
                'type'    => 'error',
            ]);
        }
    }
}
