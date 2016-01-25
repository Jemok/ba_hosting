<?php

/**
 * Manages input and output flow of innovations
 */

namespace Md\Http\Controllers;


use Md\Http\Requests;
use Md\Repos\Innovation\InnovationRepository;
use Md\Http\Requests\InnovationsRequest;
use Illuminate\Support\Facades\Session;
use Md\Repos\Conversation\ConversationRepository;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Thread;
use Md\Repos\Category\CategoryRepository;
use Md\Http\Requests\PartialFundingRequest;
use Md\User;
use Md\Category;

class InnovationController extends Controller
{
    /**
     * This innovation repository
     * @var \Md\Repos\Innovation\InnovationRepository
     */
    private $repo;

    /**
     * @var \Md\Repos\Category\CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param InnovationRepository $innovationRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(InnovationRepository $innovationRepository, CategoryRepository $categoryRepository)
    {
        $this->repo = $innovationRepository;

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Method responsible for getting the edit innovation view
     * @param $innovation_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function editInnovation($innovation_id)
    {
        $innovation = $this->repo->retrieve($innovation_id);

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.edit', compact('innovation', 'categories'));
    }

    /**
     * Updates a specific innovation
     * @param InnovationsRequest $request
     * @param $innovation_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInnovation(InnovationsRequest $request, $innovation_id)
    {
        $this->repo->update($request, $innovation_id);

        Session::flash('flash_message', 'Awesome!! Your Innovation was updated successfully!');

        return redirect()->back();

    }

    /**
     * Gets all open innovations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function open()
    {
        $innovations = $this->repo->getAll();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.open', compact('innovations', 'categories'));
    }

    /**
     * Gets all innovations funded by a specific investor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function investorFunded()
    {
        $fundedProjects =$this->repo->getInvestorFunded();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.funded_investor', compact('fundedProjects', 'categories'));

    }

    /**
     * Gets all funded innovations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function funded()
    {
        $innovations = $this->repo->getAllFunded();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.all_funded', compact('innovations', 'categories'));
    }

    /**
     * Retrieves a specific innovation with its related data
     * @param $id
     * @param ConversationRepository $conversationRepository
     * @return \Illuminate\View\View
     */
    public function show($id, ConversationRepository $conversationRepository)
    {

        $innovation = $this->repo->retrieve($id);


        $check_chat = $conversationRepository->chatExists($id);

        $currentUserId = Auth::user()->id;

        $chatWithInnovator = $conversationRepository->checkChatWithInnovator($id);

        $mother = User::where('id', '=', $innovation->moderator_id)->first();

        $users = User::where('userCategory', '=', 3)->get();

        $investors = User::where('userCategory', '=', 2)->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->where('innovation_id', '=', $id)->get();

        $threads_count = $threads->count();

        if(\Auth::user()->isInvestor())
        {
            if((Thread::where('innovation_id', '=', $id)
                    ->where('user_id', '=', \Auth::user()->id)
                    ->exists()) == true)
            {
                $thread =Thread::where('innovation_id', '=', $id)
                    ->where('user_id', '=', \Auth::user()->id)->first();
            }

        }

        if(\Auth::user()->isMother())
        {
            if((Thread::where('innovation_id', '=', $id)
                    ->where('user_id', '=', \Auth::user()->id)
                    ->exists()) == true)
            {
                $thread_mother =Thread::where('innovation_id', '=', $id)
                    ->where('user_id', '=', \Auth::user()->id)->first();
            }
            else
            {
                $thread_mother = null;
            }
        }

        $funds= $this->repo->getPortfolio($id);

        $totalNeeded = $this->repo->getInnovationFund($id);

        return view('innovation.show', compact('totalNeeded','funds','thread_mother','thread','investors','mother','users','chatWithInnovator','innovation', 'id', 'check_chat', 'message', 'threads', 'threads_count', 'currentUserId'));
    }

    /**
     * Saves a new innovation post
     * @param InnovationsRequest $innovationsRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InnovationsRequest $innovationsRequest)
    {
        $this->repo->persist($innovationsRequest);

        Session::flash('flash_message', 'Awesome!! Your Innovation was submitted successfully!');

        return back();
    }

    /**
     * Triggers the innovation funding process
     * @param $id
     * @param PartialFundingRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function fundPartial($id, PartialFundingRequest $request)
    {
        $innovationFund = $this->repo->getInnovationFund($id);

        $partialFund = $request->partialFund;

        if($partialFund > $innovationFund)
        {
            $error[] = ['partialFund' => 'Not allowed, amount exceeds needed amount'];

            return redirect()->back()->withErrors($error);
        }

        $this->repo->fundInnovationPartial($id, $request);

        return redirect('innovation/'.$id);
    }

    /**
     * Retrieves the portfolio of an innovation
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPortfolio($id)
    {
        $funds= $this->repo->getPortfolio($id);

        $totalNeeded = $this->repo->getInnovationFund($id);

        $innovationTitle = $this->repo->getInnovationName($id);

        return view('portfolio.portfolio', compact('innovationTitle','totalNeeded','funds', 'id'));

    }

    /**
     * Gets all the innovations in a particular category
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory($category)
    {
       $innovations = $this->repo->getCategory($category);

       $categoryName = Category::where('id', '=', $category)->first()->categoryName;

        return view('innovation.category', compact('categoryName','innovations'));
    }

    /**
     * Gets an investor's ongoing innovations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOnProgress()
    {
        $onProgress = $this->repo->getOnProgress();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.progress', compact('categories','onProgress'));
    }
}
