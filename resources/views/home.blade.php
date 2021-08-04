@extends('layout.app')

@section('content')
    <div class="row">
        {{-- <div class="col-sm-8 col-sm-offset-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Polling Unit</th>
                      <th scope="col">Number</th>
                      <th scope="col">Party</th>
                      <th scope="col">Score</th>
                      <th scope="col">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($results as $key => $result)
                        
                            
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{$result->polling_unit_name}}</td>
                                <td>{{$result->polling_unit_number}}</td>
                                <td>
                                    <table border="1">
                                        @foreach ($result->pullingResults as $pulling_result)
                                        
                                            <tr>
                                                <td>{{$pulling_result->party_abbreviation}}</td>
                                                <td>{{$pulling_result->party_score}}</td>
                                                <td>{{$pulling_result->date_entered}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                
                                </td>
                        </tr>
                        
                    @endforeach
                    
                  </tbody>
            </table>
            
        </div> --}}
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <form action="#" id="pulling_result">
                        @csrf
                        <div class="form-group">
                            <select name="" id="select_pulling" class="form-control">
                                <option value="">Select Pulling</option>

                                @foreach ($results as $result)
                                    <option value="{{$result->uniqueid}}">{{$result->polling_unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h2><span id="polling_title"></span></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Party</th>
                      <th scope="col">Score</th>
                      <th scope="col">Date</th>
                    </tr>
                </thead>

                <tbody id="polling_data"></tbody>

            </table>
        </div>
    </div>
@endsection

{{-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $("#select_pulling" ).change(function() {
            const selector = $(this).val();

            
            $.ajax({
                        url: "pulling",
                        type: "GET", //send it through get method
                        data: { 
                           pullingID : selector
                        },
                        success: function(response) {
                           
                            $("#polling_data").empty();

                            response.forEach(function(response, i){
                                
                                $("#polling_data").append(
                                    "<tr>" + "<td>" + ` ${i+1} ` + "</td>" + "<td>" + response.party_abbreviation + "</td>" + "<td>" + response.party_score + "</td>" + "<td>" + response.date_entered + "</td>" + "</tr>");
                            })
                            const title = $("#select_pulling option:selected" ).text();
                            $("#polling_title" ).html(title);

                            if (response.length === 0) {
                                $("#polling_data").append("<tr class='delete'>" + "<td colspan='4'>" + "No result for this pulling unit" + "</td>" + "</tr>");
                            }
                            else{
                                $(".delete").hide()
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