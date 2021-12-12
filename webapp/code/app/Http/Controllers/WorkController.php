<?php

namespace App\Http\Controllers;

use App\Repositories\WorkRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WorkController extends AppBaseController
{
    /** @var  WorkRepository */
    private $workRepository;

    public function __construct(WorkRepository $workRepo)
    {
        $this->workRepository = $workRepo;
    }

    /**
     * Display a listing of the Work.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->workRepository->pushCriteria(new RequestCriteria($request));
        $works = $this->workRepository->all();

        return view('works.index')
            ->with('works', $works);
    }

    /**
     * Show the form for creating a new Work.
     *
     * @return Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created Work in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $work = $this->workRepository->create($input);

        Flash::success('Work saved successfully.');

        return redirect(route('works.index'));
    }

    /**
     * Display the specified Work.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $work = $this->workRepository->findWithoutFail($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        return view('works.show')->with('work', $work);
    }

    /**
     * Show the form for editing the specified Work.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $work = $this->workRepository->findWithoutFail($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        return view('works.edit')->with('work', $work);
    }

    /**
     * Update the specified Work in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $work = $this->workRepository->findWithoutFail($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        $work = $this->workRepository->update($request->all(), $id);

        Flash::success('Work updated successfully.');

        return redirect(route('works.index'));
    }

    /**
     * Remove the specified Work from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $work = $this->workRepository->findWithoutFail($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        $this->workRepository->delete($id);

        Flash::success('Work deleted successfully.');

        return redirect(route('works.index'));
    }
}
