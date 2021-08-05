@extends('layout.app')

@section('content')
    <div class="row">

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
                                    <option value="{{$result->lga_id}}">{{$result->lga_name}}</option>
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
            <table class="table table-striped" id="polling_data">
                

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
                        url: "lga-pulling-result",
                        type: "GET", //send it through get method
                        data: { 
                           lga : selector
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $("#polling_data").empty();
                                console.log(response)

                                if(response[0].summed_total === null)
                                {
                                    $("#polling_data").append("<tr class='delete'>" + "<td >" + "No result for this Local government" + "</td>" + "</tr>");
                                }
                                else
                                {
                                    
                                    $("#polling_data").append(
                                        "<tr>" + "<td>" + "Result Total" + "</td>" + "<td>" + response[0].summed_total + "</td>" + "</tr>");
                        
                                    const title = $("#select_pulling option:selected" ).text();
                                    $("#polling_title" ).html(title);

                                }

                               
                            }
                            else{
                                $("#polling_data").append("<tr class='delete'>" + "<td >" + "No result for this Local government" + "</td>" + "</tr>");
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