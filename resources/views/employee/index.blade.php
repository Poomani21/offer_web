@extends('larasnap::layouts.app', ['class' => 'employee-index'])
@section('title','Employee Management')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .append {
        height: 35px;
        padding-top: 5px;
        position: absolute;
        top: 1px;
        right: 32px;
        border-left: 1px solid #d1d3e2;
        padding-left: 2%;
        background-color: #fff;
        cursor: pointer;
    }

    .search_button {
        background-color: white;
        border: 0;
        color: #8d87ad;
    }

    .search_button:hover {
        background-color: white;
        border: 0 !important;
        color: #8d87ad;
    }

    .search_fields {
        width: 30% !important;
        border-radius: 5px;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        /* border: 1px solid #dddddd; */
        text-align: left;
        padding: 8px;
        /* color: black; */
        font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #858796;
    }

    tr:nth-child(even) {
        background-color: #576c761a !important
    }

    .title {
        background-color: #222d32 !important;
        border-radius: 0px;
    }

    .white {
        color: white;
    }

    .col-md-12.filters {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .img {
        width: 66px !important;
        display: flex;
    }

    a.sidebar-brand.d-flex.align-items-center.justify-content-center {
        position: fixed;
        left: 0px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        text-align: left;
        width: 7%;
        padding-right: 21px;
    }
</style>
@endsection
@section('content')
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">

            <div class="card-body">
                <form method="POST" action="#" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                    @method('POST')
                    @csrf

                    <!-- list filters -->
                    <form method="POST" action="#" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                        <div class="col-md-12 filters">

                            <a href="{{route('employee.create')}}" data-toggle="tooltip" data-placement="top" title="Create Client" class="btn btn-primary btn-sm mr-1"><i aria-hidden="true" class="fa fa-plus"></i> Create Employee </a>
                            <!-- import -->
                            <!-- <a href="" data-toggle="tooltip" data-placement="top" title="Import Task" class="btn btn-primary btn-sm mr-1"><i aria-hidden="true" class="fa fa-plus"></i> Import Tasks </a> -->

                    </form>
            </div>
            <!-- list filters -->
            <br> <br>
            <div class="table-responsive">
                <table class="table noExl" id="myTab">
                    <thead>
                        <tr>         

                            <th>S.No</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>City</th> 
                            <th>Agency Name</th>
                            <th>Type</th>                                                                                         
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($employees as $i => $employee)

                        <tr>		
                        
                              <td>{{ ++$i }}</td>
                              <td>{{ $employee->name ? $employee->name: '- NA -'  }}</td>
                              <td>{{ $employee->phone_number ? $employee->phone_number: '- NA -' }}</td>                              
                              <td>{{ $employee->email ? $employee->email: '- NA -' }}</td>
                              <td>{{ $employee->city ? $employee->city: '- NA -' }}</td>  
                              <td>{{ $employee->agency_name ? $employee->agency_name: '- NA -' }}</td> 
                              <td>{{$employee->type ? $employee->type: '- NA -'}}</td>                       
                            
                              <td>
                                 <form id="department_deleteForm" action="{{route('employee.destroy',$employee->id)}}" method="GET" id="deleteForm">
                                   @csrf
                                    @method('GET')                                  
                                    <a href="{{route('employee.edit',$employee->id)}}" title="Edit"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>                                
                                    <a href="{{route('employee.show',$employee->id)}}" title="show"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button></a>                                
                                    <a onclick="deleteModel_departments({{$employee->id}})" title="Delete "><button data-toggle="modal" data-target="#small_departments" class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                </form>
                              </td>

                        </tr>

                          @empty
                           <tr>
                              <td class="text-center" colspan="12">No Record found!</td>
                           </tr>
                           @endforelse

                    </tbody>
                </table>
                <div class="pagination">

                </div>
            </div>

        </div>

    </div>
</div>

</div>
<div class="modal fade" id="small_departments" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body delete-modal text-center">
                <p><img src="{{asset('images/sure.jpg')}}" alt=""></p>
                <h4><b>Are you sure?</b></h4>
                <input type="hidden" id="departments_id" value="" class="deleteAdmin">
                <p>Do you really want to delete these record? this process cannot be undone.</p>
            </div>
            <div class="modal-footer p-0">
                <button type="button" onclick="triggerDelete_departments()" class="btn btn-danger" data-dismiss="modal">Yes Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Page Content End-->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
    var roleDelteURL_dep = "{{route('employee.destroy',':id')}}"

    function deleteModel_departments(id) {
        jQuery('#departments_id').val(id);
    }

    function triggerDelete_departments() {
        var action_url = jQuery("#deleteForm").prop('action');
        let roleId = jQuery('#departments_id').val();

        action_url = roleDelteURL_dep.replace(':id', roleId);

        jQuery("#department_deleteForm").attr('action', action_url);

        jQuery("#department_deleteForm").submit();
    }
</script>