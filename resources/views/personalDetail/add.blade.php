<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            body {
                text-align: center;
            }
            form {
                display: inline-block;
            }
        </style>
    </head>

    <body style="background-color:#9fa3ab">
        <div class="container-fluid">
            
            <form method="POST" action="{{ route('personal-detail.store') }}">
                @csrf
                <div class="form-group">
                    <label for="fname">FName:</label>
                    <input type="text" name="fname" class="form-control" id="fname">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
            
                <div class="checkbox">
                    <label><input type="checkbox" name="options[]" value="op1">Option 1</label>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="options[]" value="op2">Option 2</label>
                </div>

                <div class="checkbox disabled">
                    <label><input type="checkbox" name="options[]" value="op3" disabled>Option 3</label>
                </div>

                <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="optradio" value="optradio_1">Option 1</label>
                    <label class="radio-inline"><input type="radio" name="optradio" value="optradio_2">Option 2</label>
                    <label class="radio-inline"><input type="radio" name="optradio" value="optradio_3">Option 3</label>
                </div>

                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select class="form-control" id="sel1" name="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel1">Select State:</label>
                    <select class="form-control" id="state" name="state">
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel1">Select City:</label>
                    <select class="form-control" id="city" name="city">
                        <option value="">Select City</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="usr">Date:</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                
                <button type="submit" class="btn btn-primary">Button</button>
            </form>

        </div>
    </body>

    <script>

        $('#state').change(function() {
            var state_id = $('#state').val();
            $.ajax({
                url:"{{ route('get-city') }}",
                type:"POST",
                data:{'_token' : "{{ csrf_token() }}",  'state_id' : state_id},
                success(data) {
                    console.log(data.city);
                    if(data.city.length != 0) {
                        $('#city').empty();
                        $.each(data.city, function(key, value) {
                            $('#city').append(
                                '<option value = '+value.id+'>'+value.city+'</option>'
                            );
                        })
                    } else {
                        $('#city').append('<option value=""> No Data </option>');
                    }
                }
            });
        })
    </Script>
</html>