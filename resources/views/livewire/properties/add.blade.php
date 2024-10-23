@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">Property</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Property</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Rating">
                    <span>
                        <i class="fa fa-star"></i>
                    </span>
                </a>
                <a href="{{ url('lockscreen') }}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="lock">
                    <span>
                        <i class="fa fa-lock"></i>
                    </span>
                </a>
                <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Add New">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    <!-- ROW -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Property</h3>
                </div>
                <div class="card-body">
                    <p>Please fill the form below to create property.</p>

                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="property_name" class="form-label">Property Name*</label>
                            <input type="text" name="property_name" class="form-control" id="property_name" value="" required>
                            <div class="valid-feedback">
                                Please enter the Property Name.
                            </div>
                        </div>

                        <div class="col-md-6">
                        </div>

                        <div class="col-md-12">
                            <label for="property_description" class="form-label">Property Description*</label>
                            <textarea name="property_description" class="form-control" id="property_description" placeholder="Property Description"
                                required></textarea>
                            <div class="invalid-feedback">
                                Please enter the Property Description.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="property_address" class="form-label">Property Address</label>
                            <input name="property_address" type="text" class="form-control" id="property_address" value=""
                                required>
                            <div class="valid-feedback">
                                Please enter the Property address.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">city</label>
                            <input name="city" type="text" class="form-control" id="city" value="" required>
                            <div class="valid-feedback">
                                Please enter the Property Address.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="state" class="form-label">State</label>
                            <select name="state" class="form-select select2" id="state" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="USA">USA</option>
                                <option value="Berlin">Berlin</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Flynn">Flynn</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="zipcode" class="form-label">zipcode</label>
                            <input type="number" name="zipcode" class="form-control" id="zipcode" value="" required>
                            <div class="valid-feedback">
                                Please enter the zipcode.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="property_management_address" class="form-label">Property Management Address *</label>
                            <input name="property_management_address" type="text" class="form-control" id="property_management_address"
                                value="" required>
                            <div class="valid-feedback">
                                Please enter the Property Management Address.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="property_management_city" class="form-label">Property Management city *</label>
                            <input name="property_management_city" type="text" class="form-control" id="property_management_city"
                                value="" required>
                            <div class="valid-feedback">
                                Please enter the Property Management city.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="property_management_state" class="form-label">Property Management State</label>
                            <select class="form-select select2" name="property_management_state" id="property_management_state" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="USA">USA</option>
                                <option value="Berlin">Berlin</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Flynn">Flynn</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="property_management_zipcode" class="form-label">Property Management Zipcode</label>
                            <input type="number" class="form-control" name="property_management_zipcode" id="property_management_zipcode" value="" required>
                            <div class="valid-feedback">
                                Please enter the zipcode.
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>Do you charge by the bed, bedroom or entire unit/house? *</p>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="radio" name="property_type" class="form-check-input" id="is_beds" value="bed">
                                <label class="form-check-label" for="is_beds">By Bed</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="radio" name="property_type" class="form-check-input" id="is_bedroom" value="bedroom">
                                <label class="form-check-label" for="is_bedroom">By Bedroom</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input type="radio" name="property_type" class="form-check-input" id="is_unit" value="unit">
                                <label class="form-check-label" for="is_unit">By Unit/House</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                        </div>

                        <div class="isBed">
                            <div class="col-md-6">
                                <label for="number_of_beds" class="form-label">How many beds are available to rent? *</label>
                                <input type="number" class="form-control" name="number_of_beds" id="number_of_beds"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                            <div class="col-md-6">
                            </div>

                            <div class="col-md-6">
                                <label for="rent_bed" class="form-label">Rent by Bed</label>
                                <input type="number" class="form-control" name="rent_bed" id="rent_bed"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-12">
                                <p>Add Bed Details</p>
                            </div>

                            <div class="col-md-6">
                                <label for="bed_deposit" class="form-label">Deposit*</label>
                                <input type="number" class="form-control" name="bed_deposit" id="bed_deposit"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="bed_fee" class="form-label">Fee*</label>
                                <input type="number" class="form-control" name="bed_fee" id="bed_fee" value="">
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>
                        </div>

                        <div class="isBedroom">
                            <div class="col-md-6">
                                <label for="number_of_bedrooms" class="form-label">How many bedrooms are available to rent? *</label>
                                <input type="number" class="form-control" name="number_of_bedrooms" id="number_of_bedrooms"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of bedrooms.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="stay_one_bedroom" class="form-label">People allowed to stay in one bedroom? *</label>
                                <input type="number" class="form-control" name="stay_one_bedroom" id="stay_one_bedroom"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number Of People allowed to stay in one bedroom.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p>Add Bedroom Details</p>
                            </div>

                            <div class="col-md-6">
                                <label for="bedroom_deposit" class="form-label">Deposit*</label>
                                <input type="number" class="form-control" name="bedroom_deposit" id="bedroom_deposit"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="bedroom_fee" class="form-label">Fee*</label>
                                <input type="number" class="form-control" name="bedroom_fee" id="bedroom_fee" value="">
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                        </div>

                       
                        <div class="isUnit">
                            <div class="col-md-6">
                                <label for="number_of_bedrooms_house" class="form-label">How many bedrooms are there in the house? *</label>
                                <input type="number" class="form-control" name="number_of_bedrooms_house" id="number_of_bedrooms_house"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of bedrooms are there in the house.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="number_of_bath_house" class="form-label">How many baths are there in the house? *</label>
                                <input type="number" class="form-control" name="number_of_bath_house" id="number_of_bath_house"
                                    value="">
                                <div class="valid-feedback">
                                    Please enter the number Of baths are there in the house.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="utilities_inscluded" class="form-label">Are Utilities included? *</label>
                                <select class="form-select select2" id="utilities_inscluded" name="utilities_inscluded" >
                                    <option selected disabled value="">Choose...</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select If Utilities included.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="rent_unit" class="form-label">Rent for the Unit/House *</label>
                                <input type="number" class="form-control" name="rent_unit" id="rent_unit"
                                value="">
                                <div class="valid-feedback">
                                    Please enter Rent for the Unit/House.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p>Add Unit/House Details</p>
                            </div>

                            <div class="col-md-6">
                                <label for="unit_deposit" class="form-label">Deposit*</label>
                                <input type="number" class="form-control" name="unit_deposit" id="unit_deposit"
                                    value="" >
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="unit_fee" class="form-label">Fee*</label>
                                <input type="number" class="form-control" name="unit_fee" id="unit_fee" value="">
                                <div class="valid-feedback">
                                    Please enter the number of Beds.
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">
                            <label for="is_property_occupied" class="form-label">Is property occupied? *</label>
                            <select class="form-select select2" name="is_property_occupied" id="is_property_occupied" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select Is property occupied.
                            </div>
                        </div>

                        <div class="mb-12">
                            <label for="main_picture" class="form-label">Main Picture*</label>
                            <input type="file" class="form-control" aria-label="file example" name="main_picture"
                                required>
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>

                        <div class="col-md-12">
                            <label for="more_picture" class="form-label">More Pictures*</label>
                            <input type="file" class="form-control" aria-label="file example" name="more_picture[]" multiple required>
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- ROW CLOSED -->
@endsection

    <!-- SELECT2 JS -->
    <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- FORMVALIDATION JS -->
    @vite('resources/assets/js/form-validation.js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.isBed, .isBedroom, .isUnit').hide();
        // When a radio button is selected
        $('input[name="property_type"]').on('change', function() {
            var selectedValue = $(this).val();  // Get the selected value

            // Hide all sections initially
            $('.isBed, .isBedroom, .isUnit').hide();

            // Show the appropriate section based on the selected radio button
            if (selectedValue === 'bed') {
                $('.isBed').slideDown('slow');
            } else if (selectedValue === 'bedroom') {
                $('.isBedroom').slideDown('slow');
            } else if (selectedValue === 'unit') {
                $('.isUnit').slideDown('slow');
            }
        });
    });
</script>
