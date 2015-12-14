<?php namespace Md\Repos\Innovation;


use Md\Category;
use Md\Innovation;
use Md\User;


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
    public function update(Innovation $innovation, Array $details)
    {
        $innovation->update($details);
        return $innovation;
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
        return $user->innovation()
            ->where('fundingStatus', '=', 0 )
            ->with('category', 'thread')->latest()->get();
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
            ->get();
    }

    /**
     * Set an innovation as being funded
     * @param $id
     */
    public function fundInnovation($id)
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
    }

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
    }


    public function getFunded()
    {
        return $this->innovation
            ->where('user_id', '=', \Auth::user()->id)
            ->where('fundingStatus', '=', 1)
            ->with('category', 'fund')
            ->latest()->get();
    }

    public function getPortfolio($id)
    {
        $innovation = Innovation::findOrFail($id);

        return $innovation->fund->where('innovation_id', '=', $id)->get();
    }

    public function getInvestorFunded()
    {
        return \Md\Fund::where('investor_id', '=', \Auth::user()->id)
            ->with('innovation','innovation.user', 'innovation.category')
            ->latest()
            ->get();
    }

}