<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DashboardService as Dashboard;
use Exception;
use App\Services\ContactService as Contact;
use App\Repositories\Comments\CommentRepositoryInterface as Comment;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // declare variable DashboardService
    protected $dashboard;
    protected $contact;
    protected $comment;

    // inject DashboardService in construct
    public function __construct(Dashboard $dashboard, Contact $contact, Comment $comment)
    {
        $this->dashboard = $dashboard;
        $this->contact = $contact;
        $this->comment = $comment;
    }

    public function index()
    {
        try {
            $accessYear = $this->dashboard->accessYear();
            $commentNonAccept = $this->comment->getCommentNonAccept(5);
            $contactNotActive = $this->contact->geContactNotActive();
            $topBookByRate = $this->dashboard->getTopBookByRate();
            $topBookViews = $this->dashboard->getTopBookByView();
            $totalCategory = $this->dashboard->totalCategory();
            $totalContact = $this->contact->getContacts()->count();
            $totalBook = $this->dashboard->totalBook();
            $totalUser = $this->dashboard->totalUser();
            $topBooks = $this->dashboard->getTopBookFollow();
            $chart = $this->dashboard->getReportHits();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.dashboard.dashboard', with([
                'chart' => $chart,
                'topBooks' => $topBooks, 'totalUser' => $totalUser, 'totalBook' => $totalBook,
                'totalContact' => $totalContact, 'totalCategory' => $totalCategory,
                'topBookViews' => $topBookViews,
                'topBookByRate' => $topBookByRate,
                'contactNotActive' => $contactNotActive, 'commentNonAccept' => $commentNonAccept,
                'accessYear' => $accessYear,
            ]));
    }
}
