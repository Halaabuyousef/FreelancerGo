@extends('admin.app')

@section('content')


<div class="col-12">
    <h1 class="h3 mb-4 text-gray-800">Trashed Projects </h1>

    <a class="btn btn-primary mb-3" href="{{ route('admin.projects.index') }}"><i class="fas fa-project-diagram"></i> All Projects</a>


    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Basic
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            @if (session('msg'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}
            </div>
            @endif
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>
                            <img width="80" src="{{ asset('images/' . $project->image) }}" alt="project image">
                        </td>
                        <td>{{ $project->title }}</td>


                        <td>
                            <a class="btn btn-primary btn-sm p-1" href="{{ route('admin.projects.restore', $project->id) }}">
                                <i class="fas fa-undo" style="position: relative;
                                    left: 3px;"></i>
                            </a>
                            <form class="d-inline" action="{{ route('admin.projects.forcedelete', $project->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm p-1">
                                    <i class="fas fa-times" style="position: relative;
                                        left: 3px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>
@endsection

@section('js')
<!--begin::Page Scripts(used by this page) -->
<script>
    "use strict";
    var KTDatatablesBasicBasic = function() {

        var initTable1 = function() {
            var table = $('#kt_table_1');

            // begin first table
            table.DataTable({
                responsive: true,

                // DOM Layout settings
                dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

                lengthMenu: [5, 10, 25, 50],

                pageLength: 10,

                language: {
                    'lengthMenu': 'Display _MENU_',
                },

                // Order settings
                order: [
                    [1, 'desc']
                ],

                // headerCallback: function(thead, data, start, end, display) {
                //     thead.getElementsByTagName('th')[0].innerHTML = `
                //     <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                //         <input type="checkbox" value="" class="kt-group-checkable">
                //         <span></span>
                //     </label>`;
                // },

                // columnDefs: [
                // {
                //     targets: 0,
                //     width: '30px',
                //     className: 'dt-right',
                //     orderable: false,
                //     render: function(data, type, full, meta) {
                //         return `
                //     <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                //         <input type="checkbox" value="" class="kt-checkable">
                //         <span></span>
                //     </label>`;
                //     },
                // },
                //     {
                //         targets: -1,
                //         title: 'Actions',
                //         orderable: false,
                //         render: function(data, type, full, meta) {
                //             return `
                //         <span class="dropdown">
                //             <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                //               <i class="la la-ellipsis-h"></i>
                //             </a>
                //             <div class="dropdown-menu dropdown-menu-right">
                //                 <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                //                 <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                //                 <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                //             </div>
                //         </span>
                //         <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                //           <i class="la la-edit"></i>
                //         </a>`;
                //         },
                //     },
                //     {
                //         targets: 8,
                //         render: function(data, type, full, meta) {
                //             var status = {
                //                 1: {
                //                     'title': 'Pending',
                //                     'class': 'kt-badge--brand'
                //                 },
                //                 2: {
                //                     'title': 'Delivered',
                //                     'class': ' kt-badge--danger'
                //                 },
                //                 3: {
                //                     'title': 'Canceled',
                //                     'class': ' kt-badge--primary'
                //                 },
                //                 4: {
                //                     'title': 'Success',
                //                     'class': ' kt-badge--success'
                //                 },
                //                 5: {
                //                     'title': 'Info',
                //                     'class': ' kt-badge--info'
                //                 },
                //                 6: {
                //                     'title': 'Danger',
                //                     'class': ' kt-badge--danger'
                //                 },
                //                 7: {
                //                     'title': 'Warning',
                //                     'class': ' kt-badge--warning'
                //                 },
                //             };
                //             if (typeof status[data] === 'undefined') {
                //                 return data;
                //             }
                //             return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
                //         },
                //     },
                //     {
                //         targets: 9,
                //         render: function(data, type, full, meta) {
                //             var status = {
                //                 1: {
                //                     'title': 'Online',
                //                     'state': 'danger'
                //                 },
                //                 2: {
                //                     'title': 'Retail',
                //                     'state': 'primary'
                //                 },
                //                 3: {
                //                     'title': 'Direct',
                //                     'state': 'success'
                //                 },
                //             };
                //             if (typeof status[data] === 'undefined') {
                //                 return data;
                //             }
                //             return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
                //                 '<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
                //         },
                //     },
                // ],
            });

            table.on('change', '.kt-group-checkable', function() {
                var set = $(this).closest('table').find('td:first-child .kt-checkable');
                var checked = $(this).is(':checked');

                $(set).each(function() {
                    if (checked) {
                        $(this).prop('checked', true);
                        $(this).closest('tr').addClass('active');
                    } else {
                        $(this).prop('checked', false);
                        $(this).closest('tr').removeClass('active');
                    }
                });
            });

            table.on('change', 'tbody tr .kt-checkbox', function() {
                $(this).parents('tr').toggleClass('active');
            });
        };

        return {

            //main function to initiate the module
            init: function() {
                initTable1();
            },

        };

    }();

    jQuery(document).ready(function() {
        KTDatatablesBasicBasic.init();
    });
</script>
@endsection