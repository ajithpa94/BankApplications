@extends('layouts.app')
@section('content')
<div class="page-content-wrapper">

    <div class="container-fluid">

        <div class="row" style="align-items: center;">
            <div class="col-sm-12">
                <div class="page-title-box">
                   
                    <h4 class="page-title">Transfer Money</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{url('strore_transfer_money')}}" method="POST">
                        @csrf
                        <h6 class="text-muted">Recipient Email</h6>                     
                        <select class="form-control" name="recipient_user_id" maxlength="25">
                            <option value="">please select</option>
                            @foreach ($users as $user)
                                @if ($user->id !== Auth::user()->id)
                                    <option value="{{$user->id}}">{{$user->email}}</option>
                                @endif
                            @endforeach
                        </select>
                        <h6 class="text-muted">Amount</h6>
                        <input type="number" class="form-control" placeholder="Enter amount" maxlength="25" name="transfer_amount" required>
                        <div class="button-items"><br>
                            <button type="submit" style="background-color:blue;" class="btn btn-secondary btn-sm btn-block">Transfer Funds</button>
                        </div>
                    </form>
                    
                       
                    </div>
                </div>                
                
                             
                

           
            </div> <!-- end col -->

           
        </div> <!-- end row -->
       
      
      
    </div><!-- container -->

</div> <!-- Page content Wrapper -->
@endsection
