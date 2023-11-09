<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <!--Insert Modal Starts-->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="completename" class="form-label">Name</label>
                    <input type="text" class="form-control" id="completename" placeholder = "Enter Your Name">
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="adduser()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!--Insert Modal Ends -->

    <!-- Update Modal Starts-->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="updatename" class="form-label">Name</label>
                    <input type="text" class="form-control" id="updatename" placeholder = "Update Name">
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateDetails()">Update</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>
    <!--Update Modal Ends -->

    <div class="container m-3">
        <h1 class="text-center">PHP CRUD Operation</h1>
        <!-- Button trigger modal -->
        <div id="displayDataTable" class="py-3"> </div>
        <div class="d-grid gap-2 px-3 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#completeModal">Insert</button>
        </div>
    </div>
    <!-- Bootstrap Javascript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            displayData();
        });
        function displayData(){
            var displayData = "true";
            $.ajax({
                url: "display.php",
                type: "post",
                data: {
                    displaySend: displayData
                },
                success:function(data, status){
                    $('#displayDataTable').html(data);
                }
            });
        }
        function adduser() {
            var nameAdd=$('#completename').val();
            // $.ajax({
            //     type: "post",
            //     url: "insert.php",
            //     data: {
            //         nameSend: nameAdd
            //     },
            //     dataType: 'json',
            //     success: function (response) {
            //         console.log(response.status, response.data);
            //     }
            // });
            $.ajax({
                url:"insert.php", 
                type: 'post',
                data:{
                    nameSend: nameAdd
                },
                success: function(data, status){
                    $('#completeModal').modal('hide');
                    //function to display data
                    displayData();
                    // console.log(status);
                }
            });
        }
        function updateUser(updateid){
            $('#hiddendata').val(updateid);
            $.post("update.php",{updateid:updateid},function(data, status){
                var userid = JSON.parse(data);
                $('#updatename').val(userid.name);
            });

            $('#updateModal').modal('show');
        }
        function updateDetails(){
            var updatename = $('#updatename').val();
            var hiddendata = $('#hiddendata').val();
            $.post("update.php",{
                updatename:updatename,
                hiddendata:hiddendata
            },function(data,status){
                $('#updateModal').modal('hide');
                displayData();
            });
        }
        function deleteUser(deleteid){
            $.ajax({
                url: "delete.php",
                type: "post",
                data: {
                    deleteSend: deleteid
                },
                success:function(data, status){
                    displayData();
                }
            });
        }
    </script>
</body>
</html>