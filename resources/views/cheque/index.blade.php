@extends('layouts.layout')

@section('title', 'Cheque List')

@section('content')

<div class="container">
    <div style="display: flex; align-items: center; justify-content: center; padding-bottom: 20px">
        <h3>LIST OF RECORDS</h3>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Bank Name</th>
                <th>Pay To</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Type</th>
                {{-- <th>For</th> --}}
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cheques as $cheque)
            <tr>
                <td><a href="{{route('cheque.show', $cheque->id)}}">{{strToUpper($cheque->bank->name)}}</a></td>
                <td>{{$cheque->pay_to}}</td>
                <td>{{$cheque->amount}}</td>
                {{-- <td>{{Helper::convertCurrency($cheque->amount)}}</td> --}}
                <td>{{$cheque->date}}</td>
                <td>{{$cheque->type == 0 ? 'A/C' : 'Cash'}}</td>
                {{-- <td> {{$cheque->for}}</td> --}}
                <td>{{$cheque->created_at->diffForHumans()}}</td>
                <td style="display:flex;">
                    <a href="{{route('cheque.show', $cheque->id)}}" class="btn btn-warning btn-sm"
                        style=" margin-left:4px;">View</a>
                    <a href="{{route('cheque.edit', $cheque->id)}}" class="btn btn-info btn-sm" style=" margin-left:4px;">Edit</a>
                    <form action="{{route('cheque.destroy', $cheque->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="margin-left:4px;"
                            onclick="return confirm('Item will be deleted permanently. YOU SURE?')">Delete</button>
                    </form>
                    @if ($cheque->bank->status == 0)
                    <a href="{{route('print.cheque', $cheque->id)}}" class="btn btn-primary btn-sm"
                        style=" margin-left:50px;">Print</a>
                    @else
                    <a href="{{route('print.cheque.ib', $cheque->id)}}" class="btn btn-primary btn-sm"
                        style=" margin-left:50px;">Print</a>
                    @endif
                </td>

                @empty
            <tr class="text-center text-danger">
                <td colspan="10" style="padding-top: 20px">
                    <h4>There is no data available at the moment</h4>
                </td>
            </tr>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('script')
<script>
    $(document).ready( function () {
        $('.table').DataTable();
    } );
</script>

@endsection
