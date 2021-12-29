require('./bootstrap');



import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/plugins/datatables/jquery.dataTables.min.js';
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import 'admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js';
import 'admin-lte/plugins/select2/js/select2.full.min.js';
// import 'admin-lte/dist/js/demo.js';
//Don't forgot to put code also same as below otherwise it will not working



// //Datatable
// $("#example1").DataTable({
//     "responsive": true,
//     "autoWidth": false,
//   });

//Initialize Select2 Elements
$('.select2').select2()

$("input[data-bootstrap-switch]").each(function(){
  $(this).bootstrapSwitch('state', $(this).prop('checked').false);
});


//Initialize Select2 Elements
// $('.select2bs4').select2({
//     theme: 'bootstrap4'
// })