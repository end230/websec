<div class="card m-4">
    <div class="card-body">
    <form action="{{route('cryptography')}}" method="get">
    {{ csrf_field() }}
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
   </div>
   <div class="card m-4"><div class="card-body"><strong>Result Status:</strong>
   {{$status}}</div></div>