@extends('layout.app')

@section('content')
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    
                    @if (session('status'))
                        <div class="alert {{ session('color') }}">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <form action="{{url('/add-result')}}" method="POST" id="add_result">
                        @csrf

                        <div class="form-group">
                            <label for="LGA">LGA</label>
                            <select class="form-control" name="lga" id="lga">
                                <option value="">Choose LGA</option>
                                @foreach ($results as $result)
                                    <option value="{{$result->lga_id}}">{{$result->lga_name}}</option>
                                @endforeach
                            </select>
                            @error('lga')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="Ward">Ward</label>
                            <select class="form-control" name="ward" id="ward">
                                <option value="">Choose Ward</option>
                            </select>
                            @error('ward')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pullingUnit">Pulling Unit</label>
                            <input type="text" class="form-control" id="pullingUnit" name="pullingUnit" placeholder="enter pulling unit" value="{{ old('pullingUnit') }}" >
                            @error('pullingUnit')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Party">Party</label>
                            <select class="form-control" name="party" id="party">
                                <option value="">Choose Ward</option>
                                @foreach ($parties as $party)
                                    <option value="{{$party->partyid}}">{{$party->partyname}}</option>
                                @endforeach
                            </select>
                            @error('party')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="score">Party Scores</label>
                            <input type="text" class="form-control" name="score" id="score" placeholder="enter Party Scores" value="{{ old('score') }}">
                            @error('score')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="enter_by">Entered by</label>
                            <input type="text" class="form-control" id="enter_by" name="scoreBy" placeholder="...Score by" value="{{ old('scoreBy') }}">
                            @error('scoreBy')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h2><span id="polling_title"></span></h2>
            <table class="table table-striped" id="polling_data">
                

            </table>
        </div>
    </div>
@endsection

{{-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $("#lga" ).change(function() {
            const selector = $(this).val();
            
            $.ajax({
                        url: "get-ward",
                        type: "GET", //send it through get method
                        data: { 
                           lga : selector
                        },
                        success: function(response) {
                            console.log(response)
                            // return
                            $("#ward").empty();

                            response.forEach(function(response, i){
                                
                                $("#ward").append(
                                    "<option value=" + response.ward_id + ">" + response.ward_name + "</option>");
                            })

                            if (response.length === 0) {
                                $("#ward").empty();
                            }
                            

                        },
                        error: function(xhr) {
                            //Do Something to handle error
                            console.log(xhr)
                        }
                    });


            
        });



        // For submiting form
        /* $("#add_result" ).submit(function() {
            const selector = $(this).val();
            
            $.ajax({
                        url: "add-result",
                        type: "POST", //send it through get method
                        data: { 
                           data : selector
                        },
                        success: function(response) {
                            console.log(response)                            
                            

                        },
                        error: function(xhr) {
                            //Do Something to handle error
                            console.log(xhr)
                        }
                    });


            
        }); */

    });
</script>