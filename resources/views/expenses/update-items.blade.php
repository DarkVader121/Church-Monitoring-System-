@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Update Expense Items') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/expense_items/{{ $expenseItems->id }}">
                        @csrf
                        {{ method_field('PATCH') }}
                    <button id="add-input" type="button" class="btn btn-outline-success btn-sm ">Add Item</button>
                        <div id="input-container">
                            @foreach($expenseItems as $item)
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend input-group-sm ">
                                        <span class="input-group-text">{{ $item->id }}</span>
                                    </div>
                                    <div class="form-group input-group-sm">
                                        <input type="text" class="form-control @error('item_name.*') is-invalid @enderror" name="item_name[]" placeholder="Expense Name" value="{{ $item->item_name }}">
                                        @error('item_name.*')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>   
                                    <div class="form-group input-group-sm">
                                        <input type="text" class="form-control @error('amount_item.*') is-invalid @enderror" name="amount_item[]" placeholder="Amount" value="{{ $item->amount_item }}">
                                        @error('amount_item.*')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <form method="POST" action="/expense_items/{{ $item->id }}" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-remove-item" data-item-id="{{ $item->id }}">X</button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    <div id="input-container"></div>
                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // counter for tracking the number of inputs
    var inputCount = 2;

    // listen for button click
    $('#add-input').click(function() {
        // create a new input group
        var newInput = '<div class="input-group input-group-sm mb-3">';
        newInput += '<div class="input-group-prepend">';
        newInput += '<span class="input-group-text">' + inputCount + '</span>';
        newInput += '</div>';
        newInput += '<input type="text" class="form-control" name="item_name[]" placeholder="Expense Name">';
        newInput += '<input type="text" class="form-control" name="amount_item[]" placeholder="Amount">';
        newInput += '<button type="button" class="btn btn-outline-danger btn-sm btn-remove-item">X</button>';
        newInput += '</div>';

        // append the new input group to the container
        $('#input-container').append(newInput);

        // increment the input counter
        inputCount++;
    });


});

$(document).on('click', '.btn-remove-item', function() {
    // get the ID of the expense item to delete
    var itemId = $(this).data('item-id');
    
    // send an AJAX request to delete the expense item
    $.ajax({
        url: '/expense-items/' + itemId,
        type: 'DELETE',
        success: function(result) {
            // if the deletion was successful, remove the input group from the DOM
            $(this).closest('.input-group').remove();
            // update the input counter
            inputCount--;
        },
        error: function(xhr, status, error) {
            // handle any errors that occur during the AJAX call
            console.error(xhr.responseText);
        }
    });
});
</script>
@endsection -->