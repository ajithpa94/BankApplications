@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    
                    
                </div>
            </div>
        </div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">Statement of Account</h4>
               

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>Sl.no</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th> Type</th>
                        <th>Details</th>
                        <th>Balance</th>
                       
                    </tr>
                    </thead>


                    <tbody>
                        @php
                        $cnt = 1;
                    @endphp
                     @foreach ($account as $item)
                     <tr>
                         <td>{{ $cnt++ }}</td>
                         <td>{{ $item->created_at }}</td>
                         <td>₹{{ $item->account_amt }}</td>
                         <td>{{ $item->type }}</td>
                         <td>
                             @if ($item->type == 'TransferDebit' || $item->type == 'TransferCredit')
                                 @if ($item->account_amt > 0)
                                     Transfer from {{$item->sender_email}}
                                 @else
                                     Transfer to {{$item->recipient_email}}
                                 @endif
                             @else
                                 {{$item->details}}
                             @endif
                         </td>
                         <td>₹{{ $item->balance }}</td>
                     </tr>
                 @endforeach
                 
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</div> <!-- end container -->
</div>
@endsection
