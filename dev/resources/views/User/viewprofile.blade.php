@extends('layouts.master_admin')
@section('content')

<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}

    #form label.error {
        color:red;
    }
    #form input.error {
        border:1px solid red;
    }

    .profile-image {max-width:120px;}
    .profile-image img {max-width: 100%;}
    .profile-details {}
    .profile-details strong {min-width:120px; display:inline-block;}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title"><?php echo "View Profile"; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 m-t-20">

            <div class="card-box m-b-0">
                <div class="row">
                    <div class=" col-sm-12 col-xs-12 p-t-b-10">
                        <div class="form-group row form-main-box">

                            <div class="col-sm-7 profile-details"> 
                                <div class="m-b-10"><strong>Name</strong>: {{$data[0]->first_name}} {{$data[0]->last_name}}</div>
                                <div class="m-b-10"><strong>Email</strong>: {{$data[0]->email}}</div>
                                <div class="m-b-10"><strong>Active</strong>: {{$data[0]->active}}</div>                                        
                            </div>
                        </div>                            
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>    
            </div>
        </div>
    </div>
    @stop
