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
                            <button type="button" onclick="openModal()" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#roomAddModal">{{ '+ห้อง' }}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ห้อง</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">ลบ</th>
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
                                            data-bs-target="#detailModal">
                                            {{ 'รายละเอียด' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            {{ ' Button' }}
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

    <!-- Modal Details-->
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="station" class="form-label">ห้อง</label>
                                    <input type="text" name="nameRoom" class="form-control" id="station"
                                        placeholder="">
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
                        <button type="submit" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            const roomAddModal = document.getElementById('roomAddModal');
            const showItem = document.getElementById('show_item');
            const addForm = document.getElementById('add_form');

            // Flag to check if listeners are already added
            let listenersAdded = false;

            // Function to open modal
            function openModal() {
                // Reset text inputs and remove existing equipment list items on modal show
                addForm.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
                showItem.innerHTML = ''; // Clear existing items
            }

            // Add equipment item on button click
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('add_item_btn')) {
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
                    removeCol.classList.add('col-md-3');

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.classList.add('btn', 'btn-danger', 'w-30', 'remove_item_btn');
                    removeButton.textContent = 'Remove';
                    removeCol.appendChild(removeButton);

                    newItem.appendChild(removeCol);

                    showItem.appendChild(newItem);
                }
            });

            // Remove equipment item on button click
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove_item_btn')) {
                    event.preventDefault();
                    const itemToRemove = event.target.parentElement.parentElement;
                    itemToRemove.remove();
                }
            });

            // Attach event listener to modal show event to open modal
            roomAddModal.addEventListener('show.bs.modal', function() {
                openModal();
            });

        });

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
                        console.log(response);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }

        function openDetail(row) {
            console.log(row);

            const myDiv = document.getElementById('myDiv');
            const labelheader = document.getElementById('detailModalLabel');
            labelheader.innerHTML += `<p>ห้อง  </p>`;
            const data = row.map((detail) => {
                // console.log(detail.name_equipment);
                myDiv.innerHTML += `<li class="list-group-item">${detail.name_equipment}</li>`;
            })

        }

        /* Optional: Place to the bottom of scripts */

        /* const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
        );*/
    </script>
@endsection
