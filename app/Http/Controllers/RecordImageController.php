<?php

namespace App\Http\Controllers;

use App\Models\RecordImage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecordImageController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(RecordImage $recordImage): RedirectResponse
    {
        $this->authorize('update', $recordImage->record);

        $recordImage->delete();

        return back();
    }
}
