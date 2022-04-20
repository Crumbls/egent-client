<?php

namespace Egent\Client\Controllers;

use App\Jobs\ImportOfficeByMlsId;
use Egent\Office\Models\Office;
use Egent\Listing\Models\Property;
use App\Models\Role;
use App\Policies\OfficePolicy;
use App\Services\ReColorado\Manager;
use App\Services\ReColorado\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeStoreRequest;
use App\Http\Requests\OfficeUpdateRequest;
use Egent\Office\Controllers\AbstractController as Controller;

class DestroyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Egent\Office\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Office $office)
    {
        $this->authorize('delete', $office);

        $office->delete();

        return redirect()
            ->route('offices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
