@extends('layouts.authBase')

@section('title', 'Propositions')

@section('content')
		<div class="toolbox hidden-sm-down hidden-md-down">
        	<div id="chart"></div>
        </div>
        
        <div class="container-fluid toolbox-margin large">
	        <div class="card card-block proposition yellow">
                    <p class="card-text">{{ $proposition['propositionSort'] }}</p>
                    @if ($votes['userHasVoted'] == false)
					<a href="{{ route('upvote', $proposition['propositionId']) }}" class="card-link"><i class="fa fa-angle-up"></i> Upvote</a>
					<a href="{{ route('downvote', $proposition['propositionId']) }}" class="card-link"><i class="fa fa-angle-down"></i> Downvote</a>
					@else
					<a href="#" class="card-link">You have already voted for this proposition</a>
					@endif
                    
                    
                    <div class="extension" id="extension" style="display:none;">
                        <p>{{ $proposition['propositionLong'] }}</p>
                    </div>
                    <a href="#" class="extend-btn" id="extend"><i class="fa fa-angle-down"></i></a>
                </div>
                
                <div class="proposition-info">
                    <p class="text-success">{{$votes['upvotes']}} <i class="fa fa-angle-up"></i> Upvotes</p>
                    <p class="text-danger">{{$votes['downvotes']}} <i class="fa fa-angle-down"></i> Upvotes</p>
                    <p class="text-default">10 Comments</p>
                </div>
                
                <div class="comments">
                	<div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                    <div class="comment">
                    	<img src="https://s.gravatar.com/avatar/41a24f51bc5ae7b7f2ab38b650913073?s=60&amp;d=mm" class="profile-picture">
                        <h2>Photis Avrilionis</h2>
                        <p class="time">01/12/2015 13:02</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam egestas bibendum justo et interdum. Donec leo justo, elementum sit amet est eu, condimentum facilisis dolor.</p>
                    </div>
                </div>
        </div>
@stop
        
@section('footer_scripts')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <script>
	$(document).ready(function(e) {
        
		$("#extend").click( function(e) {
			
			if ($(this).children("i").hasClass('fa-angle-down')) {
				$(this).children("i").removeClass("fa-angle-down");
				$(this).children("i").addClass('fa-angle-up');
			} else {
				$(this).children("i").removeClass("fa-angle-up");
				$(this).children("i").addClass('fa-angle-down');
			}
			
			$( "#extension" ).toggle( "blind" );
		});
		
    });
	</script>
    
    <script>
	google.load('visualization', '1', {packages: ['corechart', 'line']});
	google.setOnLoadCallback(drawBasic);

	function drawBasic() {

		  var data = new google.visualization.DataTable();
		  data.addColumn('date', 'Week');
		  data.addColumn('number', 'Upvotes');
		  data.addColumn('number', 'Downvotes');
	
		  data.addRows([
			[new Date('2015', '10', '1'),	0,	0],
			[new Date('2015', '10', '7'), 	5, 12],
			[new Date('2015', '10', '14'), 	13, 14],
			[new Date('2015', '10', '21'), 	17, 17],
			[new Date('2015', '10', '28'), 	28,	19],
			[new Date('2015', '11', '5'), 	29,	19],
			[new Date('2015', '11', '12'), 	31,	21],
			[new Date('2015', '11', '19'), 	37,	26],
			[new Date('2015', '11', '26'), 	43,	34],
			[new Date('2015', '12', '2'), 	50,	35],
			[new Date('2015', '12', '9'), 	52,	35],
			[new Date('2015', '12', '19'), 	55,	37],
			[new Date('2015', '12', '26'), 	55,	38],
			[new Date('2016', '1', '3'), 	55,	40]
		  ]);
	
		  var options = {
			hAxis: {
			  title: 'Week'
			},
			chartArea: {
				backgroundColor: '#fff',
			},
			width: '100%',
			fontName: 'Lato',
			'legend': 'none',
			colors: ['#5cb85c', '#d9534f']
		  };
	
		  var chart = new google.visualization.AreaChart(document.getElementById('chart'));
		  chart.draw(data, options);
    }
	</script>
@stop