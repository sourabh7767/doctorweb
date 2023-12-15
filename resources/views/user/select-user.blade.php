
        @foreach ($users as $user)
        <option value="{{$user->id}}" data-id="{{$priscription->id}}" class="prescription">{{$user->name}}{{$user->email}}</option>
        @endforeach
