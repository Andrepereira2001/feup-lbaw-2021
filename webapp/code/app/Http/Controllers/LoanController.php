<?php

namespace App\Http\Controllers;

use App\Repositories\LoanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LoanController extends AppBaseController
{
    /** @var  LoanRepository */
    private $loanRepository;

    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepository = $loanRepo;
    }

    /**
     * Display a listing of the Loan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->loanRepository->pushCriteria(new RequestCriteria($request));
        $loans = $this->loanRepository->all();

        return view('loans.index')
            ->with('loans', $loans);
    }

    /**
     * Show the form for creating a new Loan.
     *
     * @return Response
     */
    public function create()
    {
        return view('loans.create');
    }

    /**
     * Store a newly created Loan in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $loan = $this->loanRepository->create($input);

        Flash::success('Loan saved successfully.');

        return redirect(route('loans.index'));
    }

    /**
     * Display the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loan = $this->loanRepository->findWithoutFail($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        return view('loans.show')->with('loan', $loan);
    }

    /**
     * Show the form for editing the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loan = $this->loanRepository->findWithoutFail($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        return view('loans.edit')->with('loan', $loan);
    }

    /**
     * Update the specified Loan in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $loan = $this->loanRepository->findWithoutFail($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        $loan = $this->loanRepository->update($request->all(), $id);

        Flash::success('Loan updated successfully.');

        return redirect(route('loans.index'));
    }

    /**
     * Remove the specified Loan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loan = $this->loanRepository->findWithoutFail($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        $this->loanRepository->delete($id);

        Flash::success('Loan deleted successfully.');

        return redirect(route('loans.index'));
    }
}
