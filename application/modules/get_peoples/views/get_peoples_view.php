  <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url('assets/'); ?>jquery.zbox.css" /> 
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>jquery.zbox.min.js"></script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                People
                            </h2>
                            <br>
                            <a href="javascript:void(0);" id="addmodal" class="btn btn-primary waves-effect">  <i class="material-icons">add_circle</i>  Tambah Data </a>
 
                        </div>
                        <div class="body">
                    
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped table-hover js-basic-example" id="example" >
  
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">Account ID</th>  
                                            <th style="width:5%;">Email</th> 
                                            <th style="width:5%;">Name</th> 
                                            <th style="width:5%;">Opsi</th> 
                                        </tr>
                                    </thead> 
                                </table> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
         


        </div>
    </section>

   
    <!-- form tambah dan ubah data -->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Form Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                              <form method="post" id="user_form" enctype="multipart/form-data">   
                                 
                                    <input type="hidden" name="id" id="id">    

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Nama produk" />
                                        </div>
                                    </div>
                                  

                                   <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                                   <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                             </form>
                       </div>
                     
                    </div>
                </div>
    </div>

     <!-- modal listing user room -->
     <div class="modal fade" id="UserRoomsModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Listing User Rooms</h4>
                        </div>
                        <div class="modal-body">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                                <br>
                                <hr>

                                 <table width="100%" class="table table-bordered table-striped table-hover " id="listing_user_room" > 
                                    <thead>
                                        <tr>  
                                            <th style="width:15%;">Name</th>
                                            <th style="width:15%;">Room ID</th>
                                      
                                         </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>  
                                </table>  
                       </div>
                     
                    </div>
                </div>
    </div>

 
      

 
   <script type="text/javascript">
    // function GetUserRooms(id){
    //     var awal = id;
    //     var rep = awal.replace("+","");
    //    //alert(id);
    //    $.ajax({
    //         url:"<?php echo base_url(); ?>get_peoples/fetch_user_room",
    //         type:"POST",
    //         data:{parsing:rep},
    //         success:function(result){ 
    //             console.log(result);                 
    //         }
    //         }); 
         
    // }


    function GetUserRooms(id){
        $("#UserRoomsModal").modal({backdrop: 'static', keyboard: false,show:true});

        var awal = id;
        var rep = awal.replace("+","");
        
        $('#listing_user_room').DataTable({
            "processing" : true,
            "ajax" : {
                url:"<?php echo base_url(); ?>get_peoples/fetch_user_room",
                "data":{rep},
                "type":"POST",
                 dataSrc : '',

            },
 

            "columns" : [ {
                "data" : "name"
            },{
                "data" : "room_id"
            }],

            "rowReorder": {
                "update": false
            },

            "destroy":true,
        });
    
 
    } 



    function GetCreatedRooms(id){
         console.log(id); 
    }
 
      


    function PreviewGambar(input) {
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#foto_upload').attr('src', e.target.result);
                $("#foto").val($('#foto_upload').val().replace(/C:\\fakepath\\/i, ''));
            };
            reader.readAsDataURL(input.files[0]);
            
        }
    }

   
    $('#daftar_satuan').DataTable( {
            "ajax": "<?php echo base_url(); ?>produk/fetch_satuan"           
    });

     
     
    function CariSatuan(){
        $("#CariSatuanModal").modal({backdrop: 'static', keyboard: false,show:true});
    }  
        
        var daftar_satuan = $('#daftar_satuan').DataTable();
     
        $('#daftar_satuan tbody').on('click', 'tr', function () {
            
            var content = daftar_satuan.row(this).data()
            console.log(content);
            $("#nama_satuan").val(content[0]);
            $("#id_satuan").val(content[1]);
            $("#CariSatuanModal").modal('hide');
        } );
      
       
     function Ubah_Data(id){
        $("#defaultModalLabel").html("Form Ubah Data");
        $("#defaultModal").modal('show');
        $('#user_form')[0].reset();
        $.ajax({
             url:"<?php echo base_url(); ?>produk/get_data_edit/"+id,
             type:"GET",
             dataType:"JSON", 
             success:function(result){ 
                 console.log(result);
                 $("#defaultModal").modal('show'); 
                 $("#id").val(result.id); 
                 $("#id_satuan").val(result.id_satuan);
                 $("#foto").val(result.foto);   
                 $("#harga_satuan").val(result.harga_satuan);   
                 $("#nama_produk").val(result.nama_produk);
                 $("#nama_satuan").val(result.satuan);
                
                  
             }
         });
     }
 
     function Bersihkan_Form(){
        $(':input').val(''); 
         
     }

     function Hapus_Data(id){
        if(confirm('Anda yakin ingin menghapus data ini?'))
        {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('produk/hapus_data')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
               $('#example').DataTable().ajax.reload(); 
               
                $.notify("Data berhasil dihapus!", {
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    }  
                 },{
                    type: 'success'
                    });
                 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
   
    }
    }
    
      
  
    function Simpan_Data(){
        //setting semua data dalam form dijadikan 1 variabel 
         var formData = new FormData($('#user_form')[0]); 
 
          
           

                //transaksi dibelakang layar
                $.ajax({
                 url:"<?php echo base_url(); ?>produk/simpan_data",
                 type:"POST",
                 data:formData,
                 contentType:false,  
                 processData:false,   
                 success:function(result){ 
                    
                     $("#defaultModal").modal('hide');
                     $('#example').DataTable().ajax.reload(); 
                     $('#user_form')[0].reset();
                     Bersihkan_Form();
                     $.notify("Data berhasil disimpan!", {
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                     } 
                     },{
                        type: 'success'
                    });
                 }
                }); 

      
           

    }
      
   
       $(document).ready(function() {
           
        $("#addmodal").on("click",function(){
            $("#defaultModal").modal({backdrop: 'static', keyboard: false,show:true});
            $("#method").val('Add');
            $("#defaultModalLabel").html("Form Tambah Data");
        });
         
      
        
        $('#example').DataTable( {
            "ajax": "<?php echo base_url(); ?>get_peoples/fetch_people" 
               
        });
  
         
      });
   
    </script>