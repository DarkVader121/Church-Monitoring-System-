<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Stats extends Model
{
	public function totalUsers()
	{
		return User::count(); 
	}	
	public function totalPendingProjects()
	{
		return Project::where('status', 'Pending')->count(); 
	}	
	public function totalApprovedProjects()
	{
		return Project::where('status', 'Approved')->count(); 
	}	
	public function totalCanceledProjects()
	{
		return Project::where('status', 'Cancelled')->count(); 
	}	

	public function totalProjects()
	{
		return Project::count(); 
	}

	public function totalPendingEvents()
	{
		return Event::where('status', 'Pending')->count(); 
	}
	public function totalApprovedEvents()
	{
		return Event::where('status', 'Approved')->count(); 
	}
	public function totalCancelledEvents()
	{
		return Event::where('status', 'Cancelled')->count(); 
	}
	public function totalEvents()
	{
		return Event::count(); 
	}

	public function totalDonations()
	{
		return Donation::whereNull('archive')->sum('amount');
	}

	public function totalArchivedDonations()
	{
		return Donation::whereNotNull('archive')->sum('amount');
	}

	

	public function totalNumberDonations()
	{
		return Donation::whereNull('archive')->count(); 
	}



	public function totalMeetings()
	{
		return Meeting::count(); 
	}

	public function totalExpenses()
	{
		return Expense::whereNull('archive')->sum('amount');
	}

	public function totalArchiveExpenses()
	{
		return Expense::whereNotNull('archive')->sum('amount');
	}

}