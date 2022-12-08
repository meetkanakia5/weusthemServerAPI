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
            
            <form method="POST" action="{{ route('personal-detail.update', $detail->id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="fname">FName:</label>
                    <input type="text" name="fname" class="form-control" id="fname" value="{{ $detail->fname }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ $detail->email }}">
                </div>
            
                <div class="checkbox">
                    <label><input type="checkbox" name="options[]" value="op1" @if(!empty($options[0]->option) && ($options[0]->option == 'op1')) checked @else @endif>Option 1</label>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="options[]" value="op2" @if(!empty($options[1]->option) && $options[1]->option == 'op2') checked @else @endif>Option 2</label>
                </div>

                <div class="checkbox disabled">
                    <label><input type="checkbox" name="options[]" value="op3" @if(!empty($options[2]->option) && $options[2]->option == 'op3') checked @else @endif>Option 3</label>
                </div>

                <div class="form-group">
                    <label class="radio-inline"><input type="radio" value="optradio_1" name="optradio" {{($detail->radio == 'optradio_1')? 'checked':''}}>Option 1</label>
                    <label class="radio-inline"><input type="radio" value="optradio_2" name="optradio" {{($detail->radio == 'optradio_2')? 'checked':''}}>Option 2</label>
                    <label class="radio-inline"><input type="radio" value="optradio_3" name="optradio" {{($detail->radio == 'optradio_3')? 'checked':''}}>Option 3</label>
                </div>

                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select class="form-control" id="sel1" name="sel1">
                        <option value="">Select Number</option>
                        @foreach ($select as $num)
                            <option value="{{$num}}" @if($detail->select == $num) selected @else @endif>{{$num}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="usr">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $detail->date }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Button</button>
            </form>

        </div>
    </body>
</html>