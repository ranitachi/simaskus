@extends('layouts.master')
@section('title')
    <title>Notifikasi :: SIMASKUS</title>
@endsection

@section('konten')
    <div class="page-content">  
    
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('beranda')}}">Beranda</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Data Notifikasi</span>
                </li>
            </ul>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-bell font-dark"></i>
                            <span class="caption-subject bold uppercase">Notifikasi</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <div id="data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footscript')
{{-- <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script> --}}
<script>

    $(document).ready(function(){
        loaddata();
    });

    function notifikasibaca(id,st)
    {
        $.ajax({
            url : '{{url("notifikasi-baca")}}/'+id+'/'+st,
            dataType : 'json'
        }).done(function(){
            loaddata();
            swal("Berhasil", "Notifikasi Sudah Di Tandai", "success")
        }).fail(function(){
            swal("Gagal", "Notifikasi Gagal Di Tandai", "error")
        });
    }

    function loaddata()
    {
        $('#data').load('{{url("notifikasi-data")}}',function(){
            var table = $('#sample_1');

            var oTable = table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "Data Kosong",
                    "info": "_START_ dari _END_ total _TOTAL_ data",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "_MENU_ Data",
                    "search": "Cari Data :",
                    "zeroRecords": "Data Tidak Ditemukan"
                },
                buttons: [
                    
                    { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                ],

                // setup responsive extension: http://datatables.net/extensions/responsive/
                responsive: true,

                "order": [
                    [0, 'asc']
                ],
                
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                "pageLength": 10,

                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // 
            });
        });
    }
</script>
@endsection