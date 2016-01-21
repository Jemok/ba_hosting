<?php

/**
 * The controller that handles expert, mother, investor and innovator dashboards
 */

namespace Md\Http\Controllers;

use Md\Repos\Innovation\InnovationRepository;
use Md\Repos\Category\CategoryRepository;
use Md\Http\Requests;
use Md\Repos\InvestorRequest\InvestorRequestRepo;
use Md\Repos\BongoRequest\BongoRequestRepo;


class DashboardController extends Controller
{
    /**
     * This innovation repository
     * @var \Md\Repos\Innovation\InnovationRepository
     */
    private $innovationRepository;

    /**
     * This category repository
     * @var \Md\Repos\Category\CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var \Md\Repos\InvestorRequest\InvestorRequestRepo
     */
    private $investorRequest;

    /**
     * @var \Md\Repos\BongoRequest\BongoRequestRepo
     */
    private $expertRequest;


    /**
     * @param BongoRequestRepo $bongoRequestRepo
     * @param InnovationRepository $innovationRepository
     * @param InvestorRequestRepo $investorRequestRepo
     * @param CategoryRepository $categoryRepository
     */
    function __construct(BongoRequestRepo $bongoRequestRepo, InnovationRepository $innovationRepository, InvestorRequestRepo $investorRequestRepo, CategoryRepository $categoryRepository)
    {
        $this->innovationRepository = $innovationRepository;

        $this->categoryRepository = $categoryRepository;

        $this->investorRequest = $investorRequestRepo;

        $this->expertRequest = $bongoRequestRepo;
    }

    /**
     * Selects what page the user sees as their homepage.
     *
     * @return Response
     */

    public function home()
    {
        if(\Auth::user()->isInvestor()){
            return $this->investor();
        }elseif(\Auth::user()->isInnovator())
        {
            return $this->innovator();
        }
        elseif(\Auth::user()->isAdmin())
        {
            return $this->bongoEmployee();
        }

        elseif(\Auth::user()->isMother())
        {
            return $this->bongoMother();
        }

    }

    /**
     * Display the innovator dashboard for innovators.
     *
     * @return Response
     */
    public function innovator()
    {
        $innovations = $this->innovationRepository->innovationsForUser(\Auth::user());

        $categories = $this->categoryRepository->getAllCategories();

        $fundedProjects = $this->innovationRepository->getFunded();

        return view('home.innovator', compact('innovations', 'categories', 'fundedProjects'));
    }

    /**
     * Displays the investors dashboard
     * @return \Illuminate\View\View
     */

    public function investor()
    {
        if(\Auth::user()->isInvestor() && \Auth::user()->investor_finance == 0)
        {
            return view('account.investor_finance');
        }
        $innovations_open = $this->innovationRepository->getAllOPen();

        $innovations_fully = $this->innovationRepository->getAllFullyFunded();

        $innovations_partial = $this->innovationRepository->getAllPartials();

        $innovations = $this->innovationRepository->getAll();

        $categories = $this->categoryRepository->getAllCategories();

        $fundedProjects = $this->innovationRepository->getInvestorFunded();

        $fundedProjectsCount = $this->innovationRepository->countInvestorFunded();

        $onProgress =$this->innovationRepository->onProgress();

        $totalFundsInjected = $this->innovationRepository->getTotalInjected();

        return view('home.investor',  compact('innovations_fully','innovations_partial','innovations_open','onProgress','innovations', 'categories', 'fundedProjects', 'fundedProjectsCount', 'totalFundsInjected'));
    }


    /**
     * Displays the Expert dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bongoEmployee()
    {
        $innovations = $this->innovationRepository->getAllInnovations();

        $categories = $this->categoryRepository->getAllCategories();

        $innovations_open = $this->innovationRepository->getAllOPen();

        $innovations_partial = $this->innovationRepository->getAllPartials();

        $innovations_fully = $this->innovationRepository->getAllFullyFunded();

        return view('admin.bongo', compact('innovations_fully','innovations_partial','innovations_open','innovations', 'categories'));
    }

    /**
     * Displays the Bongo Afrika mother dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bongoMother()
    {
        $innovations = $this->innovationRepository->getAllInnovations();

        $innovations_open = $this->innovationRepository->getAllOPen();

        $innovations_partial = $this->innovationRepository->getAllPartials();

        $innovations_fully = $this->innovationRepository->getAllFullyFunded();

        $investor_requests = $this->investorRequest->getThem();

        $expert_requests = $this->expertRequest->getThem();

        $categories = $this->categoryRepository->getAllCategories();

        return view('admin.mother', compact('innovations_fully','innovations_partial','innovations_open','expert_requests','investor_requests','innovations', 'categories'));
    }

    public function viewInnovation()
    {
        return view('partials.dashboards.more-innovation-info');
    }

    /**
     * Displays the about page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('pages.about');
    }

}
