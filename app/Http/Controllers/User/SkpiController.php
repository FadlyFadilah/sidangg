<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkpiRequest;
use App\Http\Requests\StoreSkpiRequest;
use App\Http\Requests\UpdateSkpiRequest;
use App\Models\Skpi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SkpiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('skpi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skpis = Skpi::with(['nama', 'media'])->where('nama_id', auth()->user()->id)->get();

        return view('user.skpis.index', compact('skpis'));
    }

    public function create()
    {
        abort_if(Gate::denies('skpi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $namas = User::pluck('name', 'id')->prepend(trans('Silahkan Pilih Satu!'), '');

        return view('user.skpis.create', compact('namas'));
    }

    public function store(Request $request)
    {
        $attr = $request->all();
        $attr['nama_id'] = auth()->user()->id;
        $skpi = Skpi::create($attr);

        foreach ($request->input('file', []) as $file) {
            $skpi->addMedia(storage_path('app/public/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skpi->id]);
        }

        return redirect()->route('user.skpis.index');
    }

    public function edit(Skpi $skpi)
    {
        abort_if(Gate::denies('skpi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $namas = User::pluck('name', 'id')->prepend(trans('Silahkan Pilih Satu!'), '');

        $skpi->load('nama');

        return view('user.skpis.edit', compact('namas', 'skpi'));
    }

    public function update(Request $request, Skpi $skpi)
    {
        $attr = $request->all();
        $attr['nama_id'] = auth()->user()->id;
        $skpi->update($attr);

        if (count($skpi->file) > 0) {
            foreach ($skpi->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $skpi->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $skpi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('user.skpis.index');
    }

    public function show(Skpi $skpi)
    {
        abort_if(Gate::denies('skpi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skpi->load('nama');

        return view('user.skpis.show', compact('skpi'));
    }

    public function destroy(Skpi $skpi)
    {
        abort_if(Gate::denies('skpi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skpi->delete();

        return back();
    }

    public function massDestroy(MassDestroySkpiRequest $request)
    {
        Skpi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('skpi_create') && Gate::denies('skpi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Skpi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}