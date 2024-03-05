@extends('layouts.memberapp')

@section('content')

<!-- หน้าตั้งค่า Profile -->
<main class="container">
    <div class="d-flex align-items-center"></div>
    <div class="row">
        <div class="b-example-divider"></div>
        <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
            <div class="container mt-3">
                <h3 class="text-center">{{ Auth::user()->name }}</h3><br>
                <a href="{{ route('editprofile') }}"><button type="button" class="btn btn-secondary">Upload Profile
                        Image</button></a>
                <a href=""><button type="button" class="btn btn-secondary ">Edit Profile Image</button></a>
                <div class="bg-body ">
                    <!-- เปลี่ยน username -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Username</p>
                        <form action="{{ route('update-name') }}" method="post">
                            @csrf
                            <input type="text" class="form-control form-control-dark text-bg-gray"
                                placeholder="Enter your new username" aria-label="Search" name="new_name"><br>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </form>
                    </div>
                    <!------------>
                    <!-- เปลี่ยน password -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm border">
                        <p>Change Password </p>
                        <form action="{{ route('update-password') }}" method="post">
                            @csrf
                            <input type="password" class="form-control form-control-dark text-bg-gray"
                                name="new_password" placeholder="Enter your new password" required><br>
                            <input type="password" class="form-control form-control-dark text-bg-gray"
                                name="new_password_confirmation" placeholder="Confirm your new password" required><br>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </form>
                    </div>
                    <!------------>
                </div>
            </div>

            <!-- start katoo -->
            <div class="bg-body">
                <div class="my-3 p-3 bg-body rounded shadow-sm  border">
                    <h6 class="border-bottom pb-2 mb-0">กระทู้ที่1</h6>
                    <div class="d-flex text-body-secondary pt-3">
                        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                                dy=".3em">32x32</text>
                        </svg>
                        <p class="pb-3 mb-0 small lh-sm border-bottom">

                            <strong class="d-block text-gray-dark">@username</strong>
                            หัวข้อกระทู้
                        </p>
                    </div>
                    <div style="display: flex; justify-content: flex-end;">
                        <button class="btn btn-primary " type="button" style="margin-right: 5px;" data-bs-toggle="modal"
                            data-bs-target="#myModalmore">more</button>
                        <button class="btn btn-warning " type="button" style="margin-right: 5px;" data-bs-toggle="modal"
                            data-bs-target="#myModaledit">edit</button>
                        <button class="btn btn-danger " type="button" style="margin-right: 5px;">delete</button>
                    </div>


                </div>
                <div class="bg-body">
                    <div class="my-3 p-3 bg-body rounded shadow-sm  border">
                        <h6 class="border-bottom pb-2 mb-0">กระทู้ที่2</h6>
                        <div class="d-flex text-body-secondary pt-3">
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%"
                                    fill="#007bff" dy=".3em">32x32</text>
                            </svg>
                            <p class="pb-3 mb-0 small lh-sm border-bottom">

                                <strong class="d-block text-gray-dark">@username</strong>
                                หัวข้อกระทู้
                            </p>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-primary " type="button" style="margin-right: 5px;"
                                data-bs-toggle="modal" data-bs-target="#myModalmore">more</button>
                            <button class="btn btn-warning " type="button" style="margin-right: 5px;"
                                data-bs-toggle="modal" data-bs-target="#myModaledit">edit</button>
                            <button class="btn btn-danger " type="button" style="margin-right: 5px;">delete</button>
                        </div>
                    </div>
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a class="page-link" href="#">หน้าก่อน</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">หน้าถัดไป</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- The Modal add-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มกระทู้</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">username:</label>

                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">หัวข้อกระทู้:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">รายละเอียดกระทู้:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                        <label for="message-text" class="col-form-label">เพิ่มรูปภาพ:</label>
                        <input class="form-control" type="file" id="formFile">
                        <p class="small mb-0 mt-2"><b>Note : </b>Only JPG, JPEG, PNG files are allowed to upload.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Send message</button>

                    </div>
                </div>
            </div>
        </div>
        <!------------------->

        <!-- The Modal edit-->
        <div class="modal" id="myModaledit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขกระทู้</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">กระทู้ที่1</label>

                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">ข้อความที่จะแก้ไข</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Send message</button>

                    </div>
                </div>
            </div>
        </div>
        <!--------------->

        <!-- The Modal more-->
        <div class="modal" id="myModalmore">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                    <div class="modal-header">
                        <h4 class="modal-title">ตอบกลับกระทู้</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form>

                            <div class="my-3 p-3 bg-body rounded shadow-sm  border">
                                <h6 class="border-bottom pb-2 mb-0"></h6>
                                <div class="d-flex text-body-secondary pt-3">
                                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%"
                                            fill="#007bff" dy=".3em">32x32</text>
                                    </svg>
                                    <p class="pb-3 mb-0 small lh-sm border-bottom">

                                        <strong class="d-block text-gray-dark">@username</strong>
                                        ความคิดเห็นกระทู้
                                    </p>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">ตอบกลับกระทู้</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Send message</button>

                    </div>
                    <!--------------->





                    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"></script> -->

                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection

<script>
    $(document).ready(function () {
        $('#myModaledit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            // Extract info from data-* attributes if needed
            // Update the modal's content accordingly
        });

        $('#myModalmore').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            // Extract info from data-* attributes if needed
            // Update the modal's content accordingly
        });
    });
</script>
