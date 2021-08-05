@extends('layout.app')

@section('content')
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    
                    <form action="{{url('/add-result')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="LGA">LGA</label>
                            <select class="form-control" name="lga" id="lga">
                                <option value="">Choose LGA</option>
                                @foreach ($results as $result)
                                    <option value="{{$result->lga_id}}">{{$result->lga_name}}</option>
                                @endforeach
                            </select>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="Ward">Ward</label>
                            <select class="form-control" name="ward" id="ward">
                                <option value="">Choose Ward</option>
                            </select>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="pullingUnit">Pulling Unit</label>
                            <input type="text" class="form-control" id="pullingUnit" placeholder="enter pulling unit">
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="Ward">party</label>
                            <select class="form-control" name="party" id="party">
                                <option value="">Choose Ward</option>
                            </select>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="pullingUnit">Party Scores</label>
                            <input type="text" class="form-control" id="score" placeholder="enter Party Scores">
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label for="pullingUnit">Entered by</label>
                            <input type="text" class="form-control" id="enter_by" placeholder="enter Party Scores">
                            <span class="error"></span>
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

    });
</script>