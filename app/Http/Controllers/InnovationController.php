<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
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

    public function editInnovation($innovation_id)
    {
        $innovation = $this->repo->retrieve($innovation_id);

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.edit', compact('innovation', 'categories'));

    }

    public function updateInnovation(InnovationsRequest $request, $innovation_id)
    {
        $this->repo->update($request, $innovation_id);

        Session::flash('flash_message', 'Awesome!! Your Innovation was updated successfully!');

        return redirect()->back();

    }

    public function open()
    {
        $innovations = $this->repo->getAll();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.open', compact('innovations', 'categories'));
    }

    public function investorFunded()
    {
        $fundedProjects =$this->repo->getInvestorFunded();

        $categories = $this->categoryRepository->getAllCategories();


        return view('innovation.funded_investor', compact('fundedProjects', 'categories'));

    }

    public function funded()
    {
        $innovations = $this->repo->getAllFunded();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.all_funded', compact('innovations', 'categories'));
    }

    /**
     * @param $id
     * @param ConversationRepository $conversationRepository
     * @return \Illuminate\View\View
     */
    public function show($id, ConversationRepository $conversationRepository)
    {
        $innovation = $this->repo->retrieve($id);

        $check_chat = $conversationRepository->chatExists($id);

       

        //$conversation = $conversationRepository->startConversation();

        $currentUserId = Auth::user()->id;

        $chatWithInnovator = $conversationRepository->checkChatWithInnovator($id);

        $mother = User::where('id', '=', 1)->first();

        $users = User::where('userCategory', '=', 3)->get();

        $investors = User::where('userCategory', '=', 2)->get();



        // All threads that user is participating in
        //$threads = Thread::forUser($currentUserId)->get();

        $threads = Thread::forUser($currentUserId)
            ->where('innovation_id', '=', $id)
            ->latest()->get();

        $threads_count = $threads->count();

        return view('innovation.show', compact('investors','mother','users','chatWithInnovator','innovation', 'id', 'check_chat', 'message', 'threads', 'threads_count', 'currentUserId'));
    }


    /**
     * Save a new innovation post
     */
    public function store(InnovationsRequest $innovationsRequest)
    {
        $this->repo->persist($innovationsRequest);

        Session::flash('flash_message', 'Awesome!! Your Innovation was submitted successfully!');

        return back();
    }

    /**
     *
     */
    public function fund($id)
    {
        $this->repo->fundInnovation($id);

        return redirect('innovation/'.$id);

    }

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

    public function getPortfolio($id)
    {
        $funds= $this->repo->getPortfolio($id);

        $totalNeeded = $this->repo->getInnovationFund($id);

        $innovationTitle = $this->repo->getInnovationName($id);


        return view('portfolio.portfolio', compact('innovationTitle','totalNeeded','funds', 'id'));

    }

    public function getCategory($category)
    {
       $innovations = $this->repo->getCategory($category);

       $categoryName = Category::where('id', '=', $category)->first()->categoryName;

        return view('innovation.category', compact('categoryName','innovations'));
    }

    public function getOnProgress()
    {
        $onProgress = $this->repo->getOnProgress();

        $categories = $this->categoryRepository->getAllCategories();

        return view('innovation.progress', compact('categories','onProgress'));
    }
}
