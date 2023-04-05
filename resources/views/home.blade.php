@extends('layouts.app')
@section('content')
<div class="page-content-wrapper">

    <div class="container-fluid">

        <div class="row" style="align-items: center;">
            <div class="col-sm-12">
                <div class="page-title-box">
                   
                    <h4 class="page-title">Welcome {{Auth::user()->name}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        @if ($acnt)
                        <label class="text-muted">YOUR ID</label>
                        <input type="text" class="form-control" value="{{$acnt->email}}" maxlength="25" readonly />
                        <label class="text-muted">YOUR BALANCE</label>
                        <input type="text" class="form-control" value="{{$acnt->balance}}" maxlength="25" readonly >
                    @endif
                                       
                    
                    
                    
                       
                        
                     
                    </div>
                </div>                
                
                             
                

           
            </div> <!-- end col -->

           
        </div> <!-- end row -->
       
      
      
    </div><!-- container -->

</div> <!-- Page content Wrapper -->
@endsection
