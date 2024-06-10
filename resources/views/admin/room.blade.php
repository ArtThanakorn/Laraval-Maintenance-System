@extends('layout.master')

@section('content')
    <div class="row justify-content-center align-items-center g-2 border border-info">
        <div class="col">
            <div class="card">
                <div class="card-header ">
                    <div class="row justify-between">
                        <div class="col">
                            {{ 'Header' }}
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="button" onclick="openmo()" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#roomAddModal">{{ '+ห้อง' }}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="card-footer text-muted">Footer</div>
            </div>
        </div>
    </div>

    {{-- modal Add --}}
    <div class="modal fade" id="roomAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add_form">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="station" class="form-label">ห้อง</label>
                                    <input type="text" name="nameRoom" class="form-control" id="station" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="station" class="form-label">เพิ่มอุปกรณ์</label>
                                    <button type="button" class="btn btn-success add_item_btn">Add</button>
                                </div>
                            </div>
                        </div>
                        <div id="show_item" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#roomAddModal').on('shown.bs.modal', function() {
                $("#add_form input[type='text']").val(''); // Reset all text inputs
                let equipmentList = document.querySelectorAll("#item_list");
                equipmentList.forEach(element => {
                    element.remove();
                });
                console.log(document.querySelectorAll("#item_list"));
            });

            $('.add_item_btn').click(function(e) {
                e.preventDefault();

                $("#show_item").append(`
                <div id="item_list" class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <label for="equipment" class="form-label">อุปกรณ์</label>
                            <input type="text" name="equipment[]" class="form-control" id="equipment" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <button type="button" class="btn btn-danger w-30 remove_item_btn">Remove</button>
                    </div>
                </div>
                `);
            });

            $(document).on('click', '.remove_item_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

            $("#add_form").submit(function(e) {
                e.preventDefault
                // console.log(e);
                const formeditUt = document.querySelector("#add_form");
                let formData = new FormData(formeditUt);
                const Room = formData.get('nameRoom');
                const Email = formData.get('equipment');
                /* Display the key/value pairs*/
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                return false;
            });
        });
    </script>
@endsection
