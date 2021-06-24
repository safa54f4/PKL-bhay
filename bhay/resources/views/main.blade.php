<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Visum</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ asset('style/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styleassets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/scss/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    
    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/datatables-init.js') }}"></script>
 
 
    <div class="breadcrumbs">
            <div class="col-sm-2">
                <div class="page-header float-right">
                    <div class="page-title">
                      <center>  <h1 align="center">Data Visum</h1> </center>
                    </div>
                </div>
            </div>
        
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Status Visum Anda</strong>
                        </div>
                        <div class="col-md-4">
                  <label></label>
                  <select id="filter" name="filter" class="form-control filter" onchange="filter()">
                    <option value="Semua" selected>Filter Status</option>
                    <option value="Semua">All</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dalam_Proses">Dalam Proses</option>
                  </select>
                 <br/>
                </div>
                <div class="breadcrumbs">
   <!-- <h3 align="center">Live search in laravel using AJAX</h3><br /> -->
   <div class="panel panel-default">
    <!-- <div class="panel-heading">Search</div> -->
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Search " />
     </div>
     <br />
            <div class="card-body">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                </div>
            </div>
            <br />
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                      <!-- <td>No</td> -->
                <td>No surat</td>
                <td>tanggal</td>
                <td>nama dokter</td>
                <td>No rawat</td>
                <td>Nama</td>
                <td>Kategori</td>
                <td>Instansi</td>
                <td>Status</td>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($surat as $item)
                      <tr>
                        <!-- <td>{ ++$no + ($surat->currentPage () -1 * $mahasiswa->perPage() }}</td> -->
                        <td>{{$item->no_surat}}</td>
                        <td>{{$item->tanggalsurat}}</td>
                        <td>{{$item->nm_dokter}}</td>
                        <td>{{$item->no_rawat}}</td>
                        <td>{{$item->nm_pasien}}</td>
                        <td>{{$item->kategori}}</td>
                        <td>{{$item->instansi}}</td>
                        <td>{{$item->status}}</td>
                      </tr>
                 @endforeach
                    </tbody>
                  </table>
                  
                        </div>
                    </div>
                </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
        </div>
    </div>    
    

<script>
    function filter(){
        var x = document.getElementById("filter").value;
        window.location.replace('http://localhost:8000/surat/'+ x);
    }
</script>


<script>
$(document).ready(function(){

 fetch_surat_data();

 function fetch_surat_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_surat_data(query);
 });
});
</script>

</body>
</html>