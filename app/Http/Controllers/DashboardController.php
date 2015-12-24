<?php

namespace Md\Http\Controllers;

use Md\Repos\Innovation\InnovationRepository;
use Md\Repos\Category\CategoryRepository;
use Md\Http\Requests;
use Illuminate\Support\Facades\Session;



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
     * Initializer constructor for this controller class
     * @param InnovationRepository $innovationRepository
     * @param CategoryRepository $categoryRepository
     */
    function __construct(InnovationRepository $innovationRepository, CategoryRepository $categoryRepository)
    {
        $this->innovationRepository = $innovationRepository;

        $this->categoryRepository = $categoryRepository;
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
     * @return \Illuminate\View\View
     */

    public function investor()
    {
        if(\Auth::user()->isInvestor() && \Auth::user()->investor_finance == 0)
        {
            Session::flash('flash_message', 'You have to add your financial details first before continuing');
            return view('account.investor_finance');
        }

        $innovations = $this->innovationRepository->getAll();

        $categories = $this->categoryRepository->getAllCategories();

        $fundedProjects = $this->innovationRepository->getInvestorFunded();

        $fundedProjectsCount = $this->innovationRepository->countInvestorFunded();

        $onProgress =$this->innovationRepository->onProgress();

        $totalFundsInjected = $this->innovationRepository->getTotalInjected();

        return view('home.investor',  compact('onProgress','innovations', 'categories', 'fundedProjects', 'fundedProjectsCount', 'totalFundsInjected'));
    }


    public function bongoEmployee()
    {
        $innovations = $this->innovationRepository->getAllInnovations();

        $categories = $this->categoryRepository->getAllCategories();

        return view('admin.bongo', compact('innovations', 'categories'));
    }

    public function bongoMother()
    {
        $innovations = $this->innovationRepository->getAllInnovations();

        $categories = $this->categoryRepository->getAllCategories();

        return view('admin.mother', compact('innovations', 'categories'));
    }

    public function viewInnovation()
    {
        return view('partials.dashboards.more-innovation-info');
    }

    public function about()
    {
        return view('pages.about');
    }
}
