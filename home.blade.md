@extends('layouts.memberapp')

@section('content')
<!-- The Modal add-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มกระทู้</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"><b>คุณ : {{ Auth::user()->name }} </b></label>

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">หัวข้อกระทู้ :</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">รายละเอียดกระทู้ :</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
                <label for="message-text" class="col-form-label">เพิ่มรูปภาพ :</label>
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

<!-- The modal more -->
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
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                            </svg>
                            <p class="pb-3 mb-0 small lh-sm border-bottom">

                                <strong class="d-block text-gray-dark">{{ Auth::user()->name }} </strong>
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
        </div>
    </div>
</div>
<!--  -->

<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Recent updates</h6>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@username</strong>
                Some representative placeholder content, with some information about this user. Imagine this being some sort
                of status update, perhaps?
            </p>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">{{ Auth::user()->name }} </strong>
                Some more representative placeholder content, related to this other user. Another status update, perhaps.
            </p>
        </div>
        <div style="display: flex; justify-content: flex-end;">

            <button class="btn btn-primary rounded-pill px-3" type="button" data-bs-toggle="modal" data-bs-target="#myModalmore">more</button>
        </div>
        <div class="d-flex text-body-secondary pt-3">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
            </svg>
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="d-block text-gray-dark">@username</strong>
                ตอบกลับกระทู้
            </p>
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
</main>
@endsection

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
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
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
        </div>
    </div>
</div>
<!--------------->