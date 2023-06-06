<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title></title>
</head>
<body>
<table class="table-bordered table-sm " width="100%" align="center" style="background: #154360; color: #fff;">
          <tbody>
            <tr> 
              <td>
                  <p class="text-center">
                    <small>
                            <strong>
                             Holy Rosary Parish Lila, Bohol <br> 
                            </strong>

                            @php 
								$startdate = request('from');
								$enddate = request('to');
                            @endphp
                            Date Range :  <strong>From:{{ Carbon\Carbon::parse($startdate)->toFormattedDateString() }}  To: {{ Carbon\Carbon::parse($enddate)->toFormattedDateString() }} </strong>
                      </small>
                  </p>
              </td>
            </tr>
          </tbody>
        </table> 
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Donation ID</th>
				<th>Linked Project</th>
				<th>Donor Name</th>
				<th>Date</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			@php
				$totalDonation = 0;
			@endphp	
			@foreach ($donations as $donation)
			<tr>
				<td>{{ $donation->id}}</td>
				<td>{{ $donation->project ? $donation->project->project_name : '' }}</td>
				
				<td>{{ $donation->donor_name }}</td>
				<td>{{ date('M d Y', strtotime($donation->date)) }}</td>
				<td>₱ {{ number_format($donation->amount, 0, '.', ',') }}</td>
			</tr>
			@php
			$totalDonation += $donation->amount;
			@endphp
			@endforeach
		</tbody>
		<tr>
			<td colspan="4"></td>
			 <td>Total : ₱ {{ number_format($totalDonation, 0, '.', ',') }}</td>
		</tr>
	</table>
 	

</body>
</html>