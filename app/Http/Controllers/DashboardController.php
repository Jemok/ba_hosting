<?php

namespace Md\Http\Controllers;

use Md\Repos\Innovation\InnovationRepository;
use Md\Repos\Category\CategoryRepository;
use Md\Http\Requests;



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
        $innovations = $this->innovationRepository->getAll();

        $categories = $this->categoryRepository->getAllCategories();

        $fundedProjects = $this->innovationRepository->getInvestorFunded();

        return view('home.investor',  compact('innovations', 'categories', 'fundedProjects'));
    }


    public function bongoEmployee()
    {
        return view('admin.bongo');
    }

    public function bongoMother()
    {
        $innovations = $this->innovationRepository->getAll();


        return view('admin.mother', compact('innovations'));
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
