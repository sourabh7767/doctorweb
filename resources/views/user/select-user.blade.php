{{-- <div class="">
	<strong>Select Language:</strong>
    <select id="multiple-checkboxes" multiple="multiple"> --}}
        @foreach ($users as $user)
        <option value="{{$user->id}}" data-id="{{$priscription->id}}" class="prescription">{{$user->name}}{{$user->email}}</option>
        @endforeach
