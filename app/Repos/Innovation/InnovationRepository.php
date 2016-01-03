<?php namespace Md\Repos\Innovation;


use Md\Category;
use Md\Innovation;
use Md\Progress;
use Md\User;
use Cmgmyr\Messenger\Models\Thread;

use Cmgmyr\Messenger\Models\Message;


class InnovationRepository
{
    /**
     * The innovation model
     * @var
     */
    private $innovation;

    /**
     * The user model
     * @var
     */
    private $user;

    /**
     * The category model
     * @var
     */
    private $category;



    /**
     * @param Innovation $innovationModel
     * @param User $userModel
     * @param Category $categoryModel
     */

    public function __construct(Innovation $innovationModel, User $userModel, Category $categoryModel)
    {
        $this->innovation = $innovationModel;

        $this->user = $userModel;

        $this->category = $categoryModel;
    }


    /**
     * Commit an innovation for the auth user to the database
     * @param $request
     */
    public function persist($request)
    {
        \Auth::user()->innovation()->create([

            'innovationTitle'       => $request->innovationTitle,
            'innovationShortDescription' => $request->innovationShortDescription,
            'innovationDescription' => $request->innovationDescription,
            'innovationFund'        => $request->innovationFund,
            'category_id'           => $request->innovationCategory,
            'justifyFund'           => $request->justifyFund,
            'tradeMarkName'         => $request->tradeMarkName,
            'tradeMarkNumber'       => $request->tradeMarkNumber

        ]);
    }

    /**
     * Updates an innovation
     *
     * @param Innovation $innovation
     * @param array $details
     * @return Innovation
     */
    public function update($request, $innovation_id)
    {
      $innovation = Innovation::findOrFail($innovation_id);

      $innovation->update([

          'innovationTitle'       => $request->innovationTitle,
          'innovationShortDescription' => $request->innovationShortDescription,
          'innovationDescription' => $request->innovationDescription,
          'innovationFund'        => $request->innovationFund,
          'category_id'           => $request->innovationCategory,
          'justifyFund'           => $request->justifyFund,
          'tradeMarkName'         => $request->tradeMarkName,
          'tradeMarkNumber'       => $request->tradeMarkNumber
      ]);


    }


    /**
     * Deletes a specified innovation
     *
     * @param Innovation $innovation
     * @throws \Exception
     */
    public function delete(Innovation $innovation)
    {
        $innovation->delete();
    }


    /**
     * Retrieves a specific innovation
     *
     * @param $id
     */
    public function retrieve($id)
    {
        return $this->innovation->where('id', '=', $id)->with('user', 'category')->first();
    }


    /**
     * Retrieves all of a specific user's innovations
     *
     * @param User $user
     * @return mixed
     */
    public function innovationsForUser(User $user)
    {
        return $innovations = $user->innovation()
            ->where('fundingStatus', '=', 0 )
            ->with('category', 'thread')
            ->latest()
            ->paginate(9,['*'], 'innovations');
    }


    /**
     * Returns the user who the innovation belongs to.
     *
     * @param Innovation $innovation
     * @return mixed
     */
    public function userForInnovation(Innovation $innovation)
    {
        return $innovation->user()->first();
    }


    /**
     * Returns all the innovations with the order latest to oldest
     *
     */
    public function allInnovations()
    {
        Innovation::where('fundingStatus', '=', 0)
            ->latest()
            ->get();
    }

    /**
     * Searches all innovations by their names.
     *
     * @param $query
     * @return mixed
     */
    public function searchAll($query)
    {
        return Innovation::where('name', 'LIKE', "%$query%")
            ->latest()
            ->get();
    }

    /**
     * Returns filtered results of a certain group.
     *
     * @param Category $category
     * @return mixed
     */
    public function innovationOfCategory(Category $category)
    {
        return Innovation::where('category', $category->id)
            ->latest()
            ->get();
    }
    /**
     * determines the format of searched innovations
     * @return mixed
     */
    public function getAll()
    {
        return Innovation::where('fundingStatus', '=', 0)
            ->latest()
            ->paginate(9,['*'], 'innovations');
    }

    public function getAllOPen()
    {
        return Innovation::where('fundingStatus', '=', 0);

    }

