<!-- Country-selector modal-->
<div class="modal fade" id="country-selector">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content country-select-modal">
            <div class="modal-header">
                <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <ul class="row row-sm p-3">
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block active">
                            <span class="country-selector"><img alt="unitedstates" src="{{asset('assets/images/flags/us_flag.jpg')}}" class="me-2 language"></span>United States
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="italy" src="{{asset('assets/images/flags/italy_flag.jpg')}}" class="me-2 language"></span>Italy
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="spain" src="{{asset('assets/images/flags/spain_flag.jpg')}}" class="me-2 language"></span>Spain
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="india" src="{{asset('assets/images/flags/india_flag.jpg')}}" class="me-2 language"></span>India
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="french" src="{{asset('assets/images/flags/french_flag.jpg')}}" class="me-2 language"></span>French
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="russia" src="{{asset('assets/images/flags/russia_flag.jpg')}}" class="me-2 language"></span>Russia
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="germany" src="{{asset('assets/images/flags/germany_flag.jpg')}}" class="me-2 language"></span>Germany
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="argentina" src="{{asset('assets/images/flags/argentina_flag.jpg')}}" class="me-2 language"></span>Argentina
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="uae" src="{{asset('assets/images/flags/uae_flag.jpg')}}" class="me-2 language"></span>UAE
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="austria" src="{{asset('assets/images/flags/austria_flag.jpg')}}" class="me-2 language"></span>Austria
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="mexico" src="{{asset('assets/images/flags/mexico_flag.jpg')}}" class="me-2 language"></span>Mexico
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="china" src="{{asset('assets/images/flags/china_flag.jpg')}}" class="me-2 language"></span>China
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="poland" src="{{asset('assets/images/flags/poland_flag.jpg')}}" class="me-2 language"></span>Poland
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="canada" src="{{asset('assets/images/flags/canada_flag.jpg')}}" class="me-2 language"></span>Canada
                        </a>
                    </li>
                    <li class="col-lg-4 mb-2">
                        <a class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="malaysia" src="{{asset('assets/images/flags/malaysia_flag.jpg')}}" class="me-2 language"></span>Malaysia
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Country-selector modal-->

<div class="modal fade " id="modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Add {{$title ?? null}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>


<div class="modal fade " id="modal-xl" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">Add {{$title ?? null}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                Are you sure you want to delete this {{isset($title) ? $title : ''}}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
