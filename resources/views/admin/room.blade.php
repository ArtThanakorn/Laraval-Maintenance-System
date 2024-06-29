@extends('layout.master')

@section('content')
    @php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp
    <div class="row justify-content-center align-items-center g-2 border border-info">
        <div class="col">
            <div class="card">
                <div class="card-header ">
                    <div class="row justify-between">
                        <div class="col">
                            {{ 'Header' }}
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="button" onclick="openModal()" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#roomAddModal">{{ '+ห้อง' }}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <thead>
                            <tr>
                                <th scope="col">{{ 'ลำดับ' }}</th>
                                <th scope="col">{{ 'ห้อง' }}</th>
                                <th scope="col">{{ 'รายละเอียด' }}</th>
                                <th scope="col">{{ 'Qr ห้อง' }}</th>
                                <th scope="col">{{ 'เพิ่มอุปกรณ์' }}</th>
                                <th scope="col">{{ 'ลบอุปกรณ์' }}</th>
                                <th scope="col">{{ 'แก้ไขห้อง' }}</th>
                                <th scope="col">{{ 'ลบห้อง' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $key => $row)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $row->name_room }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary"
                                            onclick="openDetail({{ $row->detail }})" data-bs-toggle="modal"
                                            data-bs-target="#detailModal" data-bs-whatever="{{ $row->name_room }}">
                                            {{ 'รายละเอียด' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#ModalQr" data-bs-idroom="{{ $row->id }}">
                                            {{-- {{ 'QR' }} --}}
                                            <i class="bi bi-qr-code"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#addEquipmentModal" data-bs-whatever="{{ $row->name_room }}"
                                            data-bs-whatever2="{{ $row->id }}">
                                            {{-- {{ 'เพิ่ม' }} --}}
                                            <i class="bi bi-tools"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"
                                            onclick="openEditEquipment({{ $row->detail }})" data-bs-toggle="modal"
                                            data-bs-target="#openEditModal">
                                            {{-- {{ 'ลบ' }} --}}
                                            <i class="bi bi-tools"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editRoomModal" data-bs-whatever="{{ $row->name_room }}"
                                            data-bs-whatever2="{{ $row->id }}">
                                            {{-- {{ 'แก้ไข' }} --}}
                                            <i class="bi bi-house-gear"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"
                                            onclick="destroyRoom({{ $row->id }})">
                                            {{-- {{ ' destroy ห้อง' }} --}}
                                            <i class="bi bi-house-dash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer text-muted">Footer</div>
            </div>
        </div>
    </div>

    <!-- Modal qrcode room -->
    <div class="modal fade" id="ModalQr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-2">
                        {{-- <p class="mb-0">Simple</p> --}}
                        <a href="" id="container">{{ QrCode::size(200)->generate('https://minhazulmin.github.io/') }}</a><br />
                        <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">Download
                            SVG</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add equipment -->
    <div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">{{ 'เพิ่มอุปกรณ์ห้อง' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addFormEquipment">
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col ">
                                <label for="exampleFormControlInput1" class="form-label">{{ 'อุปกรณ์' }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="equipment[]" id=""
                                        placeholder="">
                                    <button id="add_item_btn" type="button" class="btn btn-success ">
                                        {{-- <i class="bi bi-trash"></i> --}}
                                        <i class="bi bi-plus-square"></i>
                                    </button>
                                </div>
                                <small id="error-add-equipment" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <input type="hidden" id="room-id" name="id_room">
                        <div id="show_item"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="addeTool()">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ 'ปิด' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit equipment -->
    <div class="modal fade" id="openEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ 'ลบอุปกรณ์' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-tool">
                    <div class="modal-body">
                        <div id="divEdit" class="row justify-content-center align-items-center g-2">

                        </div>
                        <input type="hidden" id="room-remove-id" name="id_room_remove[]">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"
                            onclick="srtDataEquipment()">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit rooms -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ 'แก้ไขข้อมูลห้อง' }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit-room">
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="mb-3">
                                    <input type="hidden" id="e-room-name" name="eRoomId">
                                    {{-- <label for="" class="form-label">Name</label> --}}
                                    <input type="text" class="form-control" name="EroomName" id="nameroom"
                                        aria-describedby="helpId" placeholder="NameRoom" />
                                    <small id="editName" class="form-text text-danger"></small>
                                </div>

                            </div>
                            {{-- <div class="col">Column</div>
                        <div class="col">Column</div> --}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="setededitroom()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Details rooms-->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 18rem;">
                        <ul id="myDiv" class="list-group list-group-flush">

                        </ul>
                    </div>


                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- modal Add --}}
    <div class="modal fade" id="roomAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="add_form">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ 'เพิ่มห้อง' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="station" class="form-label">{{ 'ห้อง' }}</label>
                                    <input type="text" name="nameRoom" class="form-control" id="station"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"
                            onclick="submitForm()">{{ 'บันทึก' }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ 'ปิด' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to modal elements
            const roomAddModal = document.getElementById('addEquipmentModal');
            const showItem = document.getElementById('show_item');
            const mydevAddTool = document.getElementById('add_item_btn');
            const btntrash = document.getElementsByClassName('remove_item_btn');
            let toolIdList = [];
            // Flag to check if listeners are already added
            let listenersAdded = false;

            // Add equipment item on button click
            mydevAddTool.addEventListener('click', function(event) {
                event.preventDefault();

                const newItem = document.createElement('div');
                newItem.classList.add('row', 'justify-content-center', 'align-items-center', 'g-2');

                const equipmentCol = document.createElement('div');
                equipmentCol.classList.add('col');

                const equipmentLabel = document.createElement('label');
                equipmentLabel.classList.add('form-label');
                equipmentLabel.textContent = 'อุปกรณ์';
                equipmentCol.appendChild(equipmentLabel);

                const equipmentInput = document.createElement('input');
                equipmentInput.type = 'text';
                equipmentInput.name = 'equipment[]';
                equipmentInput.classList.add('form-control');
                equipmentInput.placeholder = '';
                equipmentCol.appendChild(equipmentInput);

                newItem.appendChild(equipmentCol);

                const removeCol = document.createElement('div');
                removeCol.classList.add('col-md-auto', 'align-self-end');

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('btn', 'btn-danger', 'remove_item_btn');
                removeButton.textContent = 'ลบ';

                removeCol.appendChild(removeButton);

                newItem.appendChild(removeCol);

                showItem.appendChild(newItem);
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove_item_btn')) {
                    // console.log('123');
                    event.preventDefault();
                    const itemToRemove = event.target.parentElement.parentElement;
                    itemToRemove.remove();
                }
                if (event.target.classList.contains('remove_item_btnedittool')) {
                    event.preventDefault();
                    const itemToRemove = event.target.parentElement;
                    const toolId = event.target.id;
                    itemToRemove.remove();
                    toolIdList.push(toolId)
                    document.getElementById('room-remove-id').value = toolIdList;
                }
            });

            // Attach event listener to modal show event to open modal
            roomAddModal.addEventListener('show.bs.modal', function() {
                openModal();
            });
            // Moadl
            const addEquipmentModal = document.getElementById('addEquipmentModal');
            const detailModalRoom = document.getElementById('detailModal');
            const editModalRoom = document.getElementById('editRoomModal');
            const roomQr = document.getElementById('ModalQr');
            addEquipmentModal.addEventListener('show.bs.modal', event => {
                document.getElementById('error-add-equipment').innerHTML = "";
                const formModal = document.getElementById('addEquipmentModal');
                const showItem = document.getElementById('show_item');
                // Reset text inputs and remove existing equipment list items on modal show
                formModal.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
                showItem.innerHTML = ''; // Clear existing items
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever');
                const roomid = button.getAttribute('data-bs-whatever2');
                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                const modalTitle = addEquipmentModal.querySelector('.modal-title');
                const inputHidden = document.getElementById('room-id');
                modalTitle.textContent = `เพิ่มอุปกรณ์ห้อง ${recipient}`;
                inputHidden.value = roomid;
            });
            detailModalRoom.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever');
                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                const modalTitle = detailModalRoom.querySelector('.modal-title');

                modalTitle.textContent = `ห้อง ${recipient}`;
            });
            editModalRoom.addEventListener('show.bs.modal', (event) => {
                // console.log('123');
                document.getElementById('editName').innerHTML = "";
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever');
                const roomid = button.getAttribute('data-bs-whatever2');

                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                const modalInput = editModalRoom.querySelector('#nameroom');
                const eromId = document.getElementById('e-room-name');
                // console.log(recipient);
                modalInput.value = recipient;
                eromId.value = roomid;
            });
            roomQr.addEventListener('show.bs.modal', (event) => {
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-idroom');

                const myLink = document.getElementById("roomLink");

                myLink.setAttribute("href", "{{ route('index.repair', '') }}" + '/' + recipient);
            });
        });

        // Function to open modal
        function openModal() {
            const addForm = document.getElementById('add_form');
            // Reset text inputs and remove existing equipment list items on modal show
            addForm.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
        }

        function submitForm() {
            const formRa = document.querySelector('#add_form');
            let url = "{{ route('R.create') }}";
            formRa.onsubmit = function(e) {
                e.preventDefault();

                let formData = new FormData(formRa);
                const Room = formData.get('nameRoom');
                const Equipment = formData.get('equipment');
                /* Display the key/value pairs*/
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                // return false;


                axios.post(url, formData).then(function(response) {
                        // console.log(response);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }

        function openDetail(row) {
            console.log(row);

            const myDiv = document.getElementById('myDiv');
            myDiv.innerHTML = '';
            if (row.length != 0) {
                const data = row.map((detail) => {
                    // console.log(detail.name_equipment);
                    myDiv.innerHTML += `<li class="list-group-item">${detail.name_equipment}</li>`;
                })
            } else {
                myDiv.innerHTML += `<li class="list-group-item">{{ 'ยังไม่มีอุปกรณ์ในห้องนี้' }}</li>`;
            }
        }

        function addeTool() {
            // error-add-equipment
            let url = "{{ route('R.create.tool') }}";
            let isError = {
                aEquipment: false,
            };
            let isValid = true;
            const addForm = document.getElementById('addFormEquipment');


            addForm.onsubmit = function(e) {
                e.preventDefault();

                let formData = new FormData(addForm);
                const Equipment = formData.get('equipment[]');

                if (Equipment.length < 1) {
                    isError.aEquipment = true;
                    document.getElementById('error-add-equipment').innerHTML = "กรุณาระบุอุปกรณ์";
                } else {
                    isError.aEquipment = false;
                    document.getElementById('error-add-equipment').innerHTML = "";
                }
                const hasError = Object.values(isError).find((err) => err === true);
                hasError ? isValid = false : isValid = true;
                if (isValid) {
                    // console.log('123');
                    /* Display the key/value pairs*/
                    for (var pair of formData.entries()) {
                        console.log(pair[0] + ', ' + pair[1]);
                    }
                    // return false;
                    axios.post(url, formData).then((res) => {
                        console.log(res.data);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: res.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    });
                }
            }
        }

        function openEditEquipment(row) {
            // console.log(row);
            // console.log(roomsData);
            const round = row.length;
            const myDiv = document.getElementById('divEdit');
            myDiv.innerHTML = '';

            row.forEach((item, index) => {
                myDiv.innerHTML += `<div class="col-md-4 d-flex d-2">
                    <input type="text" class="form-control"  placeholder="" value="${item.name_equipment}" >
                    <button id="${item.id}" type="button" class="btn btn-danger btn-sm remove_item_btnedittool" data-tool_name="${item.name_equipment}">{{ 'ลบ' }}</button>
                    </div>`;
                const btnEdit = myDiv.querySelectorAll('#btnEdit');
                // console.log(btnEdit);
            });
            btnEdit.forEach(element => {
                element.document.addEventListener("click", () => {
                    console.log(element.getAttribute('data'));
                });
            });


            // for (let i = 0; i < round; i++) {
            //     myDiv.innerHTML += ` <div class="col-md-4">${row.name_equipment}</div>`;
            // }
        }

        function srtDataEquipment() {
            const formEditEquipment = document.querySelector('#edit-tool');
            const Routing = "{{ route('R.remove.tool') }}";

            formEditEquipment.onsubmit = function(e) {
                e.preventDefault();

                let formData = new FormData(formEditEquipment);

                /* Display the key/value pairs*/
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                // return false;
                axios.post(Routing, formData).then((res) => {
                    console.log(res);
                    if (res.status = 200) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            };
        }

        function setededitroom() {
            const Routing = "{{ route('R.updata') }}";
            const eFR = document.querySelector('#form-edit-room');
            let formData = new FormData(eFR);
            let isError = {
                eRoomName: false,
            };
            let isValid = true;
            const roomname = formData.get('EroomName');
            if (roomname.trim().length < 1) {
                isError.eRoomName = true;
                document.getElementById('editName').innerHTML = "กรุณาระบุชื่อห้อง";
            } else {
                isError.eRoomName = false;
                document.getElementById('editName').innerHTML = "";
            }

            const hasError = Object.values(isError).find((err) => err === true);
            hasError ? isValid = false : isValid = true;
            eFR.onsubmit = function(e) {
                e.preventDefault();

                /* Display the key/value pairs*/
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                // return false;

                if (isValid) {
                    axios.post(Routing, formData).then((res) => {
                        // console.log(res);
                        if (res.status = 200) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: res.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            };
        }

        function destroyRoom(id) {
            const Routing = "{{ route('R.deleta', '') }}" + '/' + id;
            console.log(id);
            Swal.fire({
                title: "Are you remove?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(Routing).then((res) => {
                        console.log(res);
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }).then(() => {
                        location.reload();
                    });
                }
            });

        }

        function downloadSVG() {
            const svg = document.getElementById('container').innerHTML;
            const blob = new Blob([svg.toString()]);
            const element = document.createElement("a");
            element.download = "w3c.svg";
            element.href = window.URL.createObjectURL(blob);
            element.click();
            element.remove();
        }
    </script>
@endsection