    public function getAllPartials()
    {
        return Innovation::where('fundingStatus', '=', 1)
                           ->where('innovationFund', '>=', 1);

    }

    public function getAllFullyFunded()
    {
        return Innovation::where('fundingStatus', '=', 1)
                            ->where('innovationFund', '<=', 0);

    }

    /**
     * determines the format of searched innovations
     * @return mixed
     */
    public function getAllInnovations()
    {
        return Innovation::latest()
            ->paginate(9);
    }

    /**
     * determines the format of searched innovations
     * @return mixed
     */
    public function getAllFunded()
    {
        return Innovation::where('fundingStatus', '=', 1)
            ->with('category', 'fund')
            ->latest()
            ->paginate(4);
    }


    /*public function fundInnovation($id)
    {
        $innovation = Innovation::findOrFail($id);


        $fund = $innovation->fund()
            ->create([
                'innovator_id' => $innovation->user_id,
                'investor_id'  => \Auth::user()->id,
                'name'  => \Auth::user()->first_name." ".\Auth::user()->last_name,
                'amount' => $innovation->innovationFund
            ]);

        $innovation->update([

            'fundingStatus' => 1,
            'innovationFund' => ($innovation->innovationFund)-($fund->amount)

        ]);


        \Auth::user()->update([

            'investor_amount' => (\Auth::user()->investor_amount) - ($fund->amount)

        ]);
    }*/

    public function fundInnovationPartial($id, $request)
    {
        $innovation = Innovation::findOrFail($id);



        $innovation->fund()
            ->create([
                'innovator_id' => $innovation->user_id,
                'investor_id'  => \Auth::user()->id,
                'name'  => \Auth::user()->first_name." ".\Auth::user()->last_name,
                'amount' => $request->partialFund
            ]);

        $innovation->update([

            'fundingStatus' => 1,
            'innovationFund' => ($innovation->innovationFund)-($request->partialFund)

        ]);

        if($request->partialFund >= $innovation->innovationFund )
        {
            Progress::where('innovation_id', '=', $innovation->id)
                ->first()
                ->update([

                    'progress_status' => 0

                ]);
        }

        \Auth::user()->update([

            'investor_amount' => (\Auth::user()->investor_amount) - ($request->partialFund)

        ]);
    }


    public function getFunded()
    {
        return $this->innovation
            ->where('user_id', '=', \Auth::user()->id)
            ->where('fundingStatus', '=', 1)
            ->with('category', 'fund')
            ->latest()
            ->paginate(3);
    }

    public function getPortfolio($id)
    {
        $innovation = Innovation::findOrFail($id);

        return $innovation->fund->where('innovation_id', '=', $id)->get();
    }

    public function countInvestorFunded()
    {
        return \Md\Fund::where('investor_id', '=', \Auth::user()->id)->distinct('innovation_id')->count('innovation_id');


    }

    public function getInvestorFunded()
    {
        return \Md\Fund::where('investor_id', '=', \Auth::user()->id)
            ->with('innovation','innovation.user', 'innovation.category')
            ->groupBy('innovation_id')
            ->latest()
            ->paginate(3,['*'], 'investor');

    }

    public function getTotalInjected()
    {
        return \Md\Fund::where('investor_id', '=', \Auth::user()->id)->sum('amount');

    }

    public function onProgress()
    {
        return Progress::where('investor_id', '=', \Auth::user()->id)
                        ->where('progress_status', '=', 1)
                        ->count();
    }

    public function getOnProgress()
    {
        return Progress::where('investor_id', '=', \Auth::user()->id)
            ->where('progress_status', '=', 1)
            ->with('innovation.category', 'innovation.user')
            ->latest()
            ->paginate(9);

    }

    public function getCategory($category)
    {
        return Innovation::where('category_id', '=', $category)
            ->where('fundingStatus', '=', 0)
            ->latest()
            ->paginate(9);
    }

    public function getInnovationFund($id)
    {
       return Innovation::where('id', $id)->first()->innovationFund;
    }

    public function getInnovationName($id)
    {
        return Innovation::where('id', $id)->first()->innovationTitle;
    }

}